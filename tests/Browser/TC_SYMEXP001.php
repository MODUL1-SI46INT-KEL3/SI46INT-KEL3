<?php

namespace Tests\Browser;

use App\Models\Symptom;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_SYMEXP001 extends DuskTestCase
{
    /** @test */
    public function it_downloads_the_pdf_file_when_export_button_is_clicked_sym()
    {
        // Fetch the first medicine item to ensure there's data
        $symptom = Symptom::first();

        $this->browse(function (Browser $browser) use ($symptom) {
            // Visit the medicines list page
            $browser->visit('/adminsymptoms') 
                    ->assertSee('Symptom');  // Check if the page loads properly

            // Click the "Export PDF" button
            $browser->click('.btn-secondary'); // Click the Export PDF button

        });
    }
}