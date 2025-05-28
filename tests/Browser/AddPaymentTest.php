<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Patient;

class AddPaymentTest extends DuskTestCase
{
    public function test_successfully_adds_payment()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $patient = Patient::factory()->create();

        $this->browse(function (Browser $browser) use ($admin, $patient) {
            $browser->loginAs($admin)
                ->visit('/adminpayments/create')
                ->select('patient_id', $patient->id)
                ->type('item', 'Blood Test')
                ->type('amount', '20000')
                ->select('payment_method', 'Cash')
                ->select('payment_status', 'Completed')
                ->press('Submit')
                ->assertPathIs('/adminpayments')
                ->assertSee('Payment List')
                ->assertSee('Blood Test');
        });
    }
}

