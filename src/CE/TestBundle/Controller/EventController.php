<?php

namespace CE\TestBundle\Controller;

use CE\TestBundle\Entity\Event;
use CE\TestBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    public function getDateEventAction(Request $request)
    {
        $offset = $request->get('offset');

        $date = new \DateTime();
        $date->setTime(0, 0, 0);
        $date->modify('this week');
        if ($offset > 0)
            $date->add(new \DateInterval('P'.($offset * 7).'D'));
        else
            $date->sub(new \DateInterval('P'.(-$offset * 7).'D'));

        /** @var $user User */
        $user = $this->getUser();
        $repo = $this->getDoctrine()->getRepository('CETestBundle:User');
        $cal = $this->getDoctrine()->getRepository('CETestBundle:Calendar')->find($request->getSession()->get('calendar_id'));

        $a_events = array();
        for ($i = 0; $i < 7; $i++) {
            $a_events[$i] = array();
            $events = $repo->findAllEventsOnDay($date, $user, $cal);
            if (is_null($events))
                continue;
            foreach ($events as $event) {
                $a_event = array();
                $a_event['title'] = $event->getTitle();
                $a_event['start'] = $event->getStart();
                $a_event['end'] = $event->getEnd();
                $a_event['color'] = $event->getColor();
                array_push($a_events[$i],$a_event);
            }
            $date->add(new \DateInterval('P1D'));
        }

        return new Response(json_encode($a_events));
    }

    public function getCalendarsAction()
    {
        /** @var $user User */
        $user = $this->getUser();
        $calendars = array();
        foreach ($user->getCalendars() as $cal) {
            $calendar = array();
            $calendar['id'] = $cal->getId();
            $calendar['name'] = $cal->getName();
            array_push($calendars, $calendar);
        }
        return $this->render('CETestBundle:Event:test.html.twig', array('data' => json_encode($calendars)));
    }
}
