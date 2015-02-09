<?php

namespace LocIHM\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contrat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LocIHM\LocationBundle\Entity\ContratRepository")
 */
class Contrat
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="datetime")
     */
    private $dateFin;

    /**
     * @ORM\ManyToOne(targetEntity="LocIHM\LocationBundle\Entity\Personne", cascade={"persist"}, inversedBy="contrats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $personne;

    /**
     * @ORM\OneToOne(targetEntity="LocIHM\LocationBundle\Entity\Vehicule", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicule;

    /**
     * @ORM\OneToOne(targetEntity="LocIHM\LocationBundle\Entity\Forfait", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $forfait;

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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Contrat
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Contrat
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set personne
     *
     * @param \LocIHM\LocationBundle\Entity\Personne $personne
     * @return Contrat
     */
    public function setPersonne(\LocIHM\LocationBundle\Entity\Personne $personne)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return \LocIHM\LocationBundle\Entity\Personne 
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * Set vehicule
     *
     * @param \LocIHM\LocationBundle\Entity\Vehicule $vehicule
     * @return Contrat
     */
    public function setVehicule(\LocIHM\LocationBundle\Entity\Vehicule $vehicule)
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    /**
     * Get vehicule
     *
     * @return \LocIHM\LocationBundle\Entity\Vehicule 
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * Set forfait
     *
     * @param \LocIHM\LocationBundle\Entity\Forfait $forfait
     * @return Contrat
     */
    public function setForfait(\LocIHM\LocationBundle\Entity\Forfait $forfait)
    {
        $this->forfait = $forfait;

        return $this;
    }

    /**
     * Get forfait
     *
     * @return \LocIHM\LocationBundle\Entity\Forfait 
     */
    public function getForfait()
    {
        return $this->forfait;
    }
}
