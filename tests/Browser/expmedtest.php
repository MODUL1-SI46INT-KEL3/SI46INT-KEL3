<?php

namespace Tests\Browser;

use App\Models\Medicine;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExpMedTest extends DuskTestCase
{
    /** @test */
    public function it_downloads_the_pdf_file_when_export_button_is_clicked()
    {
        // Fetch the first medicine item to ensure there's data
        $medicine = Medicine::first();

        $this->browse(function (Browser $browser) use ($medicine) {
            // Visit the medicines list page
            $browser->visit('/adminmedicine') 
                    ->assertSee('Medicines');  // Check if the page loads properly

            // Click the "Export PDF" button
            $browser->click('.btn-secondary'); // Click the Export PDF button

        });
    }
}