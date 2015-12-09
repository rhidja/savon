<?php

namespace Ram\SavonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Composition
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ram\SavonBundle\Entity\CompositionRepository")
 */
class Composition
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
     * @var string
     *
     * @ORM\Column(name="quantite", type="decimal")
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="unite", type="string", length=10)
     */
    private $unite;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantite
     *
     * @param string $quantite
     *
     * @return Composition
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return string
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set unite
     *
     * @param string $unite
     *
     * @return Composition
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
     * @return Composition
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
     * @return Composition
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
