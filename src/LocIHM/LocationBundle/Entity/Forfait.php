<?php

namespace LocIHM\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Forfait
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LocIHM\LocationBundle\Entity\ForfaitRepository")
 */
class Forfait
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
     * @ORM\Column(name="kminclus", type="integer")
     */
    private $kminclus;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
    * @ORM\OneToMany(targetEntity="LocIHM\LocationBundle\Entity\Contrat", mappedBy="forfait")
    */
    private $contrats;

    /**
    * Constructor
    */
    public function __construct()
    {
        $this->contrats = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Forfait
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
     * Set kminclus
     *
     * @param integer $kminclus
     * @return Forfait
     */
    public function setKminclus($kminclus)
    {
        $this->kminclus = $kminclus;

        return $this;
    }

    /**
     * Get kminclus
     *
     * @return integer 
     */
    public function getKminclus()
    {
        return $this->kminclus;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return Forfait
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Add contrats
     *
     * @param \LocIHM\LocationBundle\Entity\Vehicule $contrats
     * @return Forfait
     */
    public function addContrat(\LocIHM\LocationBundle\Entity\Vehicule $contrat)
    {
        $this->contrats[] = $contrat;
        $contrat->setForfait($this);

        return $this;
    }

    /**
     * Remove contrats
     *
     * @param \LocIHM\LocationBundle\Entity\Vehicule $contrats
     */
    public function removeContrat(\LocIHM\LocationBundle\Entity\Vehicule $contrats)
    {
        $this->contrats->removeElement($contrats);
    }

    /**
     * Get contrats
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContrats()
    {
        return $this->contrats;
    }
}
