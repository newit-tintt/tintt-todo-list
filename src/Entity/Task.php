<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository::class")
 * @ORM\Table(name="`todolist`")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ischecked;

    /**
     * @ORM\Column(type="integer")
     */
    private $deleteflag;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of deleteFlag
     */ 
    public function getdeleteFlag()
    {
        return $this->deleteflag;
    }

    /**
     * Set the value of deleteFlag
     *
     * @return  self
     */ 
    public function setdeleteFlag($deleteflag)
    {
        $this->deleteflag = $deleteflag;

        return $this;
    }

    /**
     * Get the value of isChecked
     */ 
    public function getIsChecked()
    {
        return $this->ischecked;
    }

    /**
     * Set the value of isChecked
     *
     * @return  self
     */ 
    public function setIsChecked($ischecked)
    {
        $this->ischecked = $ischecked;

        return $this;
    }
}