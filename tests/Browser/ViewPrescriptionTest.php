<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ViewPrescriptionTest extends DuskTestCase
{
    /**
     * Test viewing a prescription from the prescriptions index page.
     *
     * @return void
     */
    public function test_doctor_can_view_prescription()
    {
        $this->browse(function (Browser $browser) {
            // Step 1: Login as a doctor
            $browser->visit('http://127.0.0.1:8000/doctordash/login');
            $browser->assertSee('Login to Account (Doctor Portal)');
            $browser->type('email', 'john.smith@telkomedika.com');
            $browser->type('password', 'password123');
            $browser->press('Login');
            $browser->assertPathIs('/doctordash/home');
            
            // Step 2: Navigate to Prescriptions page
            $browser->clickLink('Prescription');
            $browser->assertPathIs('/doctordash/prescriptions');
            $browser->assertSee('Prescription Management');
            
            // Step 3: Take a screenshot of the prescriptions list
            $browser->screenshot('prescriptions-list');
            
            // Step 4: Get the URL of the first prescription's View button
            $viewUrl = $browser->attribute('table tbody tr:first-child .btn-view', 'href');
            echo "View button URL: {$viewUrl}\n";
            
            // Step 5: Directly visit the view URL
            $browser->visit($viewUrl);
            $browser->pause(2000); // Wait for page to load
            
            // Step 6: Take a screenshot after visiting the view page
            $browser->screenshot('after-view-click');
            
            // Step 7: Check for content that should be on the prescription view page
            $browser->assertSee('Prescription');
            
            // Step 8: Take a final screenshot
            $browser->screenshot('prescription-details');
        });
    }
}
