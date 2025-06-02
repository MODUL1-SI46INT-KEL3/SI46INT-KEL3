<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Symptom;

class TC_SYMDEL001 extends DuskTestCase
{
    /** @test */
    public function it_deletes_an_existing_symptom_after_pop_up_confirmation()
    {
        $symptom = Symptom::first(); 
        $this->assertNotNull($symptom);

        $this->browse(function (Browser $browser) use ($symptom) {
    
            $browser->visit('/adminsymptoms')
                    ->waitFor('.btn-danger')
                    ->screenshot('after-page-load')
                    ->click('.btn-danger')
                    ->waitForText('Are you sure?')
                    ->click('.swal2-confirm')
                    ->waitForText('Symptom') // or whatever confirmation appears
                    ->assertDontSee($symptom->name);

        });
    }
}