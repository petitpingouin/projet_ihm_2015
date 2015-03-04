<?php
// src/LocIHM/LocationBundle/Form/Data/rechercheVehDispoData.php

namespace LocIHM\LocationBundle\Form\Data;

class RechercheVehDispo
{

	protected $categorie;

	protected $type;

	protected $dateDepart;

	protected $dateArrivee;

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
    protected function setCategorie($categorie)
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
    protected function setType($type)
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
    protected function setDateDepart($dateDepart)
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
    protected function setDateArrivee($dateArrivee)
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }
}