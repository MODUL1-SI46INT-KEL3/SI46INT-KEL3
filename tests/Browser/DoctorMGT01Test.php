<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DoctorMGT01Test extends DuskTestCase
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
                ->type('Name', 'Dr. Fernandi')
                ->type('Email', 'fernandomanuezz@gmail.com')
                ->type('Working Hours', '11.00 - 20.00')
                ->type('Password', '8765432111')
                ->type('Specialization ID', '1')
                ->type('Phone', '0821336785444')
                ->type('License Number', 'JK19990')
                ->press('Submit');

    });
    
}
}