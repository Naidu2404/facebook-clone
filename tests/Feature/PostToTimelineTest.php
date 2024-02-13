<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PostToTimelineTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    #[Test]
    public function a_user_can_post_a_text_post()
    {
        //we avoid exception handling to get detailed error
        $this->withoutExceptionHandling();

        //we need the user and authentication
        //so we create one
        $this->actingAs($user = User::factory()->create(), 'api');

        //we get a response for our post from the backend
        $response = $this->post('/api/posts', [
            'data' => [
                'type' => 'posts',
                'attributes' => [
                    'body' => 'Testing Body',
                ],
            ],
        ]);

        $post = Post::first();

        $this->assertCount(1, Post::all());

        //checking value of the post we retrieved
        $this->assertEquals($user->id, $post->user_id);
        $this->assertEquals('Testing Body', $post->body);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'posts',
                    'post_id' => $post->id,
                    'attributes' => [
                        'posted_by' => [
                            'data' => [
                                'attributes' => [
                                    'name' => $user->name,
                                ],
                            ],
                        ],
                        'body' => 'Testing Body',
                    ],
                ],
                'links' => [
                    'self' => url('/posts/' . $post->id),
                ],
            ]);
    }
}