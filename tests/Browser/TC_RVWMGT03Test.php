<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_RVWMGT03Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group reviewmgtdelete
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminreviews')
                ->assertSee('Customer Reviews')
                 ->press('@delete-button')
                ->acceptDialog() 
                ->pause(1000)
                ->assertSee('Review deleted successfully.');
        });
    }
}
