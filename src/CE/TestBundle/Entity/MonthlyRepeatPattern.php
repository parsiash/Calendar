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
     * @ORM\Column(name="day", type="integer")
     */
    private $day;

    /**
     * @var integer
     * @ORM\Column(name="weeknumber", type="integer")
     */
    private $weekNumber;

    /**
     * @var integer
     * @ORM\Column(name="weekday", type="integer")
     */
    private $weekday;

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
}