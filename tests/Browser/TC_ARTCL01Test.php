<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Symfony\Component\Console\Input\Input;
use Tests\DuskTestCase;

class TC_ARTCL01Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group article
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Article')
                    ->assertPathIs('/articles')
                    ->assertSee('Health Articles');
                    
        });
    }
}
