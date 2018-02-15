<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Estilo
 *
 * @ORM\Table(name="estilo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EstiloRepository")
 */
class Estilo
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
     * @ORM\Column(name="descripcion", type="string", length=100, unique=true)
      * @Assert\NotBlank(message = "Espe campo no puede ser vacio")
     */
    private $descripcion;

    /**
	 * @ORM\OneToMany(targetEntity="Cerveza", mappedBy="estilo")
     */
    private $cervezas;

	public function __construct(){
		$this->cervezas = new ArrayCollection();
	}

	public function __toString()
	{
		return $this->descripcion;
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Estilo
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
     * @param \AppBundle\Entity\Cerveza $cerveza
     *
     * @return Estilo
     */
    public function addCerveza($cerveza)
    {
        $this->cervezas[] = $cerveza;

        return $this;
    }

    /**
     * @param \AppBundle\Entity\Cerveza $cerveza
     *
     * @return Estilo
     */
    public function removeCerveza($cerveza)
    {
        $this->cervezas->removeElement($cerveza);

        return $this;
	}

    /**
     * Get cervezas
     *
     * @return \stdClass
     */
    public function getCervezas()
    {
        return $this->cervezas;
    }
}
