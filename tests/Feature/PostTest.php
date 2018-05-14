<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_guest_can_access_blog_index()
    {

        $post = factory('App\Post')->create();

        $response = $this->get('/blog'); // Make GET access to blog route

        $response->assertSee($post->title); // Expect to see post
    }

    public function test_a_guest_can_see_comment_when_visit_single_post()
    {
        // Given a post
        $post = factory('App\Post')->create();

        // Post have comment
        $comment = factory('App\Comment')->create(['post_id'=>$post->id]);

        $response = $this->get('blog/'.$post->id);


        // Expect to see comment body
        $response->assertSee($comment->body);
    }

    public function test_a_user_can_create_post()
    {
        $guest = factory('App\User')->create();

        $user = $this->be($guest);

        $post = factory('App\Post')->make();

        $this->post('/post/'.$post->id,$post->toArray());

        $response = $this->get('/blog/'.$post->id);

        $response->assertSee($post->title);
    }

    public function test_a_guest_can_not_create_post()
    {
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $guest = factory('App\User')->create();

        $post = factory('App\Post')->make();

        $this->post('/post', $post->toArray());
    }

    public function test_a_guest_can_not_access_create_post_page()
    {
        $this->get('/blog/create')->assertRedirect('/login');
    }
}
