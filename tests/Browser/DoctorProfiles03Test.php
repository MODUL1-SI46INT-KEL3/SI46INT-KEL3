<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DoctorProfiles03Test extends DuskTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function testExample(): void
    
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
                ->press('See All Doctors')
                ->assertPathIs('/doctors');
            });
    
        }
        }