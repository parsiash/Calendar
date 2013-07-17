<?php

namespace CE\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WeeklyRepeatPattern
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class WeeklyRepeatPattern extends RepeatPattern
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
     *
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
     * Set weekday
     *
     * @param integer $weekday
     * @return WeeklyRepeatPattern
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