<?php
/**
 * Created by PhpStorm.
 * User: manuel.renaudineau
 * Date: 29/11/17
 * Time: 09:09
 */

namespace App\DataFixtures\ORM;


use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadArticle extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $article = new Article();

        $article->setContent('blabla');
        $article->setTitle('test');


        $this->addReference('article', $article);

        $manager->persist($article);
        $manager->flush();
    }
}