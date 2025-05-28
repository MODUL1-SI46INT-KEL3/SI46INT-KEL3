<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Patient;

class AddPaymentValidationTest extends DuskTestCase
{
    public function test_fails_to_add_due_to_missing_field()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $patient = Patient::factory()->create();

        $this->browse(function (Browser $browser) use ($admin, $patient) {
            $browser->loginAs($admin)
                ->visit('/adminpayments/create')
                ->select('patient_id', $patient->id)
                ->type('item', '') // Leave blank intentionally
                ->type('amount', '20000')
                ->select('payment_method', 'Cash')
                ->select('payment_status', 'Completed')
                ->press('Submit')
                ->assertPathIs('/adminpayments/create');
        });
    }
}
