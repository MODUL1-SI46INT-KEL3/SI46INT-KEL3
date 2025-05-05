<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Patient_MGT_007 extends DuskTestCase
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
                    ->clickLink('Patient')
                    ->assertPathIs('/adminPatient')
                    ->press('Delete')
                    ->waitFor('.swal2-popup') 
                    ->press('Yes, delete it!')
                    ->waitUntilMissing('.swal2-popup');
        });
    }
}
