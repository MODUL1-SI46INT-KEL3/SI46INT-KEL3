<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Payment;

class EditPaymentTest extends DuskTestCase
{
    public function test_successfully_edits_payment()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $payment = Payment::factory()->create(['item' => 'Old Item']);

        $this->browse(function (Browser $browser) use ($admin, $payment) {
            $browser->loginAs($admin)
                ->visit("/adminpayments/{$payment->payment_id}/edit")
                ->type('item', 'Updated Item')
                ->press('Update')
                ->assertPathIs('/adminpayments')
                ->assertSee('Updated Item');
        });
    }
}
