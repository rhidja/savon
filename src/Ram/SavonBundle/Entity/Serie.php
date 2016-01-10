<?php

namespace Ram\SavonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Serie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ram\SavonBundle\Entity\SerieRepository")
 */
class Serie
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
     * @ORM\Column(name="num_serie", type="string", length=13)
     */
    private $numSerie;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="string")
     */
    private $quantity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="d_cre", type="datetimetz")
     */
    private $dCre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="Ram\SavonBundle\Entity\Produit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity="Ram\SavonBundle\Entity\Recette")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recette;

    /**
     * @ORM\OneToMany(targetEntity="Ram\SavonBundle\Entity\SerieIngredient", mappedBy="serie")
     */
    private $ingredients;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dCre = new \Datetime();
        $this->ingredients = new ArrayCollection();
    }

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
     * Set numSerie
     *
     * @param string $numSerie
     *
     * @return Serie
     */
    public function setNumSerie($numSerie)
    {
        $this->numSerie = $numSerie;

        return $this;
    }

    /**
     * Get numSerie
     *
     * @return string
     */
    public function getNumSerie()
    {
        return $this->numSerie;
    }

    /**
     * Set quantity
     *
     * @param string $quantity
     *
     * @return Serie
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set dCre
     *
     * @param string $dCre
     *
     * @return Serie
     */
    public function setDCre($dCre)
    {
        $this->dCre = $dCre;

        return $this;
    }

    /**
     * Get dCre
     *
     * @return string
     */
    public function getDCre()
    {
        return $this->dCre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Serie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set produit
     *
     * @param \Ram\SavonBundle\Entity\Produit $produit
     *
     * @return Serie
     */
    public function setProduit(\Ram\SavonBundle\Entity\Produit $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \Ram\SavonBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set recette
     *
     * @param \Ram\SavonBundle\Entity\Recette $recette
     *
     * @return Serie
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
     * Add ingredient
     *
     * @param \Ram\SavonBundle\Entity\SerieIngredient $ingredient
     *
     * @return Serie
     */
    public function addIngredient(\Ram\SavonBundle\Entity\SerieIngredient $ingredient)
    {
        $this->ingredients[] = $ingredient;

        return $this;
    }

    /**
     * Remove ingredient
     *
     * @param \Ram\SavonBundle\Entity\SerieIngredient $ingredient
     */
    public function removeIngredient(\Ram\SavonBundle\Entity\SerieIngredient $ingredient)
    {
        $this->ingredients->removeElement($ingredient);
    }

    /**
     * Get ingredients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }
}
