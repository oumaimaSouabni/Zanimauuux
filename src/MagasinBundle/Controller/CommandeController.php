<?php

namespace MagasinBundle\Controller;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Swift_Attachment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\DateTime;
use MagasinBundle\Entity\ContenuPanier;
use MagasinBundle\Entity\Magasin;
use MagasinBundle\Entity\Panier;

class CommandeController extends Controller
{
    public function afficheCommandeAction()
    {
        $user=$this->getUser();
        $em=$this->getDoctrine()->getManager();
        $cPanier=$em->getRepository(ContenuPanier::class)->getProduitPanier($user,1);
        $date=$em->getRepository(ContenuPanier::class)->findMinDateCommande($user);
        //j'ai créé un service pour pouvoir passer ma variable $test, qui compte le nombre de jour entre une date actuel et la date de passage de commande à mon script
        foreach ($date as $p)
        {   $date2=date_parse($p);
        }
        $jour=$date2['day'];
        $date=new \DateTime("now");
        $p=$date->format('Y-m-d');
        $date2=date_parse($p);
        $jour1=$date2['day'];
        if($jour1>=$jour)
        {
            $test=$jour1-$jour;
        }
        else
        {
            $test=(30-$jour)+$jour1;
        }
        //le service se trouve sous # Resources/config/services.yml
        //j'ai passer ce service à twig.globalspour rendre le service disponible dans toutes les vues
        $this->get('acme.js_vars')->chartData=$test;

        return $this->render('MagasinBundle:Commande:affiche_commande.html.twig',array('cPanier'=>$cPanier,'test'=>$test
            // ...
        ));
    }

    public function passeCommandeAction()
    {
        $user=$this->getUser();
        $em=$this->getDoctrine()->getManager();
        $cPanier=$em->getRepository(ContenuPanier::class)->getProduitPanier($user,0);
        $panier=$em->getRepository(Panier::class)->findPanier($user);
        $panier->setSommeCommande($panier->getSommeCommande()+$panier->getSomme());
        $panier->setSomme(0);
        $em->persist($panier);
        $em->flush();
        foreach ($cPanier as $p)
        {   $p->setDateCommande(new \DateTime("now"));
            $p->setCommande(true);
            $em->persist($p);
            $em->flush();
        }
        $cPanier1=$em->getRepository(ContenuPanier::class)->getProduitPanier($user,1);

         /*$this->get('knp_snappy.pdf')->generateFromHtml(
              $this->renderView(
                  'ZanimauxBundle:Commande:facture.html.twig',
                  array(
                      'cPanier'=>$cPanier1,
                      'panier'=>$panier
                  )
              ),
              'file1.pdf'
          );


         $message=\Swift_Message::newInstance()
              ->setSubject('Votre Commande Zanimaux')
              ->setFrom('zanimo.esprit@gmail.com')
              ->setTo($user->getEmail())
              ->setBody("commande")
             ->attach(Swift_Attachment::fromPath('file1.pdf'));

          $this->get('mailer')->send($message);*/
        return $this->render('MagasinBundle:Commande:affiche_commande.html.twig',array('cPanier'=>$cPanier1,'panier'=>$panier));

    }

    public function suppCommandeAction()
    {
        $user=$this->getUser();
        $em=$this->getDoctrine()->getManager();
        $cPanier=$em->getRepository(ContenuPanier::class)->getProduitCommande($user) ;
        foreach ($cPanier as $p) {

            $em->remove($p);
            $em->flush();
        }
        $magasins = $this->getDoctrine()
            ->getRepository(Magasin::class)->findAll();
        return $this->render('MagasinBundle:Magasin:afficheConnecté.html.twig',['magasins' => $magasins]);

    }

}
