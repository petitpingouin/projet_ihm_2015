<?php

namespace LocIHM\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicule
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LocIHM\LocationBundle\Entity\VehiculeRepository")
 */
class Vehicule
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
     * @ORM\Column(name="marque", type="string", length=255)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=255)
     */
    private $modele;

    /**
     * @var float
     *
     * @ORM\Column(name="puissance", type="float")
     */
    private $puissance;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=255)
     */
    private $couleur;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_journalier", type="float")
     */
    private $prixJournalier;

    /**
     * @ORM\ManyToOne(targetEntity="LocIHM\LocationBundle\Entity\TypeVehicule", cascade={"persist"}, inversedBy="vehicules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeVehicule;

    /**
     * @ORM\ManyToOne(targetEntity="LocIHM\LocationBundle\Entity\Agence")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agence;

    public function __toString(){
        return $this->marque.' '.$this->modele;
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
     * Set marque
     *
     * @param string $marque
     * @return Vehicule
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string 
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set modele
     *
     * @param string $modele
     * @return Vehicule
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string 
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set puissance
     *
     * @param float $puissance
     * @return Vehicule
     */
    public function setPuissance($puissance)
    {
        $this->puissance = $puissance;

        return $this;
    }

    /**
     * Get puissance
     *
     * @return float 
     */
    public function getPuissance()
    {
        return $this->puissance;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     * @return Vehicule
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string 
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set prixJournalier
     *
     * @param float $prixJournalier
     * @return Vehicule
     */
    public function setPrixJournalier($prixJournalier)
    {
        $this->prixJournalier = $prixJournalier;

        return $this;
    }

    /**
     * Get prixJournalier
     *
     * @return float 
     */
    public function getPrixJournalier()
    {
        return $this->prixJournalier;
    }

    /**
     * Set typeVehicule
     *
     * @param \LocIHM\LocationBundle\Entity\TypeVehicule $typeVehicule
     * @return Vehicule
     */
    public function setTypeVehicule(\LocIHM\LocationBundle\Entity\TypeVehicule $typeVehicule)
    {
        $this->typeVehicule = $typeVehicule;

        return $this;
    }

    /**
     * Get typeVehicule
     *
     * @return \LocIHM\LocationBundle\Entity\TypeVehicule 
     */
    public function getTypeVehicule()
    {
        return $this->typeVehicule;
    }

    /**
     * Set agence
     *
     * @param \LocIHM\LocationBundle\Entity\Agence $agence
     * @return Vehicule
     */
    public function setAgence(\LocIHM\LocationBundle\Entity\Agence $agence)
    {
        $this->agence = $agence;

        return $this;
    }

    /**
     * Get agence
     *
     * @return \LocIHM\LocationBundle\Entity\Agence 
     */
    public function getAgence()
    {
        return $this->agence;
    }
}
