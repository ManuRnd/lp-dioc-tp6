<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;

class UpdateArticleHandler
{
    public function handle(Article $article)
    {
        // Slugify le titre et met à jour la date de mise à jour de l'article
        // Log également un article stat avec pour action update.
        \App\Slug\SlugGenerator::class;
        $sl=new SlugGenerator();
        $article->setSlug($sl->generate($article->getTitle()));
    }
}
