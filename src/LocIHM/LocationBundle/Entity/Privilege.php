<?php

namespace LocIHM\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Privilege
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LocIHM\LocationBundle\Entity\PrivilegeRepository")
 */
class Privilege
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
     * @var integer
     *
     * @ORM\Column(name="privilege", type="smallint")
     */
    private $privilege;

    /**
     * @ORM\ManyToOne(targetEntity="LocIHM\LocationBundle\Entity\Utilisateurs", inversedBy="privileges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="LocIHM\LocationBundle\Entity\Agence")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agence;

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
     * Set privilege
     *
     * @param integer $privilege
     * @return Privilege
     */
    public function setPrivilege($privilege)
    {
        $this->privilege = $privilege;

        return $this;
    }

    /**
     * Get privilege
     *
     * @return integer 
     */
    public function getPrivilege()
    {
        return $this->privilege;
    }

    /**
     * Set utilisateur
     *
     * @param \LocIHM\LocationBundle\Entity\Utilisateurs $utilisateur
     * @return Privilege
     */
    public function setUtilisateur(\LocIHM\LocationBundle\Entity\Utilisateurs $utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \LocIHM\LocationBundle\Entity\Utilisateurs 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set agence
     *
     * @param \LocIHM\LocationBundle\Entity\Agence $agence
     * @return Privilege
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
