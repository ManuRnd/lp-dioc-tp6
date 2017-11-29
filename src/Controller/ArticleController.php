<?php

namespace App\Controller;

use App\Article\CountViewUpdater;
use App\Article\NewArticleHandler;
use App\Article\UpdateArticleHandler;
use App\Article\ViewArticleHandler;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Slug\SlugGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route(path="/show/{slug}", name="article_show")
     */
    public function showAction(ViewArticleHandler $articleHandler)
    {

    }

    /**
     * @Route(path="/new", name="article_new")
     */
    public function newAction(NewArticleHandler $newArticleHandler,Request $request)
    {
        if ($this->getUser()->isAuthor() == true) {

            // Seul les auteurs doivent avoir access.
            $form = $this->createForm(ArticleType::class, $article = new Article());
            $form->handleRequest($request);
            $article->setAuthor($this->getUser());
            if ($form->isSubmitted() && $form->isValid()) {

                $em = $this->getDoctrine()->getManager();


                $newArticleHandler->handle($article);
                $em->persist($article);

                $em->flush();
            }

            return $this->render('Article/new.html.twig', ['form' => $form->createView()]);
        }
    }

    /**
     * @Route(path="/update/{slug}", name="article_update")
     */
    public function updateAction(UpdateArticleHandler $updateArticleHandler)
    {
        // Seul les auteurs doivent avoir access.
        // Seul l'auteur de l'article peut le modifier
        if($this->getUser()->isAuthor()==true){
            return $this->render('Article/update.html.twig');
        }
    }
}
