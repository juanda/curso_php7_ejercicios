<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="persona")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonaRepository")
 */
class Persona
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     * @ORM\OneToOne(targetEntity="Nif")
     * @ORM\JoinColumn(name="nif_id", referencedColumnName="id")
     */
    private $nif;

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Persona
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set nif
     *
     * @param \AppBundle\Entity\Nif $nif
     *
     * @return Persona
     */
    public function setNif(\AppBundle\Entity\Nif $nif = null)
    {
        $this->nif = $nif;

        return $this;
    }

    /**
     * Get nif
     *
     * @return \AppBundle\Entity\Nif
     */
    public function getNif()
    {
        return $this->nif;
    }
}
