<?php

namespace Tests\Unit;

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
    public function test_a_post_can_add_a_comments()
    {
        $post = factory('App\Post')->create();

        $post->storeComment([
            'body' => 'Testing',
            'user_id' => 1
        ]);

        $this->assertCount(1, $post->comment);
    }

    public function test_post_has_a_creator()
    {
        $post = factory('App\Post')->create();

        $this->assertInstanceOf('App\User', $post->creator);
    }
}
