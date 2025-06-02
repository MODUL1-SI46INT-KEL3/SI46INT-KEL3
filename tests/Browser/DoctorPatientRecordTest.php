<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DoctorPatientRecordTest extends DuskTestCase
{
    /**
     * Test viewing a patient's medical record.
     *
     * @return void
     */
    public function testViewPatientMedicalRecord(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/doctordash/login')
                    ->type('email', 'john.smith@telkomedika.com')
                    ->type('password', 'password123')
                    ->press('Login')
                    ->assertPathIs('/doctordash/home')
                    ->clickLink('Medical Records')
                    ->assertSee('Patients List')
                    ->waitFor('table')
                    ->assertSee('Nabiel Islami')
                    // Looking at the screenshot, we can see it's a link styled as a button
                    ->pause(1000)
                    // The View Records button is actually a link with text "View Records"
                    ->clickLink('View Records')
                    // Wait for the page to load
                    ->pause(1000)
                    // Take a screenshot for verification
                    ->screenshot('patient-personal-detail')
                    // Check that we can see the patient's personal details
                    ->assertSee('Patient Personal Detail')
                    ->assertSee('Nabiel Islami');
        });
    }
}
