<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddMedTestNeg extends DuskTestCase
{
    /** @test */
    public function admin_can_add_new_medicine_with_invalid_inputs()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/adminmedicine/create')
                    ->type('medicine_name', 'Test')
                    ->type('description', 'Test Desc')
                    ->type('price', 'notanumber')
                    ->type('stock', 'alsonotnumber')
                    ->press('Save Medicine')
                    ->pause(3000) 
                    ->screenshot('error-dump') 
                    ->assertSee('The price field must be a number.'); 
        });
    }
}