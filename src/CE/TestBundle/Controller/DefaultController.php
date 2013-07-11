<?php

namespace CE\TestBundle\Controller;

use CE\TestBundle\Entity\ClassTime;
use CE\TestBundle\Entity\Course;
use CE\TestBundle\Entity\Semester;
use CE\TestBundle\Entity\User;
use CE\TestBundle\Entity\WeeklyRepeatPattern;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CETestBundle:Default:index.html.twig', array('name' => $name));
    }
}
