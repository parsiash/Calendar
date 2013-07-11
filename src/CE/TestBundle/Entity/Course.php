<?php

namespace CE\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Course
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Course
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="instructor", type="string", length=255)
     */
    private $instructor;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Semester", inversedBy="courses")
     */
    private $semester;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="ClassTime", mappedBy="course")
     */
    private $classTimes;


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
     * Set name
     *
     * @param string $name
     * @return Course
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Course
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set instructor
     *
     * @param string $instructor
     * @return Course
     */
    public function setInstructor($instructor)
    {
        $this->instructor = $instructor;
    
        return $this;
    }

    /**
     * Get instructor
     *
     * @return string 
     */
    public function getInstructor()
    {
        return $this->instructor;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->classTimes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set semester
     *
     * @param \CE\TestBundle\Entity\Semester $semester
     * @return Course
     */
    public function setSemester(\CE\TestBundle\Entity\Semester $semester = null)
    {
        $this->semester = $semester;
    
        return $this;
    }

    /**
     * Get semester
     *
     * @return \CE\TestBundle\Entity\Semester 
     */
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * Add classTimes
     *
     * @param \CE\TestBundle\Entity\ClassTime $classTimes
     * @return Course
     */
    public function addClassTime(\CE\TestBundle\Entity\ClassTime $classTimes)
    {
        $this->classTimes[] = $classTimes;
    
        return $this;
    }

    /**
     * Remove classTimes
     *
     * @param \CE\TestBundle\Entity\ClassTime $classTimes
     */
    public function removeClassTime(\CE\TestBundle\Entity\ClassTime $classTimes)
    {
        $this->classTimes->removeElement($classTimes);
    }

    /**
     * Get classTimes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClassTimes()
    {
        return $this->classTimes;
    }
}