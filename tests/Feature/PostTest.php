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
}
