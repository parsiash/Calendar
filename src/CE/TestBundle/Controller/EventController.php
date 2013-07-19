<?php

namespace CE\TestBundle\Controller;

use CE\TestBundle\Entity\Event;
use CE\TestBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    public function getDateEventAction($date, $cal_id)
    {
        /** @var $user User */
        $user = $this->getUser();
        $repo = $this->getDoctrine()->getRepository('CETestBundle:User');
        $cal = $this->getDoctrine()->getRepository('CETestBundle:Calendar')->find($cal_id);
        $events = $repo->findAllEventsOnDay(new \DateTime($date), $user, $cal);

        /** @var $event Event */
        $a_events = array();
        if (is_null($events))
            return new Response('');
        foreach ($events as $event) {
            $a_event = array();
            $a_event['title'] = $event->getTitle();
            $a_event['start'] = $event->getStart();
            $a_event['end'] = $event->getEnd();
            array_push($a_events, $a_event);
        }

        return $this->render('CETestBundle:Event:test.html.twig', array('data' => json_encode($a_events)));
    }
}
