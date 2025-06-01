<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class User_Feedback17_Test extends DuskTestCase
{
    public function testSubmittingMedicineReviewWithoutRequiredFields()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/checkout/review') 
                    ->press('Submit Review')  
                    ->waitForText('The rating field is required') 
                    ->assertSee('The rating field is required')
                    ->assertSee('The review comment field is required'); 
        });
    }
}
