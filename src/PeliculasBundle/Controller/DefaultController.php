<?php

namespace PeliculasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PeliculasBundle\Entity\Pelicula;

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
     * @Route("/alquilerp")
     */
    public function alquilerPAction()
    {
        return $this->render('PeliculasBundle:Default:alquilerp.html.twig');
    }
    /**
     * @Route("/alquilerl")
     */
    public function alquilerLAction()
    {
        return $this->render('PeliculasBundle:Default:alquilerl.html.twig');
    }
    /**
     * @Route("/insertarp")
     */
    public function insertarPAction()
    {
        return $this->render('PeliculasBundle:Default:insertarp.html.twig');
    }
    /**
     * @Route("/insertarl")
     */
    public function insertarLAction()
    {
      return $this->render('PeliculasBundle:Default:insertarl.html.twig');
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
     * @Route("/pelicula/{genero}", name="peliculas_genero")
     */
    public function peliculasActionGenero($genero)
    {

        $repository = $this->getDoctrine()->getRepository(Pelicula::class);
        $pelicula = $repository->findByGenero($genero);
        return $this->render('PeliculasBundle:Default:peliculas.html.twig', array('pelicula' => $pelicula));
    }
    /**
     * @Route("/pelicula", name="peliculas_genero2")
     */
    public function peliculasActionGeneros()
    {
        $genero = "Acción";
        $repository = $this->getDoctrine()->getRepository(Pelicula::class);
        $pelicula = $repository->findByGenero($genero);
        return $this->render('PeliculasBundle:Default:peliculas.html.twig', array('pelicula' => $pelicula));
    }
    /**
     * @Route("/mostrar/{id}", name="peliculas_id")
     */
    public function peliculaActionId($id)
    {
        $repository = $this->getDoctrine()->getRepository(Pelicula::class);
        $pelicula = $repository->find($id);
        return $this->render('PeliculasBundle:Default:pelicula.html.twig', array('pelicula' => $pelicula));
    }
    /**
     * @Route("/libros", name="libros")
     */
    public function librosAction()
    {
        return $this->render('PeliculasBundle:Default:libros.html.twig');
    }
    /**
     * @Route("/registro", name="registro")
     */
    public function registroAction()
    {
        return $this->render('PeliculasBundle:Default:registro.html.twig');
    }
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        return $this->render('PeliculasBundle:Default:login.html.twig');
    }
    /**
     * @Route("/contacto", name="contacto")
     */
    public function contactoAction()
    {
        return $this->render('PeliculasBundle:Default:contacto.html.twig');
    }
}
