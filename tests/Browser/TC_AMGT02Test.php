<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_AMGT02Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group amgtcreate
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminarticle')
            ->clickLink('Write Article')
            ->assertSee('Create New Article')
            ->type('header', 'Laravel Dusk Article')
            ->type('description', 'https://cdna.artstation.com/p/assets/images/images/039/755/068/large/alex-flores-evelynncoven-final-alexflores2b2.jpg?1626841040https://cdna.artstation.com/p/assets/images/images/039/755/068/large/alex-flores-evelynncoven-final-alexflores2b2.jpg?1626841040https://cdna.artstation.com/p/assets/images/images/039/755/068/large/alex-flores-evelynncoven-final-alexflores2b2.jpg?1626841040https://cdna.artstation.com/p/assets/images/images/039/755/068/large/alex-flores-evelynncoven-final-alexflores2b2.jpg?1626841040https://cdna.artstation.com/p/assets/images/images/039/755/068/large/alex-flores-evelynncoven-final-alexflores2b2.jpg?1626841040')
            ->type('author', 'Laravel Dusk')
            ->type('img_link', 'https://cdna.artstation.com/p/assets/images/images/039/755/068/large/alex-flores-evelynncoven-final-alexflores2b2.jpg?1626841040')
            ->press('Save')
            ->assertSee("too long");
        });
    }
}
