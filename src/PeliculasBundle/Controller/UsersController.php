<?php

namespace PeliculasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PeliculasBundle\Entity\Pelicula;
use PeliculasBundle\Entity\User;
use PeliculasBundle\Form\PeliculaType;
use PeliculasBundle\Form\UserType;
use PeliculasBundle\Form\UsersType;
use PeliculasBundle\Entity\Genero;
use Symfony\Component\HttpFoundation\Request;


class UsersController extends Controller
{
    /**
     * @Route("/admin/usuarios", name="usuarios")
     */
    public function usuariosAction()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findAll();
        return $this->render('PeliculasBundle:Default:usuarios.html.twig', array('user' => $user));
    }

    /**
     * @Route("/admin/registro", name="registro")
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
     * @Route("/admin/eliminaruser/{id}", name="eliminaru")
     */
    public function eliminarUserActionId($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->find($id);
        $em->remove($user);
        $em->flush();
        return $this->render('PeliculasBundle:Default:eliminaru.html.twig');
    }

    /**
     * @Route("/admin/actualizaruser/{id}", name="actualizaru")
     */
    public function actualizarUserAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();
      $user = $em->getRepository(User::Class)->find($id);
      $form = $this->createForm(UsersType::class, $user);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
         $user = $form->getData();
         $em->persist($user);
         $em->flush();
         return $this->redirectToRoute('usuarios');
      }
       return $this->render('PeliculasBundle:Default:actualizaru.html.twig', array('form' => $form -> createView()));
      }

}
