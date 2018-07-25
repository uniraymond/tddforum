<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    protected $thread;

    public function setUp()
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }

    /**
     * @test
     */
    public function test_a_thread_can_make_a_string_path()
    {
        $thread = factory('App\Thread')->create();
        $this->assertEquals("/threads/{$thread->channel->slug}/{$thread->id}", $thread->path());
    }

    /**
     * @test
     */
    public function test_a_thread_has_creator()
    {

        $this->assertInstanceOf('App\User', $this->thread->creator );
    }

    /** @test */
    function test_a_thread_has_replies()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->thread->replies
        );
    }

    /**
     * @test
     */
    public function test_a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertcount(1, $this->thread->replies);
    }

    public function test_a_thread_belongs_to_a_channel()
    {
        $thread = factory('App\Thread')->create();

        $this->assertInstanceOf('App\Channel', $thread->channel);
    }

    public function test_a_user_email()
    {
        $user = factory('App\User')->create(['email' => 'cool@temp.com']);

        $this->assertDatabaseHas('Users', ['email' => 'cool@temp.com']);
    }
}
