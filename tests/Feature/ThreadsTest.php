<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    protected $thread;
    protected $replies;

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
        $this->reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
    }

    public function test_a_user_can_browse_threads()
    {
        $response = $this->get('/threads')
                        ->assertSee($this->thread->title);
    }

    public function test_a_user_can_read_a_single_thread()
    {
        $response = $this->get($this->thread->path())
                    ->assertSee($this->thread->title);
    }

    public function test_a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $response = $this->get($this->thread->path())
                    ->assertSee($this->reply->body);
        
    }
}
