<?php

namespace Ram\SavonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Produit
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ram\SavonBundle\Entity\ProduitRepository")
 */
class Produit
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
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="type_peaux", type="string", length=30, nullable = true)
     */
    private $typePeaux;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Ram\SavonBundle\Entity\Recette", mappedBy="produit")
     */
    private $recettes;

    /**
     * @ORM\OneToMany(targetEntity="Ram\SavonBundle\Entity\Serie", mappedBy="produit")
     */
    private $series;

    /**
     * @ORM\OneToOne(targetEntity="Ram\SavonBundle\Entity\Image", cascade={"persist"})
     */
    private $image;

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
        $this->recettes = new ArrayCollection();
        $this->series = new ArrayCollection();
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
     * @return Produit
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
     * Set type
     *
     * @param string $type
     *
     * @return Produit
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set typePeaux
     *
     * @param string $typePeaux
     *
     * @return Produit
     */
    public function setTypePeaux($typePeaux)
    {
        $this->typePeaux = $typePeaux;

        return $this;
    }

    /**
     * Get typePeaux
     *
     * @return string
     */
    public function getTypePeaux()
    {
        return $this->typePeaux;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
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
     * @return Produit
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
     * @return Produit
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
     * @return Produit
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
     * Add recette
     *
     * @param \Ram\SavonBundle\Entity\Recette $recette
     *
     * @return Produit
     */
    public function addRecette(\Ram\SavonBundle\Entity\Recette $recette)
    {
        $this->recettes[] = $recette;

        return $this;
    }

    /**
     * Remove recette
     *
     * @param \Ram\SavonBundle\Entity\Recette $recette
     */
    public function removeRecette(\Ram\SavonBundle\Entity\Recette $recette)
    {
        $this->recettes->removeElement($recette);
    }

    /**
     * Get recettes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecettes()
    {
        return $this->recettes;
    }

    /**
     * Add series
     *
     * @param \Ram\SavonBundle\Entity\Serie $series
     *
     * @return Produit
     */
    public function addSeries(\Ram\SavonBundle\Entity\Serie $series)
    {
        $this->series[] = $series;

        return $this;
    }

    /**
     * Remove series
     *
     * @param \Ram\SavonBundle\Entity\Serie $series
     */
    public function removeSeries(\Ram\SavonBundle\Entity\Serie $series)
    {
        $this->series->removeElement($series);
    }

    /**
     * Get series
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * Set image
     *
     * @param \Ram\SavonBundle\Entity\Image $image
     *
     * @return Produit
     */
    public function setImage(\Ram\SavonBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Ram\SavonBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
