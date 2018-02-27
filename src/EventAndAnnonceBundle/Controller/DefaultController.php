<?php

namespace EventAndAnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EventAndAnnonceBundle:Default:index.html.twig');
    }
}
