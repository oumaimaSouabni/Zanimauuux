<?php

namespace VeterinaireBundle\Controller;

use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VeterinaireBundle\Entity\Article;
use ZanimauxBundle\Entity\User;
use VeterinaireBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;

class ArticleController extends Controller
{

    public function afficherArticlesFrontAction()
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)->findAll();

        return $this->render('VeterinaireBundle:Article:afficherArticlesFront.html.twig',['articles'=>$articles]);


    }


    public function InformationsArticleAction($id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)->find($id);

        return $this->render('VeterinaireBundle:Article:InformationsArticle.html.twig',['article'=>$article]);


    }
    public function afficherArticlesBackAction()
    {   $user=$this->getUser();
        $article=new Article();
        $article->setCin($user);
        $idUser=$article->getCin();
        $em=$this->getDoctrine()->getManager();
        $articles=$em->getRepository("ZanimauxBundle:Article")->RechercheArticle($idUser);

        $notifiableRepo = $em->getRepository('MgiletNotificationBundle:NotifiableNotification')->findAll();


        return $this->render('VeterinaireBundle:Article:afficherArticlesBack.html.twig', array(
            'articles' => $articles,
            'notification'=>$notifiableRepo
        ));}


    public function addArticleAction(Request $request )
    {       $article=new Article();
        $user=$this->getUser();

        if($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $article->setCin($user) ;

            $article->settitre($request->get('titre'));
            $article->setDescription($request->get('description'));
            $article->setpiecejointe($request->get('piecejointe'));
            $manager = $this->get('mgilet.notification');
            $notif = $manager->createNotification('Article Ajouté');
            $notif->setMessage('Article Ajouté');
            $notif->setLink('http://symfony.com/');
            //$notif->setIdarticle($article);

            try {
                $manager->addNotification(array($article), $notif, true);
                // this ->getuser
            } catch (OptimisticLockException $e) {
            }

            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('afficherArticlesBack',['article'=>$article]);

        }
        return $this->render('VeterinaireBundle:Article:addArticle.html.twig');
    }
    public function updateArticleAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository(Article::class)->find($id);

        if($request->isMethod('POST')) {

            $article->settitre($request->get('titre'));
            $article->setDescription($request->get('description'));
            $article->setpiecejointe($request->get('piecejointe'));

            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('afficherArticlesBack');
        }
        return $this->render('VeterinaireBundle:Article:updateArticle.html.twig');

    }

    public function deleteArticleAction($id){

        $em = $this->getDoctrine()->getManager();
        $article=$em->getRepository(Article::class)
            ->find($id);
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute('afficherArticlesBack');
    }


}
