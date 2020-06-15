<?php

namespace Tests\Feature;

use App\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function it_fetches_trending_articles()
    {
        factory(Article::class, 2)->create();
        factory(Article::class)->create(['reads' => 10]);
        $mostPopular = factory(Article::class)->create(['reads' => 20]);

        $articles = Article::trending();

        $this->assertEquals($mostPopular->id, $articles->first()->id);
        $this->assertCount(3, $articles);

    }
}
