<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class User_Feedback16_Test extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_patient_can_submit_medicine_review_with_rating_and_comment()
    {
        $this->browse(function (Browser $browser) {
      
            $browser->visit('/checkout/complete') 
                ->assertSee('Leave a Review')
                ->click('@star-5')
                ->type('@review-comment', 'This medicine was very effective and well-packaged.')
                ->press('@submit-review')
                ->waitForText('Thank you for your review')
                ->assertSee('Thank you for your review');
        });
    }
}
