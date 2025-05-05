<?php

namespace Tests\Browser;

use App\Models\Medicine;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MedDelTest extends DuskTestCase
{
    /** @test */
    public function it_deletes_an_existing_medicine_after_pop_up_confirmation()
    {
       
        $medicine = Medicine::first(); 

        // Ensure the medicine exists
        $this->assertNotNull($medicine);

        // Visit the medicine list page
        $this->browse(function (Browser $browser) use ($medicine) {
            
            $browser->visit('/adminmedicine')  // Adjust URL as needed
                    // Assert the medicine is listed
                    ->assertSee($medicine->medicine_name)
                    ->assertSee($medicine->description)
                    ->assertSee(number_format($medicine->price, 0, ',', '.'))
                    ->assertSee($medicine->stock);

            // Click the "Delete" button for the existing medicine
            $browser->click('.btn-danger') 
                 
                    ->waitForText('Are you sure?')
                    // Click the "Yes, delete it!" button in the pop-up
                    ->click('.swal2-confirm') 
          
                    ->waitForText('Medicines')
                    // Assert the medicine is no longer in the list
                    ->assertDontSee($medicine->medicine_name)
                    ->assertDontSee($medicine->description);
        });
    }
}
