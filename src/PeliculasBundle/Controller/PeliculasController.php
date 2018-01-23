<?php

namespace PeliculasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PeliculasBundle\Entity\Pelicula;
use PeliculasBundle\Form\PeliculaType;
use PeliculasBundle\Entity\Genero;
use Symfony\Component\HttpFoundation\Request;


class PeliculasController extends Controller
{
  /**
 * @Route("/alquiler")
 */
  public function alquilerPAction()
  {
      return $this->render('PeliculasBundle:Default:alquiler.html.twig');
  }
  /**
   * @Route("/insertar")
   */
  public function insertarPAction(Request $request)
  {
    $repository = $this->getDoctrine()->getRepository(Genero::class);
    $pelicula = new Pelicula();
    $form = $this -> createForm(PeliculaType::Class, $pelicula);
    $form->handleRequest($request);
    if ($form -> isSubmitted()&& $form -> isValid()){
      $pelicula = $form->getData();
      $genero = $repository->find(2);
      $pelicula->setGenero($genero);
      $em = $this->getDoctrine()->getManager();
      $em -> persist($pelicula);
      $em -> flush();
      return $this->redirectToRoute('home');
    }
    return $this->render('PeliculasBundle:Default:insertar.html.twig', array('form' => $form -> createView()));
  }
  /**
   * @Route("/peliculas", name="peliculas")
   */
  public function peliculasAction()
  {
      $repository = $this->getDoctrine()->getRepository(Pelicula::class);
      $pelicula = $repository->findAll();
      return $this->render('PeliculasBundle:Default:peliculas.html.twig', array('pelicula' => $pelicula));
  }

  /**
   * @Route("/mostrar/{id}", name="peliculas_id")
   */
  public function peliculaActionId($id)
  {
      $repository = $this->getDoctrine()->getRepository(Pelicula::class);
      $pelicula = $repository->find($id);
      return $this->render('PeliculasBundle:Default:mostrar.html.twig', array('pelicula' => $pelicula));
  }
  /**
   * @Route("/eliminar/{id}", name="eliminar")
   */
  public function eliminarActionId($id)
  {
      $em = $this->getDoctrine()->getManager();
      $repository = $this->getDoctrine()->getRepository(Pelicula::class);
      $pelicula = $repository->find($id);
      $em->remove($pelicula);
      $em->flush();
      return $this->render('PeliculasBundle:Default:eliminar.html.twig');
  }

  /**
   * @Route("/actualizar/{id}", name="actualizar")
   */
  public function actualizarPAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();
    $pelicula = $em->getRepository(Pelicula::Class)->find($id);
    $form = $this->createForm(PeliculaType::class, $pelicula);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
       $pelicula = $form->getData();
       $em->persist($pelicula);
       $em->flush();
       return $this->redirectToRoute('peliculas');
    }
     return $this->render('PeliculasBundle:Default:insertar.html.twig', array('form' => $form -> createView()));
    }

}
