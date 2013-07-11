<?php

namespace CE\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Semester
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Semester
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
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="date")
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="date")
     */
    private $end;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="Course", mappedBy="semester")
     */
    private $courses;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="semesters")
     */
    private $user;

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
     * @return Semester
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
     * Set start
     *
     * @param \DateTime $start
     * @return Semester
     */
    public function setStart($start)
    {
        $this->start = $start;
    
        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Semester
     */
    public function setEnd($end)
    {
        $this->end = $end;
    
        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->courses = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add courses
     *
     * @param \CE\TestBundle\Entity\Course $courses
     * @return Semester
     */
    public function addCourse(\CE\TestBundle\Entity\Course $courses)
    {
        $this->courses[] = $courses;
    
        return $this;
    }

    /**
     * Remove courses
     *
     * @param \CE\TestBundle\Entity\Course $courses
     */
    public function removeCourse(\CE\TestBundle\Entity\Course $courses)
    {
        $this->courses->removeElement($courses);
    }

    /**
     * Get courses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * Set user
     *
     * @param \CE\TestBundle\Entity\User $user
     * @return Semester
     */
    public function setUser(\CE\TestBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \CE\TestBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}