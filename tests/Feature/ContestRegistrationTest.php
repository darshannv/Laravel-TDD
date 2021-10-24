<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Events\NewEntryReceivedEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContestRegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void {

        parent::setUp();

        Event::fake();
    }

 /** @test */
   
    public function an_email_can_be_entered_into_the_contest(){


        // $this->withoutExceptionHandling();

        $this->post('/contest', [
            'email' => 'abc@mail.com',
        ]);

        $this->assertDatabaseCount('contest_entries', 1);
    }

 /** @test */
    public function email_is_required(){

       // $this->withoutExceptionHandling();


        // $this->post('/contest', [
        //     'email' => 'abc@mail.com',
        // ]);

       // $this->assertDatabaseCount('contest_entries', 0);
    }


    /** @test */

    public function email_needs_to_be_email(){

        $this->post('/contest', [
            'email' => '',
        ]);

        $this->assertDatabaseCount('contest_entries', 0);
    }

    /** @test */
    public function an_event_is_fired_when_user_is_registered(){

        $this->post('/contest', [
            'email' => 'test@mail.com',
        ]);

        Event::assertDispatched(NewEntryReceivedEvent::class);

    }
}
