<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="persona")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonaRepository")
 */
class Persona {

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
     * @ORM\OneToOne(targetEntity="Nif", inversedBy="persona", cascade={"persist"})
     * @ORM\JoinColumn(name="nif_id", referencedColumnName="id")
     */
    private $nif;

    /**
     * @ORM\ManyToOne(targetEntity="Direccion", inversedBy="personas", cascade={"persist"})
     * @ORM\JoinColumn(name="direccion_id", referencedColumnName="id")
     */
    private $direccion;

    /**
     * @ORM\ManyToMany(targetEntity="Telefono", cascade={"persist"})
     * @ORM\JoinTable(name="persona_telefono",
     *      joinColumns={@ORM\JoinColumn(name="persona_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="telefono_id", referencedColumnName="id", unique=true)}
     *      )
     * */
    private $telefonos;
    
    /**
     *@ORM\ManyToMany(targetEntity="Grupo", inversedBy="personas", cascade={"persist"})
     *@ORM\JoinTable(name="persona_grupo",
     *      joinColumns={@ORM\JoinColumn(name="persona_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="grupo_id", referencedColumnName=")}
     *      )
     * 
     */
    private $grupos;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Persona
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set nif
     *
     * @param \AppBundle\Entity\Nif $nif
     *
     * @return Persona
     */
    public function setNif(\AppBundle\Entity\Nif $nif = null) {
        $this->nif = $nif;

        return $this;
    }

    /**
     * Get nif
     *
     * @return \AppBundle\Entity\Nif
     */
    public function getNif() {
        return $this->nif;
    }

    /**
     * Set direccion
     *
     * @param \AppBundle\Entity\Direccion $direccion
     *
     * @return Persona
     */
    public function setDireccion(\AppBundle\Entity\Direccion $direccion = null) {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return \AppBundle\Entity\Direccion
     */
    public function getDireccion() {
        return $this->direccion;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->telefonos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add telefono
     *
     * @param \AppBundle\Entity\Telefono $telefono
     *
     * @return Persona
     */
    public function addTelefono(\AppBundle\Entity\Telefono $telefono)
    {
        $this->telefonos[] = $telefono;

        return $this;
    }

    /**
     * Remove telefono
     *
     * @param \AppBundle\Entity\Telefono $telefono
     */
    public function removeTelefono(\AppBundle\Entity\Telefono $telefono)
    {
        $this->telefonos->removeElement($telefono);
    }

    /**
     * Get telefonos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * Add grupo
     *
     * @param \AppBundle\Entity\Grupos $grupo
     *
     * @return Persona
     */
    public function addGrupo(\AppBundle\Entity\Grupo $grupo)
    {
        $this->grupos[] = $grupo;

        return $this;
    }

    /**
     * Remove grupo
     *
     * @param \AppBundle\Entity\Grupos $grupo
     */
    public function removeGrupo(\AppBundle\Entity\Grupo $grupo)
    {
        $this->grupos->removeElement($grupo);
    }

    /**
     * Get grupos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrupos()
    {
        return $this->grupos;
    }
}
