<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClienteRepository")
 */
class Cliente
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
     * @Assert\NotBlank(message="El nombre no puede quedar en blanco")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255)
     *@Assert\NotBlank(message="El apellido no puede quedar en blanco")
     */
    private $apellido;

    /**
     * @var int
     *
     * @ORM\Column(name="dni", type="integer", unique=true)
     * @Assert\Range(
     *      min = 5000000,
     *      max = 99999999,
     *      minMessage = "debe ser mayor a 5000000",
     *      maxMessage = "debe ser menor a 99999999"
     * )
     */
    private $dni;

    /**
     *@ORM\OneToMany(targetEntity="Cliente", mappedBy="cliente")
     */
    private $pedidos;

	public function __construct() {
		$this->pedidos = new ArrayCollection();
	}

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
     * @return Cliente
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Cliente
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set dni
     *
     * @param integer $dni
     *
     * @return Cliente
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return int
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param \AppBundle\Entity\Pedido $pedido
     *
     * @return Cliente
     */
    public function addPedido($pedido)
    {
        $this->pedidos[] = $pedido;

        return $this;
    }


    /**
     * @param \AppBundle\Entity\Pedido $pedido
     *
     * @return Cliente
     */
    public function removePedido($pedido)
    {
        $this->pedidos->removeElement($pedido);

        return $this;
    }

    /**
     * Get pedidos
     *
     * @return \stdClass
     */
    public function getPedidos()
    {
        return $this->pedidos;
    }

    public function __toString()
    {
      return $this->nombre;
    }
}
