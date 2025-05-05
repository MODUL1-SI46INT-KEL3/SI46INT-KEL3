<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DoctorMGT09Test extends DuskTestCase
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
                ->press('Export PDF')
                ->assertPathIs('/C:/Users/HUAWEI/Downloads/Doctor_List.pdf');
    });
    
}
}