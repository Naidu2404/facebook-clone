<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PostToTimelineTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    #[Test]
    public function a_user_can_post_a_text_post()
    {

        //we need the user and authentication
        //so we create one
        $this->actingAs($user = User::factory()->create(), 'api');

        //we get a response for our post from the backend
        $response = $this->post('/api/posts', [

            'body' => 'Testing Body',
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

    #[Test]
    public function a_user_can_post_a_text_post_with_an_image()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->create(), 'api');

        $file = UploadedFile::fake()->image('user-post.jpg');

        $response = $this->post('/api/posts', [
            'body' => 'Testing Body',
            'image' => $file,
            'width' => 100,
            'height' => 100,
        ]);

        Storage::disk('public')->assertExists('post-images/' . $file->hashName());
        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'attributes' => [
                        'body' => 'Testing Body',
                        'image' => url('post-images/' . $file->hashName()),
                    ],
                ],
            ]);
    }
}