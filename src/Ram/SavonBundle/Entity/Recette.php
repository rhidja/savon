<?php

namespace Ram\SavonBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Recette
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ram\SavonBundle\Entity\RecetteRepository")
 */
class Recette
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree_sponification", type="integer")
     */
    private $dureeSponification;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree_cure", type="integer")
     */
    private $dureeCure;
    
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
     * @ORM\OneToMany(targetEntity="Ram\SavonBundle\Entity\RecetteIngredient", mappedBy="recette", cascade={"persist"})
     */
    private $ingredients;

    /**
     * @ORM\OneToMany(targetEntity="Ram\SavonBundle\Entity\RecetteEtape", mappedBy="recette", cascade={"persist"})
     */
    private $etapes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="d_cre", type="datetimetz")
     */
    private $dCre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="d_mod", type="datetimetz", nullable=true)
     */
    private $dMod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="d_sup", type="datetimetz", nullable=true)
     */
    private $dSup;

    public function __construct()
    {
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        $this->dCre = new \Datetime();
        $this->ingredients = new ArrayCollection();
        $this->etapes = new ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Recette
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set dureeSponification
     *
     * @param integer $dureeSponification
     *
     * @return Recette
     */
    public function setDureeSponification($dureeSponification)
    {
        $this->dureeSponification = $dureeSponification;

        return $this;
    }

    /**
     * Get dureeSponification
     *
     * @return integer
     */
    public function getDureeSponification()
    {
        return $this->dureeSponification;
    }

    /**
     * Set dureeCure
     *
     * @param integer $dureeCure
     *
     * @return Recette
     */
    public function setDureeCure($dureeCure)
    {
        $this->dureeCure = $dureeCure;

        return $this;
    }

    /**
     * Get dureeCure
     *
     * @return integer
     */
    public function getDureeCure()
    {
        return $this->dureeCure;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Recette
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
     * Set dCre
     *
     * @param \DateTime $dCre
     *
     * @return Recette
     */
    public function setDCre($dCre)
    {
        $this->dCre = $dCre;

        return $this;
    }

    /**
     * Get dCre
     *
     * @return \DateTime
     */
    public function getDCre()
    {
        return $this->dCre;
    }

    /**
     * Set dMod
     *
     * @param \DateTime $dMod
     *
     * @return Recette
     */
    public function setDMod($dMod)
    {
        $this->dMod = $dMod;

        return $this;
    }

    /**
     * Get dMod
     *
     * @return \DateTime
     */
    public function getDMod()
    {
        return $this->dMod;
    }

    /**
     * Set dSup
     *
     * @param \DateTime $dSup
     *
     * @return Recette
     */
    public function setDSup($dSup)
    {
        $this->dSup = $dSup;

        return $this;
    }

    /**
     * Get dSup
     *
     * @return \DateTime
     */
    public function getDSup()
    {
        return $this->dSup;
    }

    /**
     * Set produit
     *
     * @param \Ram\SavonBundle\Entity\Produit $produit
     *
     * @return Recette
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
     * Add ingredient
     *
     * @param \Ram\SavonBundle\Entity\RecetteIngredient $ingredient
     *
     * @return Recette
     */
    public function addIngredient(\Ram\SavonBundle\Entity\RecetteIngredient $ingredient)
    {
        $this->ingredients[] = $ingredient;

        return $this;
    }

    /**
     * Remove ingredient
     *
     * @param \Ram\SavonBundle\Entity\RecetteIngredient $ingredient
     */
    public function removeIngredient(\Ram\SavonBundle\Entity\RecetteIngredient $ingredient)
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

    /**
     * Add etape
     *
     * @param \Ram\SavonBundle\Entity\RecetteEtape $etape
     *
     * @return Recette
     */
    public function addEtape(\Ram\SavonBundle\Entity\RecetteEtape $etape)
    {
        $this->etapes[] = $etape;

        return $this;
    }

    /**
     * Remove etape
     *
     * @param \Ram\SavonBundle\Entity\RecetteEtape $etape
     */
    public function removeEtape(\Ram\SavonBundle\Entity\RecetteEtape $etape)
    {
        $this->etapes->removeElement($etape);
    }

    /**
     * Get etapes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtapes()
    {
        return $this->etapes;
    }
}
