<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DoctorMGT02Test extends DuskTestCase
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
                ->type('Email', 'gunawan@example.com')
                ->type('Working Hours', '13.00 - 17.00')
                ->type('Password', '123')
                ->type('Specialization ID', '2')
                ->type('Phone', '(0261) 67543')
                ->type('License Number', 'EDEL234')
                ->press('Submit')
                ->assertPathIs('/admindoctors');
    });
    
}
}