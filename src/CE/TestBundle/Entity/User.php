<?php

namespace CE\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User
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
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="Event", mappedBy="user")
     */
    private $events;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="Event", mappedBy="user")
     */
    private $calendars;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="Audit", mappedBy="user")
     */
    private $audits;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="Semester", mappedBy="user")
     */
    private $semesters;

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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add events
     *
     * @param \CE\TestBundle\Entity\Event $events
     * @return User
     */
    public function addEvent(\CE\TestBundle\Entity\Event $events)
    {
        $this->events[] = $events;
    
        return $this;
    }

    /**
     * Remove events
     *
     * @param \CE\TestBundle\Entity\Event $events
     */
    public function removeEvent(\CE\TestBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Add calendars
     *
     * @param \CE\TestBundle\Entity\Event $calendars
     * @return User
     */
    public function addCalendar(\CE\TestBundle\Entity\Event $calendars)
    {
        $this->calendars[] = $calendars;
    
        return $this;
    }

    /**
     * Remove calendars
     *
     * @param \CE\TestBundle\Entity\Event $calendars
     */
    public function removeCalendar(\CE\TestBundle\Entity\Event $calendars)
    {
        $this->calendars->removeElement($calendars);
    }

    /**
     * Get calendars
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCalendars()
    {
        return $this->calendars;
    }

    /**
     * Add audits
     *
     * @param \CE\TestBundle\Entity\Audit $audits
     * @return User
     */
    public function addAudit(\CE\TestBundle\Entity\Audit $audits)
    {
        $this->audits[] = $audits;
    
        return $this;
    }

    /**
     * Remove audits
     *
     * @param \CE\TestBundle\Entity\Audit $audits
     */
    public function removeAudit(\CE\TestBundle\Entity\Audit $audits)
    {
        $this->audits->removeElement($audits);
    }

    /**
     * Get audits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAudits()
    {
        return $this->audits;
    }

    /**
     * Add semesters
     *
     * @param \CE\TestBundle\Entity\Semester $semesters
     * @return User
     */
    public function addSemester(\CE\TestBundle\Entity\Semester $semesters)
    {
        $this->semesters[] = $semesters;
    
        return $this;
    }

    /**
     * Remove semesters
     *
     * @param \CE\TestBundle\Entity\Semester $semesters
     */
    public function removeSemester(\CE\TestBundle\Entity\Semester $semesters)
    {
        $this->semesters->removeElement($semesters);
    }

    /**
     * Get semesters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSemesters()
    {
        return $this->semesters;
    }
}