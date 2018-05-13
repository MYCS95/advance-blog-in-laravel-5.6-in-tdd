<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmitCommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_can_submit_comment()
    {
        $guest = factory('App\User')->create();

        // Authenticate user
        $user = $this->be($guest);

        $post = factory('App\Post')->create();

        $comment = factory('App\Comment')->make();

        $this->post('/blog/'.$post->id.'/comment', $comment->toArray());

        $this->get('/blog/'.$post->id)->assertSee($comment->body);
    }

    public function test_guest_can_not_submit_comment()
    {
        $guest = factory('App\User')->create();

        $post = factory('App\Post')->create();

        $comment = factory('App\Comment')->make();

        $this->post('/blog/'.$post->id.'/comment', $comment->toArray());

        $this->get('/blog/'.$post->id)->assertDontSee($comment->body);
    }
}
