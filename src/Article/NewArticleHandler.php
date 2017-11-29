<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class NewArticleHandler
{
    public function handle(Article $article): void
    {
        \App\Slug\SlugGenerator::class;
        $sl=new SlugGenerator();
        $article->setSlug($sl->generate($article->getTitle()));

       /* TokenStorage::class;
        $tokenStorage=new TokenStorage();
        $article->setAuthor($tokenStorage->getToken()->getUser());*/

        // Slugify le titre et ajoute l'utilisateur courant comme auteur de l'article
        // Log également un article stat avec pour action create.


    }
}
