<?php
/**
 * Created by PhpStorm.
 * User: PC09
 * Date: 2/18/2018
 * Time: 8:55 AM
 */

namespace VeterinaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use VeterinaireBundle\Entity\HWCalculator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HWCalculatorController extends Controller
{
    public function indexAction()
    {
        return $this->render('VeterinaireBundle:HWCalculator:Layout.html.twig', array(
            // ...
        ));
    }

    public function validateAction(Request $request){

        $HWEntity = new HWCalculator();
        if($request->isMethod('POST')) {

            $HWEntity->setNomAnimal($request->get('nom_animal'));
            $HWEntity->setPoidAnimal($request->get('poid_animal'));
            $HWEntity->setTypeAnimal($request->get('type_animal'));
            $HWEntity->setNiveauActivite($request->get('niveau_activite'));
            $HWEntity->setNeutered($request->get('neutered'));

            //$this->get('session')->set('HWEntity', $HWEntity);

            $session = new Session();
            $session->start();

            $session->set('HWEntity', $HWEntity);

            return $this->redirectToRoute('validate');
        }
        return $this->render('VeterinaireBundle:HWCalculator:HWResult.html.twig',['HWEntity'=>$HWEntity]);
    }
    public function HWResultAction(Request $request){

        $request->request->get('HWEntity');
        $HWEntity = new HWCalculator();
        $HWEntity->setNomAnimal($request->get('nom_animal'));
        $HWEntity->setPoidAnimal($request->get('poid_animal'));
        $HWEntity->setTypeAnimal($request->get('type_animal'));
        $HWEntity->setNiveauActivite($request->get('niveau_activite'));
        $HWEntity->setNeutered($request->get('neutered'));

        return $this->render('VeterinaireBundle:HWCalculator:HWResult.html.twig',['HWEntity'=>$HWEntity]);
    }

}