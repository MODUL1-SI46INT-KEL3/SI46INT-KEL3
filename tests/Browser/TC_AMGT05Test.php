<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_AMGT05Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group del
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminarticle')
                    ->press('Delete'); //this should delte the first entry
        });
    }
}
