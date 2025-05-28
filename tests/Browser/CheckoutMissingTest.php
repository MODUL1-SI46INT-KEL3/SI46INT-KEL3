<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Medicine;
use App\Models\CartItem;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MissingPaymentMethodTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_checkout_fails_without_payment_method()
    {
        // Create necessary records
        $user = User::factory()->create();

        $medicine = Medicine::factory()->create([
            'medicine_name' => 'Ibuprofen',
            'price' => 12000,
        ]);

        CartItem::create([
            'patient_id' => $user->id,
            'medicine_id' => $medicine->id,
            'quantity' => 1,
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/checkout')
                    ->press('Pay')
                    ->assertPathIs('/checkout') // Should stay on the same page
                    ->assertSee('The payment method field is required');
        });
    }
}
