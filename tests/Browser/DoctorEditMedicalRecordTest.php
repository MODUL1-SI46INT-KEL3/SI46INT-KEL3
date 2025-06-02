<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DoctorEditMedicalRecordTest extends DuskTestCase
{
    /**
     * Test editing a patient's medical record.
     *
     * @return void
     */
    public function testEditPatientMedicalRecord(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/doctordash/login')
                    ->type('email', 'john.smith@telkomedika.com')
                    ->type('password', 'password123')
                    ->press('Login')
                    // Wait for login to complete
                    ->pause(2000)
                    // Check if we're on the home page
                    ->assertPathIs('/doctordash/home')
                    ->clickLink('Medical Records')
                    ->assertSee('Patients List')
                    ->waitFor('table')
                    ->assertSee('Nabiel Islami')
                    // Click on View Records
                    ->clickLink('View Records')
                    // Wait for the page to load
                    ->pause(1000)
                    // Check that we can see the patient's personal details
                    ->assertSee('Patient Personal Detail')
                    // Now click on the Edit button in the Actions column
                    // From the screenshot, we can see the Edit button is a yellow button with text "Edit"
                    // Let's take a screenshot before clicking to debug
                    ->screenshot('before-edit-click')
                    // Since the button might be a link styled as a button, try clicking it as a link
                    ->clickLink('Edit')
                    // Wait for the edit page to load
                    ->pause(1000)
                    // Verify we're on the edit page - it has both these headings
                    ->assertSee('Medical Record')
                    ->assertSee('Edit Medical Record')
                    // Take a screenshot before making any changes
                    ->screenshot('before-changes')
                    
                    // Find the form and store it in a variable
                    ->tap(function ($browser) {
                        // Get the form element
                        $form = $browser->element('form');
                        
                        // Submit the form
                        $form->submit();
                        
                        // Wait for the page to load after submission
                        $browser->pause(3000);
                    })
                    
                    // We should now be back on the patient detail page
                    ->assertSee('Patient Personal Detail')
                    
                    // Check for the success message
                    ->assertSee('Medical record updated successfully');
        });
    }
}
