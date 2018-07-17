<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function test_guest_may_not_create_thread()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray())
            ->assertSee($thread->id);
    }

    public function test_guest_cannot_see_create_page()
    {
        $this->withExceptionHandling()
            ->get('/threads/create')
            ->assertRedirect('/login');
    }

    public function test_a_authenticated_user_can_create_new_forum_threads()
    {

        $this->signIn();

        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }
}
