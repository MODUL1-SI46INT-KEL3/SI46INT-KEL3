<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Appointment_MGT_005 extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->press('Log In')
                    ->assertPathIs('/patients/login')
                    ->clickLink('Or Log In as Admin')
                    ->assertPathIs('/admins/login')
                    ->type('username', 'admin0')
                    ->type('password', '87654321')
                    ->press('Login')
                    ->assertPathIs('/admins/home')
                    ->clickLink('Appointment')
                    ->press('Delete')
                    ->dismissDialog();
        });
    }
}
