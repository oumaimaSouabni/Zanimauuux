<?php

namespace PetSitterDresseurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PetSitterDresseurBundle:Default:index.html.twig');
    }
}
