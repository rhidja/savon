<?php

namespace Ram\SavonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="d_cre", type="datetimetz")
     */
    private $dCre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="d_mod", type="datetimetz")
     */
    private $dMod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="d_sup", type="datetimetz")
     */
    private $dSup;


    public function __construct()
    {
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        $this->dCre = new \Datetime();
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
}
