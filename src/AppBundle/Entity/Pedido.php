<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PedidoRepository")
 */
class Pedido
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
	 * @ORM\ManyToOne(targetEntity="Cliente")
	 * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
	 *
     */
    private $cliente;

	/**
	 *@ORM\OneToMany(targetEntity="PedidoCerveza", mappedBy="pedido")
	 */
    private $pedidoCervezas;
	
	public function __construct(){
		$this->pedidoCervezas = new ArrayCollection();
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Pedido
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set cliente
     *
     * @param \AppBundle\Entity\Cliente $cliente
     *
     * @return Pedido
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @param \AppBundle\Entity\Cliente $cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set pedidoCervezas
     *
     * @param \AppBundle\Entity\PedidoCerveza $pedidoCervezas
     *
     * @return Pedido
     */
    public function addPedidoCervezas($pedidoCervezas = null)
    {
        $this->pedidoCervezas[] = $pedidoCervezas;

        return $this;
    }

    /**
     * Set pedidoCervezas
     *
     * @param \AppBundle\Entity\PedidoCerveza $pedidoCervezas
     *
     * @return Pedido
     */
    public function removePedidoCervezas($pedidoCervezas)
    {
        $this->pedidoCervezas->removeElement($pedidoCervezas);

        return $this;
    }
    /**
     * Get pedidoCervezas
     *
     * @return \stdClass
     */
    public function getPedidoCervezas()
    {
        return $this->pedidoCervezas;
    }
}

