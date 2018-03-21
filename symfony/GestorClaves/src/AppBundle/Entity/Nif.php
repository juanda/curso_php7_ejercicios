<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nif
 *
 * @ORM\Table(name="nif")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NifRepository")
 */
class Nif
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
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;
    
    /**
     * @var AppBundle\Entity\Persona
     * 
     * @ORM\OneToOne(targetEntity="Persona", mappedBy="nif", cascade={"persist"})
     */
    private $persona;


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
     * Set numero
     *
     * @param string $numero
     *
     * @return Nif
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }


    /**
     * Set persona
     *
     * @param \AppBundle\Entity\Persona $persona
     *
     * @return Nif
     */
    public function setPersona(\AppBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;
        $persona->setNif($this);

        return $this;
    }

    /**
     * Get persona
     *
     * @return \AppBundle\Entity\Persona
     */
    public function getPersona()
    {
        return $this->persona;
    }
}
