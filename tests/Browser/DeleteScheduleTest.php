<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteScheduleTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->visit('/adminschedules')
                ->press("@delete-button-{$schedule->id}")
                ->assertPathIs('/adminschedules')
                ->assertSee('Schedule deleted successfully');
        });
    }
}
