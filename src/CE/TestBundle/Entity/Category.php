<?php

namespace CE\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Category
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
     * @var int
     *
     * @ORM\OneToMany(targetEntity="Audit", mappedBy="category")
     */
    private $audits;

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
     * @return Category
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
     * Constructor
     */
    public function __construct()
    {
        $this->audits = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add audits
     *
     * @param \CE\TestBundle\Entity\Audit $audits
     * @return Category
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
}