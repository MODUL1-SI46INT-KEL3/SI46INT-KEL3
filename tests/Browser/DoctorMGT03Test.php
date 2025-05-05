<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DoctorMGT03Test extends DuskTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
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
                ->clickLink('Doctor')
                ->assertPathIs('/admindoctors')
                ->pause(1000)
                ->screenshot('before-add-doctor-click')
                ->clickLink('Add Doctor')
                ->assertPathIs('/admindoctors/create')
                ->type('Name', 'Dr. Gunawan')
                ->type('Email', 'gunawan123@gmail.com')
                ->type('Working Hours', '15.00 - 20.00')
                ->type('Password', '123ZaqWsx')
                ->type('Specialization ID', '2')
                ->type('Phone', '(0261) 67543')
                ->type('License Number', 'EDEL234')
                ->press('Cancel')
                ->assertPathIs('/admindoctors');
    });
    
}
}