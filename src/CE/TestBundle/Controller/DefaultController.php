<?php

namespace CE\TestBundle\Controller;

use CE\TestBundle\Entity\User;
use CE\TestBundle\Entity\Calendar;
use CE\TestBundle\Entity\DailyRepeatPattern;
use CE\TestBundle\Entity\Event;
use DateTimeZone;
use IntlDateFormatter;
use IntlCalendar;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

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

        return $this->render('CETestBundle:Default:index.html.twig', array("name" => $name));
    }

    public function eventEditAction(){

//                $em = $this->getDoctrine()->getManager();
//        $date = new \DateTime();
//
//        /** @var $user User */
//        $user = $this->getUser();
//        $event = new Event();
//        $event->setStart($date);
//        $rep = new DailyRepeatPattern();
//        $rep->setPeriod(3);
//
//        $em->persist($rep);
//
//        $event->setRepeatPattern($rep);
//        $event->setTitle("Parsia's first Event");
//        $event->setColor('red');
//        $event->setEnd($date->add(new \DateInterval('PT2H')));
//
//        $cal = new Calendar();
//        $cal->setName("Default");
//
//        $em->persist($cal);
//
//        $user->addCalendar($cal);
//        $event->setCalendar($cal);
//        $event->setUser($user);
//        $em->persist($event);
//
//        $user->addEvent($event);
//
//        $em->persist($user);
//        $em->flush();
//        return new Response("lk");

        $ep = $this->getDoctrine()->getRepository('CETestBundle:Event');
        $event = $ep->find(1);
        $em = $this->getDoctrine()->getManager();
        $eventForm = $this->createFormBuilder($event)->add('title', 'text')->add('description', 'text')->add('color', 'choice', array("choices" => array("red" , "blue", "orange" , "green", "brown", "gray")))->add('start', 'datetime')->add('end', 'datetime')->add('untilDate', 'date', array('empty_value' => '', 'empty_data' => null, 'required' => false))->add('save','submit')->getForm();


        $eventForm->handleRequest($this->getRequest());
        if($eventForm->isValid()){
            $em->persist($event);
            $em->flush();
        }
        return $this->render('CETestBundle:Default:eventEditor.html.twig', array("form" => $eventForm->createView()));
    }

    //create and persist an event to the database
    public function createEventAction(Request $request)
    {
//        $em = $this->getDoctrine()->getManager();
//        $event = new Event();
//        $event->setTitle($request->get('title'));
//        $event->setColor($request->get('color'));
//        $event->setDescription($request->get('description'));
//        $event->setStart(new \DateTime($request->get('start')));
//        $event->setEnd(new \DateTime($request->get('end')));
////        $calendar = $this->getDoctrine()->getRepository("CETestBundle:Calendar")->find($request->get("calendar_id"));
////        $calendar = new Calendar();
////        $calendar->setName("parsia");
////        $em->
////        $em->persist($calendar);
////        $event->setCalendar($calendar);
//        $event->setUser($this->getUser());
        $event = new Event();
//        $em = $this->getDoctrine()->getManager();
        $eventForm = $this->createFormBuilder($event)
            ->add('title', 'text')
            ->add('description', 'text', array('required' => false))
            ->add('color', 'choice', array("choices" => array("red" , "blue", "orange" , "green", "brown", "gray")))
            ->add('start', 'time')
            ->add('end', 'time')
            ->add('untilDate', 'date', array('empty_value' => '', 'empty_data' => null, 'required' => false))
            ->add('numAppointments', 'integer', array('label' => 'Number of occasions', 'required' => false))
            ->getForm();

        $event->setCalendar($this->getDoctrine()->getRepository('CETestBundle:Calendar')->find($request->getSession()->get('calendar_id')));

        $eventForm->handleRequest($this->getRequest());
        if($eventForm->isValid()) {
            return new Response(serialize($event));
        }
        return new Response("Invalid event");
    }

    public function editEventAction(){

    }

    public function showCalendarAction(Request $request)
    {
        $event = new Event();
        $eventForm = $this->createFormBuilder($event)
            ->add('title', 'text')
            ->add('description', 'text', array('required' => false))
            ->add('color', 'choice', array("choices" => array("red" , "blue", "orange" , "green", "brown", "gray")))
            ->add('start', 'time')
            ->add('end', 'time')
            ->add('untilDate', 'date', array('empty_value' => '', 'empty_data' => null, 'required' => false))
            ->add('numAppointments', 'integer', array('label' => 'Number of occasions', 'required' => false))
            ->getForm();

        $request->getSession()->set('calendar_id',  $request->get('id'));

        return $this->render('CETestBundle:Default:calendar.html.twig',
            array("form" => $eventForm->createView(),
                "calendars" => $this->getUser()->getCalendars(),
            ));
    }
}
