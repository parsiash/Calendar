<?php

namespace CE\TestBundle\Controller;

use DateTimeZone;
use IntlDateFormatter;
use IntlCalendar;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
//        $formatter = IntlDateFormatter::create(
//            "fa_IR",
//            IntlDateFormatter::LONG,
//            IntlDateFormatter::MEDIUM,
//            new DateTimeZone('Iran'),
//            IntlCalendar::createInstance(NULL, '@calendar=persian'));

        return $this->render('CETestBundle:Default:index.html.twig');
    }
}
