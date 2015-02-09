<?php

namespace LocIHM\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeVehicule
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LocIHM\LocationBundle\Entity\TypeVehiculeRepository")
 */
class TypeVehicule
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
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="ss_categorie", type="string", length=255)
     */
    private $ssCategorie;

    // Défini la relation bidirectionnelle

    /**
     * @ORM\OneToMany(targetEntity="LocIHM\LocationBundle\Entity\Vehicule", mappedBy="typeVehicule")
     */
    private $vehicules;


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
     * @return TypeVehicule
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
     * Set categorie
     *
     * @param string $categorie
     * @return TypeVehicule
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set ssCategorie
     *
     * @param string $ssCategorie
     * @return TypeVehicule
     */
    public function setSsCategorie($ssCategorie)
    {
        $this->ssCategorie = $ssCategorie;

        return $this;
    }

    /**
     * Get ssCategorie
     *
     * @return string 
     */
    public function getSsCategorie()
    {
        return $this->ssCategorie;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vehicules = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add vehicules
     *
     * @param \LocIHM\LocationBundle\Entity\Vehicule $vehicules
     * @return TypeVehicule
     */
    public function addVehicule(\LocIHM\LocationBundle\Entity\Vehicule $vehicule)
    {
        $this->vehicules[] = $vehicule;

        //Lie le type au véhicule
        $vehicule->setTypeVehicule($this);

        return $this;
    }

    /**
     * Remove vehicules
     *
     * @param \LocIHM\LocationBundle\Entity\Vehicule $vehicules
     */
    public function removeVehicule(\LocIHM\LocationBundle\Entity\Vehicule $vehicule)
    {
        $this->vehicules->removeElement($vehicule);
    }

    /**
     * Get vehicules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVehicules()
    {
        return $this->vehicules;
    }
}
