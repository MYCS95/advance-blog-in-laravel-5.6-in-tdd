<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_comment_should_has_creator()
    {
        $comment = factory('App\Comment')->create();

        $this->assertInstanceOf('App\User', $comment->creator);
    }
}
