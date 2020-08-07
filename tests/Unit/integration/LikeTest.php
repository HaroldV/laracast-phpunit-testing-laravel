<?php

namespace Tests\Unit\integration;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_like_a_post()
    {
        $post = factory(Post::class)->create();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $post->like();

        $this->assertDatabaseHas('likes', [
           'user_id' => $user->id,
           'likeable_id' => $post->id,
           'likeable_type' => get_class($post)
        ]);

        $this->assertTrue($post->isLiked());
    }

    /** @test */
    public function a_user_can_unlike_a_post()
    {
        $post = factory(Post::class)->create();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $post->like();
        $post->unlike();

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);

        $this->assertFalse($post->isLiked());
    }

    /** @test */
    public function a_user_can_toggle_a_post()
    {
        $post = factory(Post::class)->create();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $post->toggle();
        $this->assertTrue($post->isLiked());

        $post->toggle();
        $this->assertFalse($post->isLiked());
    }

    /** @test */
    public function a_post_knows_how_many_likes_it_has()
    {
        $post = factory(Post::class)->create();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $post->toggle();

        $this->assertEquals(1, $post->likesCount);

    }
}
