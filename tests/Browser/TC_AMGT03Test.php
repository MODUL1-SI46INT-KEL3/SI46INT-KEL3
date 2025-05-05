<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_AMGT03Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     *  @group amgtupdate
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminarticle/6/edit')  //specifically targets the #6 entry
                    ->waitForText('Edit Article')
                    ->type('header', 'Laravel Dusk Article But Edited')
                    ->type('description', 'Laravel Dusk Article')
                    ->type('author', 'Laravel Dusk')
                    ->type('img_link', 'https://cdna.artstation.com/p/assets/images/images/039/755/068/large/alex-flores-evelynncoven-final-alexflores2b2.jpg?1626841040')
                    ->press('Update Article')
                    ->waitForLocation('/adminarticle') 
                    ->assertPathIs('/adminarticle');
        });
    }
}
