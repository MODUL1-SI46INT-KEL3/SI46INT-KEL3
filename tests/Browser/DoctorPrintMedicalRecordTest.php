<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class DoctorPrintMedicalRecordTest extends DuskTestCase
{
    /**
     * Test printing a patient's medical record.
     *
     * @return void
     */
    public function testPrintPatientMedicalRecord()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/doctordash/login')
                    // Login as a doctor with correct credentials
                    ->type('email', 'john.smith@telkomedika.com')
                    ->type('password', 'password123')
                    ->press('Login')
                    // Wait for login to complete
                    ->pause(2000)
                    // Check if we're on the home page
                    ->assertPathIs('/doctordash/home')
                    // Click on Medical Records link in the sidebar
                    ->clickLink('Medical Records')
                    ->assertSee('Patients List')
                    // Wait for the table to load
                    ->waitFor('table')
                    ->assertSee('Nabiel Islami')
                    // Click on View Records
                    ->clickLink('View Records')
                    // Wait for the page to load
                    ->pause(1000)
                    // Check that we can see the patient's personal details
                    ->assertSee('Patient Personal Detail')
                    // Take a screenshot before clicking print
                    ->screenshot('before-print-click')
                    
                    // Store the current window handle
                    ->tap(function (Browser $browser) {
                        // Click the Print link which opens in a new tab
                        $browser->clickLink('Print');
                        
                        // Wait for the new tab to open
                        $browser->pause(2000);
                        
                        // Get all window handles
                        $windowHandles = $browser->driver->getWindowHandles();
                        
                        // Switch to the new tab (the last one in the list)
                        $browser->driver->switchTo()->window(end($windowHandles));
                        
                        // Wait for the print page to load
                        $browser->pause(2000);
                        
                        // Take a screenshot of the print view
                        $browser->screenshot('print-view');
                        
                        // Verify we're on the print page by checking for specific elements
                        $browser->assertSee('Medical Record Report');
                        $browser->assertSee('Patient Information');
                        $browser->assertSee('Medical Record Details');
                        
                        // Verify patient information is present
                        $browser->assertSee('Nabiel Islami');
                        
                        // Verify medical record details are present
                        $browser->assertSee('Assessment:');
                        $browser->assertSee('Diagnosis:');
                        $browser->assertSee('Treatment:');
                    });
        });
    }
}
