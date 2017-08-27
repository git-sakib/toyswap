<?php

// src/AppBundle/Entity/User.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
        
    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }

    // -------------------------------------------------------
    // All THE GETTERS
    // -------------------------------------------------------
    public function getId(){
        return $this->id;
    }
    public function getUsername(){
        return $this->email;
    }
    public function getPlainPassword(){
        return $this->plainPassword;
    }    
    public function getPassword(){
        return $this->password;
    }
    public function getEmail(){
        return $this->email;
    }
    public function isActive(){
        return $this->isActive;
    }
    public function getSalt(){
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }
    public function getRoles(){
        return array('ROLE_USER');
    }

    // -------------------------------------------------------
    // All THE SETTERS
    // -------------------------------------------------------
    public function setPlainPassword($password){
        $this->plainPassword = $password;
    }
    public function setPassword($pass){
        $this->password = $pass;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setActive($active){
        $this->isActive = $active;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
}    