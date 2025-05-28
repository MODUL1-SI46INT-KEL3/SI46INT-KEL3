<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Payment;
use App\Models\Patient;

class DeletePaymentWithoutSelectorTest extends DuskTestCase
{
    public function test_deletes_payment_without_selector()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $patient = Patient::factory()->create();
        $payment = Payment::factory()->create([
            'patient_id' => $patient->id,
            'item' => 'Delete Me',
            'amount' => 12345,
            'payment_method' => 'Cash',
            'payment_status' => 'Pending'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $payment) {
            $browser->loginAs($admin)
                ->visit('/adminpayments')
                ->assertSee('Delete Me')
                ->with("table tbody tr:contains('Delete Me')", function ($row) {
                    $row->press('Delete');
                })
                ->acceptDialog()
                ->pause(1000)
                ->assertDontSee('Delete Me');
        });
    }
}
