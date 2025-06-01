<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_RVWMGT06Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group datereview
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminreviews')
                ->assertSee('Customer Reviews')
                ->assertSee('Anonymous')
                ->assertSee('May 2025');
        });
    }
}
