<?php

namespace PeliculasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PeliculasBundle\Entity\Pelicula;
use PeliculasBundle\Entity\Genero;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;


class ApiController extends Controller
{
    /**
     * @Route("/get/{id}", methods="GET")
     */
    public function getPeliculasAction($id)
    {
      $repository = $this->getDoctrine()->getRepository(Pelicula::class);
      $pelicula = $repository->find($id);

      $encoder = array(new JsonEncoder());
      $normalizers = array(new ObjectNormalizer());

      $serializer = new Serializer($normalizers, $encoder);
      $json = $serializer->serialize($pelicula, 'json');

      $jsonRespose = JsonResponse::fromJsonString($json);

      return $jsonRespose;

    }

}
