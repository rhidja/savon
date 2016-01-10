<?php

namespace Ram\SavonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecetteIngredient
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ram\SavonBundle\Entity\RecetteIngredientRepository")
 */
class RecetteIngredient
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
     * @ORM\ManyToOne(targetEntity="Ram\SavonBundle\Entity\Recette")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recette;

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
     * @return RecetteIngredient
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
     * @return RecetteIngredient
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
     * Set recette
     *
     * @param \Ram\SavonBundle\Entity\Recette $recette
     *
     * @return RecetteIngredient
     */
    public function setRecette(\Ram\SavonBundle\Entity\Recette $recette)
    {
        $this->recette = $recette;

        return $this;
    }

    /**
     * Get recette
     *
     * @return \Ram\SavonBundle\Entity\Recette
     */
    public function getRecette()
    {
        return $this->recette;
    }

    /**
     * Set ingredient
     *
     * @param \Ram\SavonBundle\Entity\Ingredient $ingredient
     *
     * @return RecetteIngredient
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
