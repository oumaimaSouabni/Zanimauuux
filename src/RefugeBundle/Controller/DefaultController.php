<?php

namespace RefugeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RefugeBundle:Default:index.html.twig');
    }
}
