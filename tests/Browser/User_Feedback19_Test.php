<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class User_Feedback19_Test extends DuskTestCase
{
    public function testSubmittingMedicineReviewWithCommentsOnly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/checkout/review')
                    ->type('review_comment', 'This is a test review with comments only.') 
                    ->press('Submit Review')  
                    ->waitForText('The rating field is required') 
                    ->assertSee('The rating field is required') 
                    ->assertDontSee('Review submitted successfully'); 
        });
    }
}
