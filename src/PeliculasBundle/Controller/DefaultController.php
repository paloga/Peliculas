<?php

namespace PeliculasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PeliculasBundle\Entity\Pelicula;
use PeliculasBundle\Entity\User;
use PeliculasBundle\Form\PeliculaType;
use PeliculasBundle\Form\UserType;
use PeliculasBundle\Entity\Genero;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->render('PeliculasBundle:Default:index.html.twig');
    }


    /**
     * @Route("/registro", name="registro")
     */
    public function registroAction(Request $request)
    {
      // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $roles = ["ROLE_USER"];
            $user->setRoles($roles);


            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('home');
        }
        return $this->render('PeliculasBundle:Default:registro.html.twig', array('form' => $form -> createView()));
    }
    /**
    * @Route("/login", name="login")
    */
   public function loginAction(Request $request)
   {
      $authenticationUtils = $this->get('security.authentication_utils');
       // get the login error if there is one
      $error = $authenticationUtils->getLastAuthenticationError();

      // last username entered by the user
      $lastUsername = $authenticationUtils->getLastUsername();

      return $this->render('PeliculasBundle:Default:login.html.twig', array(
          'last_username' => $lastUsername,
          'error'         => $error,
      ));
   }
    /**
     * @Route("/contacto", name="contacto")
     */
    public function contactoAction()
    {
        return $this->render('PeliculasBundle:Default:contacto.html.twig');
    }

}
