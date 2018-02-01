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
