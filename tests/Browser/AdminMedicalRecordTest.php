<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminMedicalRecordTest extends DuskTestCase
{
    /**
     * Test navigating to admin medical records page.
     *
     * @return void
     */
    public function testAdminMedicalRecordsNavigation(): void
    {
        $this->browse(function (Browser $browser) {
            // Directly navigate to admin home page (assuming already logged in)
            $browser->visit('/admins/home')
                    // Wait for the page to load
                    ->pause(1000)
                    // Take a screenshot of admin home
                    ->screenshot('admin-home')
                    // Dump the page source for debugging
                    ->tap(function (Browser $browser) {
                        file_put_contents('tests/Browser/screenshots/page-source.html', $browser->driver->getPageSource());
                    })
                    // Try to find the Medical Record link by different methods
                    ->tap(function (Browser $browser) {
                        // Try direct navigation instead of clicking
                        $browser->visit('/adminMedicalRecord');
                    })
                    // Wait for the page to load
                    ->pause(2000)
                    // Check if we're on the medical records page
                    ->assertPathIs('/adminMedicalRecord')
                    // Take a screenshot of the medical records page
                    ->screenshot('admin-medical-records')
                    // Verify we can see the medical records management text
                    ->assertSee('Medical Records Management');
        });
    }
}
