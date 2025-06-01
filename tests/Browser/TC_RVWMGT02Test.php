<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_RVWMGT02Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group reviewmgt
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminreviews')
            ->assertSee('Customer Reviews')
            ->select('category', 'appointment') 
            ->pause(1000) 
            ->waitForText('Customer Reviews for Appointment') 
            ->assertSeeIn('h1', 'Customer Reviews for Appointment');
                            
        });
    }
}
