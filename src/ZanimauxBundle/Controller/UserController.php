<?php

namespace ZanimauxBundle\Controller;

use FOS\UserBundle\Model\User;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;

class UserController extends Controller
{
    public function afficheAction()
    {
        return $this->render('ZanimauxBundle::Layout.html.twig', array(
            // ...
        ));
    }
    public function inscritAction(Request $request)
    {
        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }
        return $this->render('ZanimauxBundle::Template2.html.twig', array('form' => $form->createView(),
            // ...
        ));
    }
    public function loginAction(Request $request)
    {
        /** @var $session Session */
        $session = $request->getSession();

        $authErrorKey = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        $csrfToken = $this->has('security.csrf.token_manager')
            ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
            : null;

        return $this->renderLogin(array(
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
        ));
    }
    protected function renderLogin(array $data)
    {
        return $this->render('ZanimauxBundle::Login.html.twig', $data);
    }
    public function checkAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }
    public function logoutAction()
    {

        return $this->render('ZanimauxBundle:User:Layout2.html.twig', array(
            // ...
        ));
    }
    public function redirectAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('ZanimauxBundle:User:Layout2.html.twig', array(
            'user' => $user,
        ));
    }
    public function editAction($id)
    {
        //renvoi les users
        $userManager = $this->get('fos_user.user_manager');
        $userss = $userManager->findUsers();

        //supprimer les user
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository("ZanimauxBundle:User")
            ->find($id);
        $em->remove($users);
        $em->flush();
        echo 'DELETED';
        return $this->redirectToRoute('gereruser');}
    public function showAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('ZanimauxBundle:User:profile.html.twig', array(
            'user' => $user,
        ));
    }
    public function adminuserAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        //affiche donnees utilisateur
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return $this->render('ZanimauxBundle:User:gestionUtilisateur.html.twig', array(
            'users' => $users,
            'user'=>$user
        ));

    }
    public function admingererAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return $this->render('RefugeBundle:dashbord:propRegugeAccueil.html.twig', array(
            'users' => $users,
        ));


    }

    public function updateVetAction(Request $request ){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }



        $em = $this->getDoctrine()->getManager();

        $vet = $em->getRepository("ZanimauxBundle:User")->find($user);
        if($request->isMethod('POST')) {

            $vet->setEmail($request->get('email'));
            $vet->setTelephone($request->get('telephone'));
            $vet->setNom($request->get('nom'));
            $vet->setPrenom($request->get('prenom'));
            $vet->setAdresse($request->get('adresse'));
            $vet->setVille($request->get('ville'));
            $vet->setCodePostale($request->get('codePostale'));
            $vet->setNumeroOrdre($request->get('numeroOrdre'));
            $em->persist($vet);
            $em->flush();
            return $this->redirectToRoute('afficheCabinet');
        }
        return $this->render('@Zanimaux/User/updateVet.html.twig', array(
            'user' => $vet,));

    }
//Afficher design admin

    public function adminAfficheAction()
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $em=$this->getDoctrine()->getRepository(\ZanimauxBundle\Entity\User::class);
        //ROLE MAGASIN NOMBRE DE USER
        $n = $em ->count1DQL('a:1:{i:0;s:25:"ROLE_PROPRIETAIRE_MAGASIN";}');
        $ni=$n[0]['nb'];
        $nm = (int)$ni;
        //ROLE DRESSEUR NOMBRE DE USER
        $n2 = $em ->count1DQL('a:1:{i:0;s:13:"ROLE_DRESSEUR";}');
        $ni=$n2[0]['nb'];
        $nd = (int)$ni;
        //ROLE CLIENT NOMBRE DE USER
        $n3 = $em ->count1DQL('a:1:{i:0;s:11:"ROLE_CLIENT";}');
        $ni=$n3[0]['nb'];
        $nc = (int)$ni;
        //ROLE PetSitter
        $n4 = $em ->count1DQL('a:1:{i:0;s:14:"ROLE_PETSITTER";}');
        $ni=$n4[0]['nb'];
        $np = (int)$ni;
        //ROLE PetSitter
        $n4 = $em ->count1DQL('a:1:{i:0;s:14:"ROLE_PETSITTER";}');
        $ni=$n4[0]['nb'];
        $np = (int)$ni;
        //ROLE Prop refuge
        $n5 = $em ->count1DQL('a:1:{i:0;s:24:"ROLE_PROPRIETAIRE_REFUGE";}');
        $ni=$n5[0]['nb'];
        $nr = (int)$ni;
        //ROLE Prop refuge
        $n6 = $em ->count1DQL('a:1:{i:0;s:15:"ROLE_VETRINAIRE";}');
        $ni=$n6[0]['nb'];
        $nv = (int)$ni;


        $roles=array('Dresseur', 'veterinaire','Client','PetSitter','Responsable magasin', 'Responsable refuge');

        $series = array(
            array("Prix" => "",    "data" => array($nd,$nv,$nc,$np,$nm,$nr))
        );
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->chart->type('column');
        $ob->title->text('Nombre de user');
        $ob->xAxis->title(array('text'  => "Les roles", 'style' => array('color' => 'black', 'font-size'=>17)));
        $ob->xAxis->categories($roles);
        $ob->yAxis->title(array('text'  => "Nombre", 'style' => array('color' => 'black', 'font-size'=>17)));
        $ob->yAxis->categories(0);
        $ob->series($series);

        return $this->render('ZanimauxBundle:User:dashboard.html.twig',array(
                'chart' => $ob,
                'user' => $user,
            )
        );

    }

//Modifier info utilisateurs(admin)

    public function adminEditUserAction(Request $request,$id ){
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();

        $admin = $em->getRepository("ZanimauxBundle:User")->find($id);
        $form = $this->createFormBuilder($admin)
            ->add('username',TextType::class)
            ->add('email',TextType::class)
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('adresse',TextType::class)
            ->add('ville',TextType::class)
            ->add('codePostale',TextType::class)
            ->add('roles', ChoiceType::class, array(
                'choices' => array(
                    'Admin'=> 'ROLE_SUPER_ADMIN',
                    'VETERINAIRE' => 'ROLE_VETERINAIRE',
                    'CLIENT' => 'ROLE_CLIENT',
                    'DRESSEUR' => 'ROLE_DRESSEUR',
                    'PROPRIETAIRE MAGASIN' => 'ROLE_PROPRIETAIRE_MAGASIN',
                    'PROPRIETAIRE REFUGE' => 'ROLE_PROPRIETAIRE_REFUGE' ),
                'required' => true, 'multiple' => true,))
            ->add('telephone',TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Mettre à jour'))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $admin= $form->getData();
            $em->persist($admin);
            $em->flush();
            return $this->redirectToRoute('gereruser');

        }
        return $this->render('ZanimauxBundle:User:ModifUser.html.twig', array(
                'user' => $user,
                'form' => $form->createView(),)
        );
    }


}
