<?php

namespace tBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserToProject
 *
 * @ORM\Table(name="User_To_Project")
 * @ORM\Entity(repositoryClass="tBundle\Entity\UserToProjectRepository")
 */
class UserToProject
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
     * @var boolean
     *
     * @ORM\Column(name="state_creater", type="boolean")
     */
    private $stateCreater;


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
     * Set stateCreater
     *
     * @param boolean $stateCreater
     * @return UserToProject
     */
    public function setStateCreater($stateCreater)
    {
        $this->stateCreater = $stateCreater;

        return $this;
    }

    /**
     * Get stateCreater
     *
     * @return boolean 
     */
    public function getStateCreater()
    {
        return $this->stateCreater;
    }

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="utops")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="ptous")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     **/
    private $project;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

}
