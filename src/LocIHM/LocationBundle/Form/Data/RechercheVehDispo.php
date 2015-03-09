<?php
// src/LocIHM/LocationBundle/Form/Data/rechercheVehDispoData.php

namespace LocIHM\LocationBundle\Form\Data;

use Symfony\Component\Validator\Constraints as Assert;

class RechercheVehDispo
{

    /**
     *  @Assert\NotBlank(message="Veuillez indiquer une catégorie")
     */
	protected $categorie;

    /**
     * @Assert\NotBlank(message="Veuillez indiquer un type")
     */
	protected $type;

    /**
     * @Assert\Date(message="Date de départ invalide")
     */
	protected $dateDepart;

    /**
     * @Assert\Date(message="Date d'arrivée invalide")
     */
	protected $dateArrivee; 

    // Champ pour gérer les formulaires multiples sur une même page
    protected $name;

    public function __construct($name, $categorie)
    {
        $this->name = $name;
        $this->categorie = $categorie;
    }

    /**
     * Gets the value of categorie.
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Sets the value of categorie.
     *
     * @param mixed $categorie the categorie
     *
     * @return string
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Gets the value of type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the value of type.
     *
     * @param mixed $type the type
     *
     * @return string
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Gets the value of dateDepart.
     *
     * @return string
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * Sets the value of dateDepart.
     *
     * @param mixed $dateDepart the date depart
     *
     * @return string
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    /**
     * Gets the value of dateArrivee.
     *
     * @return string
     */
    public function getDateArrivee()
    {
        return $this->dateArrivee;
    }

    /**
     * Sets the value of dateArrivee.
     *
     * @param mixed $dateArrivee the date arrivee
     *
     * @return string
     */
    public function setDateArrivee($dateArrivee)
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }

    public function getName()
    {
         return $this->name;
    } 

    public function setName($name)
    {
         $this->name = $name;
         return $this;
    }
}