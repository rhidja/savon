<?php

namespace Ram\SavonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SerieIngredient
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ram\SavonBundle\Entity\SerieIngredientRepository")
 */
class SerieIngredient
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ram\SavonBundle\Entity\Serie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $serie;

    /**
     * @ORM\ManyToOne(targetEntity="Ram\SavonBundle\Entity\Ingredient")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredient;

    /**
     * @var float
     *
     * @ORM\Column(name="Quantity", type="float")
     */
    private $quantity;


    /**
     * @var string
     *
     * @ORM\Column(name="Unite", type="string", length=255)
     */
    private $unite;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param float $quantity
     *
     * @return SerieIngredient
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set unite
     *
     * @param string $unite
     *
     * @return SerieIngredient
     */
    public function setUnite($unite)
    {
        $this->unite = $unite;

        return $this;
    }

    /**
     * Get unite
     *
     * @return string
     */
    public function getUnite()
    {
        return $this->unite;
    }

    /**
     * Set serie
     *
     * @param \Ram\SavonBundle\Entity\Serie $serie
     *
     * @return SerieIngredient
     */
    public function setSerie(\Ram\SavonBundle\Entity\Serie $serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return \Ram\SavonBundle\Entity\Serie
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set ingredient
     *
     * @param \Ram\SavonBundle\Entity\Ingredient $ingredient
     *
     * @return SerieIngredient
     */
    public function setIngredient(\Ram\SavonBundle\Entity\Ingredient $ingredient)
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    /**
     * Get ingredient
     *
     * @return \Ram\SavonBundle\Entity\Ingredient
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }
}
