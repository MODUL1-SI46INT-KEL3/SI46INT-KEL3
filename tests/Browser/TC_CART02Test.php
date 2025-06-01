<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_CART02Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group cart
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->press('Log In')
                    ->assertPathIs('/patients/login')
                    ->type('email', 'daffamzulfikar@gmail.com')
                    ->type('password', '12345678')
                    ->press('Login')
                    ->visit('/medicines')
                    ->assertSee('Triple X')
                    ->press('@submit-cart')
                    ->assertSee('Estimated Cost')
                    ->press('@see-cart')
                    ->assertSee('List of Items') 
                    ->press('@select')
                    ->pause(2000)
                    ->press('@select')
                    ->pause(2000)
                    ->press('@checkout-button')
                    ->assertSee('324324')
                    ->assertSee('Triple');
        });
    }
}
