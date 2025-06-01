<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_RVWMGT05Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group sendreview
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminreviews')
                ->assertSee('Customer Reviews')
                ->press('@unsend-button')
                ->acceptDialog() 
                ->pause(1000)
                ->assertSee('retracted');
        });
    }

}
