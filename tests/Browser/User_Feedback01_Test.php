<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class User_Feedback01_Test extends DuskTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/reviews')
                ->select('#reviewSelector', 'web');

            $browser->click('.star[data-value="3"]') 
                    ->pause(500)
                    ->type('#reviewTextarea', 'very') 
                    ->press('#submitBtn') 
                    ->pause(100)
                    ->assertSee('Feedback');
        });
    }
}