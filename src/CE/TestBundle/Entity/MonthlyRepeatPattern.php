<?php

namespace CE\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MonthlyRepeatPattern
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class MonthlyRepeatPattern extends RepeatPattern
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
     * @ORM\Column(name="weeknumber", type="integer", nullable=true)
     */
    private $weekNumber;

    /**
     * @var integer
     * @ORM\Column(name="weekday", type="integer", nullable=true)
     */
    private $weekday;

    /**
     * @var integer
     * @ORM\Column(name="day", type="integer", nullable=true)
     */
    private $day;

    /**
     * @var integer
     * @ORM\Column(name="calendarType", type="integer", nullable=true)
     * 1 = persian, 2 = islamic, 3 = gregorian
     */
    private $calendarType;

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
     * Set weekNumber
     *
     * @param integer $weekNumber
     * @return MonthlyRepeatPattern
     */
    public function setWeekNumber($weekNumber)
    {
        $this->weekNumber = $weekNumber;
    
        return $this;
    }

    /**
     * Get weekNumber
     *
     * @return integer 
     */
    public function getWeekNumber()
    {
        return $this->weekNumber;
    }

    /**
     * Set weekday
     *
     * @param integer $weekday
     * @return MonthlyRepeatPattern
     */
    public function setWeekday($weekday)
    {
        $this->weekday = $weekday;
    
        return $this;
    }

    /**
     * Get weekday
     *
     * @return integer 
     */
    public function getWeekday()
    {
        return $this->weekday;
    }


    /**
     * Set day
     *
     * @param integer $day
     * @return MonthlyRepeatPattern
     */
    public function setDay($day)
    {
        $this->day = $day;
    
        return $this;
    }

    /**
     * Get day
     *
     * @return integer 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set calendarType
     *
     * @param integer $calendarType
     * @return MonthlyRepeatPattern
     */
    public function setCalendarType($calendarType)
    {
        $this->calendarType = $calendarType;
    
        return $this;
    }

    /**
     * Get calendarType
     *
     * @return integer 
     */
    public function getCalendarType()
    {
        return $this->calendarType;
    }
}