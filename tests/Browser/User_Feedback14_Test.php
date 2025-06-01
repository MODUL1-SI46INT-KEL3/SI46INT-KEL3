<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class User_Feedback14_Test extends DuskTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function testAdminCanViewAllPatientReviews(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminreviews')
                ->pause(1000);
        });
    }
}
