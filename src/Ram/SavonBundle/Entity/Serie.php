<?php

namespace Ram\SavonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var \DateTime
     *
     * @ORM\Column(name="quantite", type="datetime")
     */
    private $quantite;

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
     * Set quantite
     *
     * @param \DateTime $quantite
     *
     * @return Serie
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return \DateTime
     */
    public function getQuantite()
    {
        return $this->quantite;
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
}
