<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class User_Feedback18_Test extends DuskTestCase
{
    public function testSubmittingReviewWithoutRating()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/checkout/review')
                    ->type('review_comment', 'This is a test review without a rating.') 
                    ->press('Submit Review')  
                    ->waitForText('The rating field is required') 
                    ->assertSee('The rating field is required') 
                    ->assertDontSee('Review submitted successfully'); 
        });
    }
}
