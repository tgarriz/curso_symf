<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cerveza
 *
 * @ORM\Table(name="cerveza")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CervezaRepository")
 */
class Cerveza
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
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     * @Assert\NotBlank(message="El nombre no puede quedar en blanco")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="decimal", precision=10, scale=2, nullable=true)
    *  @Assert\Range(
    *      min = 0,
    *      max = 999,
    *      minMessage = "El porcentaje debe ser un numero entre 0 y 999",
    *      maxMessage = "El porcentaje debe ser un numero entre 0 y 999"
    * )
     */
    private $precio;

    /**
     * @var bool
     *
     * @ORM\Column(name="destacada", type="boolean", nullable=true)
     */
    private $destacada;

    /**
     * @var int
     *
     * @ORM\Column(name="alcohol", type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 99,
     *      minMessage = "El porcentaje debe ser un numero entre 0 y 99",
     *      maxMessage = "El porcentaje debe ser un numero entre 0 y 99"
     * )

     */
    private $alcohol;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @var int
     *
     * @ORM\Column(name="presentacion", type="integer", nullable=true)
     */
    private $presentacion;

    /**
	 * @ORM\ManyToOne(targetEntity="Estilo")
	 * @ORM\JoinColumn(name="estilo_id", referencedColumnName="id")
     */
    private $estilo;

    /**
	 * @ORM\ManyToOne(targetEntity="Color")
	 * @ORM\JoinColumn(name="color_id", referencedColumnName="id")
     */
    private $color;

    /**
     *
	 * @ORM\ManyToOne(targetEntity="Origen")
	 * @ORM\JoinColumn(name="origen_id", referencedColumnName="id")
     */
    private $origen;

    /**
     * @var bool
     *
     * @ORM\Column(name="promo", type="boolean", nullable=true)
     */
    private $promo;

    /**
	 *
	 * @ORM\OneToMany(targetEntity="PedidoCerveza", mappedBy="cerveza")
     */
    private $pedidosCervezas;

	public function __contruct(){
		$this->pedidosCervezas = new ArrayCollection();
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
     * @return Cerveza
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Cerveza
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set precio
     *
     * @param string $precio
     *
     * @return Cerveza
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set destacada
     *
     * @param boolean $destacada
     *
     * @return Cerveza
     */
    public function setDestacada($destacada)
    {
        $this->destacada = $destacada;

        return $this;
    }

    /**
     * Get destacada
     *
     * @return bool
     */
    public function getDestacada()
    {
        return $this->destacada;
    }

    /**
     * Set alcohol
     *
     * @param integer $alcohol
     *
     * @return Cerveza
     */
    public function setAlcohol($alcohol)
    {
        $this->alcohol = $alcohol;

        return $this;
    }

    /**
     * Get alcohol
     *
     * @return int
     */
    public function getAlcohol()
    {
        return $this->alcohol;
    }

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return Cerveza
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set presentacion
     *
     * @param integer $presentacion
     *
     * @return Cerveza
     */
    public function setPresentacion($presentacion)
    {
        $this->presentacion = $presentacion;

        return $this;
    }

    /**
     * Get presentacion
     *
     * @return int
     */
    public function getPresentacion()
    {
        return $this->presentacion;
    }

    /**
     * Set estilo
     *
     * @param \stdClass $estilo
     *
     * @return Cerveza
     */
    public function setEstilo($estilo)
    {
        $this->estilo = $estilo;

        return $this;
    }

    /**
     * Get estilo
     *
     * @return \stdClass
     */
    public function getEstilo()
    {
        return $this->estilo;
    }

    /**
     * Set color
     *
     * @param \stdClass $color
     *
     * @return Cerveza
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return \stdClass
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set origen
     *
     * @param \stdClass $origen
     *
     * @return Cerveza
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return \stdClass
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set promo
     *
     * @param boolean $promo
     *
     * @return Cerveza
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * Get promo
     *
     * @return bool
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * Get pedidosCervezas
     *
     * @return \stdClass
     */
    public function getPedidosCervezas()
    {
        return $this->pedidosCervezas;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pedidosCervezas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add pedidosCerveza
     *
     * @param \AppBundle\Entity\PedidoCerveza $pedidosCerveza
     *
     * @return Cerveza
     */
    public function addPedidosCerveza(\AppBundle\Entity\PedidoCerveza $pedidosCerveza)
    {
        $this->pedidosCervezas[] = $pedidosCerveza;

        return $this;
    }

    /**
     * Remove pedidosCerveza
     *
     * @param \AppBundle\Entity\PedidoCerveza $pedidosCerveza
     */
    public function removePedidosCerveza(\AppBundle\Entity\PedidoCerveza $pedidosCerveza)
    {
        $this->pedidosCervezas->removeElement($pedidosCerveza);
    }
}
