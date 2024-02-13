<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RetrievePostsTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_user_can_retrieve_posts()
    {
        $this->withoutExceptionHandling();

        //setting up the user for testing
        $this->actingAs($user = User::factory()->create(), 'api');

        //creating 2 posts
        $posts = Post::factory(2)->create(['user_id' => $user->id]);

        $response = $this->get('/api/posts');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'posts',
                            'post_id' => $posts->last()->id,
                            'attributes' => [
                                'body' => $posts->last()->body,
                            ],
                        ],
                    ],
                    [
                        'data' => [
                            'type' => 'posts',
                            'post_id' => $posts->first()->id,
                            'attributes' => [
                                'body' => $posts->first()->body,
                            ],
                        ],
                    ],
                ],
                'links' => [
                    'self' => url('/posts'),
                ],
            ]);
    }

    public function testAUserCanOnlyRetrieveTheirPosts()
    {
        $this->actingAs($user = User::factory()->create(), 'api');

        $posts = Post::factory()->create();

        $response = $this->get('/api/posts');

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => [],
                'links' => [
                    'self' => url('/posts'),
                ],
            ]);
    }
}