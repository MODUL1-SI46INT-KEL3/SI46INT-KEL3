<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_ARTCL03Test extends DuskTestCase
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
                    ->assertSee('DAFFA MUHAMMAD ZULFIKAR')
                    ->assertSee('May 3');
        });
    }
}
