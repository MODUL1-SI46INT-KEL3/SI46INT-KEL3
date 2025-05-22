<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddMedTestNegNeg extends DuskTestCase
{
    /** @test */
    public function admin_can_add_new_medicine_with_blank_inputs()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/adminmedicine/create')
                    ->type('medicine_name', '')
                    ->type('description', 'Test Desc')
                    ->type('price', '1234')
                    ->type('stock', '1234')
                    ->press('Save Medicine')
                    ->pause(3000) 
                    ->assertSee('The medicine name field is required.'); 
        });
    }
}