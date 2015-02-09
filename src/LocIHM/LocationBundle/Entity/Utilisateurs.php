<?php

namespace LocIHM\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateurs
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LocIHM\LocationBundle\Entity\UtilisateursRepository")
 */
class Utilisateurs
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
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=255)
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity="LocIHM\LocationBundle\Entity\Privilege", mappedBy="utilisateur")
     */
    private $privileges;


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
     * Set login
     *
     * @param string $login
     * @return Utilisateurs
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Utilisateurs
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     * @return Utilisateurs
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string 
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Utilisateurs
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
     * Set prenom
     *
     * @param string $prenom
     * @return Utilisateurs
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set privileges
     *
     * @param integer $privileges
     * @return Utilisateurs
     */
    public function setPrivileges($privileges)
    {
        $this->privileges = $privileges;

        return $this;
    }

    /**
     * Get privileges
     *
     * @return integer 
     */
    public function getPrivileges()
    {
        return $this->privileges;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->privileges = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add privileges
     *
     * @param \LocIHM\LocationBundle\Entity\Privilege $privileges
     * @return Utilisateurs
     */
    public function addPrivilege(\LocIHM\LocationBundle\Entity\Privilege $privilege)
    {
        $this->privileges[] = $privilege;

        $privilege->setUtilisateur($this);

        return $this;
    }

    /**
     * Remove privileges
     *
     * @param \LocIHM\LocationBundle\Entity\Privilege $privileges
     */
    public function removePrivilege(\LocIHM\LocationBundle\Entity\Privilege $privilege)
    {
        $this->privileges->removeElement($privilege);
    }
}
