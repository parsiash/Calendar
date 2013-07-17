<?php

namespace CE\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Event
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime")
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime")
     */
    private $end;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="numAppointments", type="integer", nullable=true)
     */
    private $numAppointments;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="untilDate", type="date", nullable=true)
     */
    private $untilDate;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=6)
     */
    private $color;


    /**
     * @var
     *
     * @ORM\OneToOne(targetEntity="RepeatPattern")
     */
    private $repeatPattern;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="events")
     */
    private $user;

    /**
     * @var
     *
     * @ORM\ManyToMany(targetEntity="User")
     */
    private $attendants;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Calendar", inversedBy="events")
     */
    private $calendar;

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
     * Set title
     *
     * @param string $title
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     * @return Event
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
     * @return Event
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
     * Set description
     *
     * @param string $description
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set numAppointments
     *
     * @param integer $numAppointments
     * @return Event
     */
    public function setNumAppointments($numAppointments)
    {
        $this->numAppointments = $numAppointments;
    
        return $this;
    }

    /**
     * Get numAppointments
     *
     * @return integer 
     */
    public function getNumAppointments()
    {
        return $this->numAppointments;
    }

    /**
     * Set untilDate
     *
     * @param \DateTime $untilDate
     * @return Event
     */
    public function setUntilDate($untilDate)
    {
        $this->untilDate = $untilDate;
    
        return $this;
    }

    /**
     * Get untilDate
     *
     * @return \DateTime 
     */
    public function getUntilDate()
    {
        return $this->untilDate;
    }

    /**
     * Set repeatPattern
     *
     * @param \CE\TestBundle\Entity\RepeatPattern $repeatPattern
     * @return Event
     */
    public function setRepeatPattern(\CE\TestBundle\Entity\RepeatPattern $repeatPattern = null)
    {
        $this->repeatPattern = $repeatPattern;
    
        return $this;
    }

    /**
     * Get repeatPattern
     *
     * @return \CE\TestBundle\Entity\RepeatPattern 
     */
    public function getRepeatPattern()
    {
        return $this->repeatPattern;
    }

    /**
     * Set user
     *
     * @param \CE\TestBundle\Entity\User $user
     * @return Event
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attendants = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add attendants
     *
     * @param \CE\TestBundle\Entity\User $attendants
     * @return Event
     */
    public function addAttendant(\CE\TestBundle\Entity\User $attendants)
    {
        $this->attendants[] = $attendants;
    
        return $this;
    }

    /**
     * Remove attendants
     *
     * @param \CE\TestBundle\Entity\User $attendants
     */
    public function removeAttendant(\CE\TestBundle\Entity\User $attendants)
    {
        $this->attendants->removeElement($attendants);
    }

    /**
     * Get attendants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttendants()
    {
        return $this->attendants;
    }

    /**
     * Set calendar
     *
     * @param \CE\TestBundle\Entity\Calendar $calendar
     * @return Event
     */
    public function setCalendar(\CE\TestBundle\Entity\Calendar $calendar = null)
    {
        $this->calendar = $calendar;
    
        return $this;
    }

    /**
     * Get calendar
     *
     * @return \CE\TestBundle\Entity\Calendar 
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Event
     */
    public function setColor($color)
    {
        $this->color = $color;
    
        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }
}