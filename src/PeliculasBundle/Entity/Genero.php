<?php

namespace PeliculasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genero
 *
 * @ORM\Table(name="genero")
 * @ORM\Entity(repositoryClass="PeliculasBundle\Repository\GeneroRepository")
 */
class Genero
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255)
     */
    private $tipo;

    /**
     * @ORM\OneToMany(targetEntity="Pelicula", mappedBy="genero")
     */
    private $peliculas;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Genero
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}
