<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdMedTestNeg extends DuskTestCase
{
    /** @test */
    public function admin_can_upd_new_medicine_with_blank_inputs()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/adminmedicine/4/edit')
                    ->type('medicine_name', '')
                    ->type('description', 'Testt')
                    ->type('price', '1234')
                    ->type('stock', '1234')
                    ->press('Update Medicine')
                    ->pause(3000) 
                    ->assertSee('Please fill out this field.'); 
        });
    }
}