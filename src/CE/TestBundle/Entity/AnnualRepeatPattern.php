<?php

namespace CE\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnnualRepeatPattern
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class AnnualRepeatPattern extends RepeatPattern
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
     * @ORM\Column(name="month", type="integer")
     */
    private $month;

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
     * @return AnnualRepeatPattern
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
     * @return AnnualRepeatPattern
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
     * Set month
     *
     * @param integer $month
     * @return AnnualRepeatPattern
     */
    public function setMonth($month)
    {
        $this->month = $month;
    
        return $this;
    }

    /**
     * Get month
     *
     * @return integer 
     */
    public function getMonth()
    {
        return $this->month;
    }
}