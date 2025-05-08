<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditScheduleTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->visit("/adminschedules/{$schedule->id}/edit")
                ->select('status', 'Scheduled')
                ->press('Submit')
                ->assertPathIs('/adminschedules')
                ->assertSee('Schedule updated successfully')
                ->assertSee('Done');
        });
    }
}
