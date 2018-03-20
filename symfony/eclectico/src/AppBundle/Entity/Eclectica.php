<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraint as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @Assert\Callback
 */
class Eclectica {

    private $esVerdad;
    private $name;
    private $email;
    private $ipHost;
    private $puntuacion;
    private $fecha;
    private $difuso;
    private $pais;
    private $numeroPar;

    public function validate(ExecutionContextInterface $context, $payload) {
        if (!(($this->numeroPar % 2) == 0)) {
            $context->buildViolation('El número no es par')
                    ->atPath('numeroPar')
                    ->addViolation();
        }
    }

    /**
     * 
     * @Assert\Type(
     *  type="bool",
     *  message="El valor {{value}} no es un boolean"
     * )
     * 
     * @return bool
     */
    function getEsVerdad() {
        return $this->esVerdad;
    }

    /**
     * 
     * @Assert\Type(
     *  type="string",
     *  message="El valor {{value}} debe ser una cadena"
     * )
     * 
     * @Assert\Length(
     *      min = 5,
     *      max = 10,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * 
     * @return type
     */
    function getName() {
        return $this->name;
    }

    /**
     * @Assert\Type(
     *  type="string",
     *  message="El valor {{value}} debe ser una cadena"
     * )
     * 
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @return type
     */
    function getEmail() {
        return $this->email;
    }

    /**
     * 
     * @Assert\Ip
     * 
     * @return type
     */
    function getIpHost() {
        return $this->ipHost;
    }

    /**
     * 
     * @Assert\Type(
     *  type="int",
     *  message="El valor {{value}} debe ser una cadena"
     * )
     * 
     * @Assert\Range(
     *      min = 120,
     *      max = 180,
     *      minMessage = "You must be at least {{ limit }}cm tall to enter",
     *      maxMessage = "You cannot be taller than {{ limit }}cm to enter"
     * )
     * @return type
     */
    function getPuntuacion() {
        return $this->puntuacion;
    }

    /**
     * @Assert\Date()
     * @return type
     */
    function getFecha() {
        return $this->fecha;
    }

    /**
     * @Assert\Choice({"Blanco", "Negro", "Gris"})
     * @return type
     */
    function getDifuso() {
        return $this->difuso;
    }

    /**
     * 
     * @Assert\Country()
     * @return type
     */
    function getPais() {
        return $this->pais;
    }

    function getNumeroPar() {
        return $this->numeroPar;
    }

    function setEsVerdad($esVerdad) {
        $this->esVerdad = $esVerdad;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setIpHost($ipHost) {
        $this->ipHost = $ipHost;
    }

    function setPuntuacion($puntuacion) {
        $this->puntuacion = $puntuacion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setDifuso($difuso) {
        $this->difuso = $difuso;
    }

    function setPais($pais) {
        $this->pais = $pais;
    }

    function setNumeroPar($numeroPar) {
        $this->numeroPar = $numeroPar;
    }

}
