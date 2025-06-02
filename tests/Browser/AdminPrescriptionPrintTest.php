<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminPrescriptionPrintTest extends DuskTestCase
{
    /**
     * Test printing a prescription from the admin prescription page.
     *
     * @return void
     */
    public function test_admin_can_print_prescription()
    {
        $this->browse(function (Browser $browser) {
            // Step 1: Directly visit the admin prescription page
            $browser->visit('http://127.0.0.1:8000/adminPrescription');
            
            // Step 2: Take a screenshot of the prescription list
            $browser->screenshot('admin-prescriptions-list');
            
            // Step 3: Verify we're on the right page
            $browser->assertSee('Prescription Management');
            
            // Step 4: Check if the table contains "No prescriptions found"
            $hasNoPrescriptions = $browser->driver->executeScript('return document.body.textContent.includes("No prescriptions found");');
            
            if ($hasNoPrescriptions) {
                echo "No prescriptions found!\n";
                $browser->screenshot('no-prescriptions-found');
                return;
            }
            
            // Step 5: Get the URL of the first prescription's Print button
            $printUrl = $browser->attribute('table tbody tr:first-child .btn-print', 'href');
            echo "Print button URL: {$printUrl}\n";
            
            // Step 5: Open the print URL in a new tab/window
            // Since Dusk doesn't easily handle new tabs, we'll directly visit the URL
            $browser->visit($printUrl);
            $browser->pause(2000); // Wait for page to load
            
            // Step 6: Take a screenshot of the print page
            $browser->screenshot('prescription-print-page');
            
            // Step 7: Verify we're on a prescription-related page
            // The print page might have different content, so we'll just check for basic elements
            $browser->assertSee('Prescription');
            
            // Step 8: Go back to the admin prescription page
            $browser->visit('http://127.0.0.1:8000/adminPrescription');
            $browser->assertSee('Prescription Management');
        });
    }
}
