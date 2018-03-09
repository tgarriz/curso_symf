<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * PedidoCerveza
 *
 * @ORM\Table(name="pedido_cerveza")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PedidoCervezaRepository")
 */
class PedidoCerveza
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
     * @var int
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;

	/**
	 * @ORM\ManyToOne(targetEntity="Pedido")
	 * @ORM\JoinColumn(name="pedido_id", referencedColumnName="id")
     */
    private $pedido;

    /**
	 * @ORM\ManyToOne(targetEntity="Cerveza")
	 * @ORM\JoinColumn(name="cerveza_id", referencedColumnName="id")
     */
    private $cerveza;


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
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return PedidoCerveza
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return int
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set pedido
     *
     * @param \AppBundle\Entity\Pedido $pedido
     *
     * @return PedidoCerveza
     */
    public function setPedido($pedido = null)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Get pedido
     *
     * @return \AppBundle\Entity\Pedido
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set cerveza
     *
     * @param \AppBundle\Entity\Cerveza $cerveza
     *
     * @return PedidoCerveza
     */
    public function setCerveza($cerveza = null)
    {
        $this->cerveza = $cerveza;

        return $this;
    }

    /**
     * Get cerveza
     *
     * @return \AppBundle\Entity\Cerveza
     */
    public function getCerveza()
    {
        return $this->cerveza;
    }
}
