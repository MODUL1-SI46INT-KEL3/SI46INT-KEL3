<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Payment;

class EditPaymentValidationTest extends DuskTestCase
{
    public function test_edit_fails_due_to_missing_field()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $payment = Payment::factory()->create(['item' => 'To Be Broken']);

        $this->browse(function (Browser $browser) use ($admin, $payment) {
            $browser->loginAs($admin)
                ->visit("/adminpayments/{$payment->payment_id}/edit")
                ->type('item', '') // Intentionally clear required field
                ->press('Update')
                ->assertPathIs("/adminpayments/{$payment->payment_id}/edit");
        });
    }
}

