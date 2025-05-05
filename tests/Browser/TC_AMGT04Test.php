<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_AMGT04Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group amgtupdate
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminarticle/7/edit')  //specifically targets the #7 entry
                    ->waitForText('Edit Article')
                    ->type('header', 'Laravel Dusk Article But Edited')
                    ->type('description', 'https://cdna.artstation.com/p/assets/images/images/039/755/068/large/alex-flores-evelynncoven-final-alexflores2b2.jpg?1626841040https://cdna.artstation.com/p/assets/images/images/039/755/068/large/alex-flores-evelynncoven-final-alexflores2b2.jpg?1626841040https://cdna.artstation.com/p/assets/images/images/039/755/068/large/alex-flores-evelynncoven-final-alexflores2b2.jpg?1626841040https://cdna.artstation.com/p/assets/images/images/039/755/068/large/alex-flores-evelynncoven-final-alexflores2b2.jpg?1626841040https://cdna.artstation.com/p/assets/images/images/039/755/068/large/alex-flores-evelynncoven-final-alexflores2b2.jpg?1626841040')
                    ->type('author', 'Laravel Dusk')
                    ->type('img_link', 'https://cdna.artstation.com/p/assets/images/images/039/755/068/large/alex-flores-evelynncoven-final-alexflores2b2.jpg?1626841040')
                    ->press('Update Article')
                    ->waitForText('Error')
                    ->assertSee("Error");
        });
    }
}
