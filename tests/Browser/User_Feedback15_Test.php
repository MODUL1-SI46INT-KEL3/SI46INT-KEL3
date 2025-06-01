<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class User_Feedback15_Test extends DuskTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function testAdminCanSendReviewsToDoctor(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminreviews')
                ->pause(1000)
                ->press('Send')
                ->pause(1000)
                ->assertSee('successfully') 
                ;
        });
    }
}
