<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Medicine;
use App\Models\CartItem;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SuccessfulCheckoutTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_successful_checkout()
    {
        // Create necessary records
        $user = User::factory()->create();

        $medicine = Medicine::factory()->create([
            'medicine_name' => 'Paracetamol',
            'price' => 10000,
        ]);

        CartItem::create([
            'patient_id' => $user->id,
            'medicine_id' => $medicine->id,
            'quantity' => 2,
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/checkout')
                    ->select('payment_method', 'Cash')
                    ->press('Pay')
                    ->assertPathIs('/checkout/complete')
                    ->assertSee('Purchase Complete')
                    ->assertSee('Rp20.000') 
                    ->assertSee('Cash');
        });
    }
}

