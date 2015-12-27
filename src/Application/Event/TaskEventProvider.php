<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 13.12.2015
 * Time: 13:49
 */

namespace Reminder\Application\Event;


use CalendR\Event\Provider\ProviderInterface;

class TaskEventProvider implements ProviderInterface
{

    private $eventList;

    public function __construct($eventList) {
        $this->eventList = $eventList;
    }

    /**
     * Return events that matches to $begin && $end
     * $end date should be exclude
     *
     * @param \DateTime $begin
     * @param \DateTime $end
     * @param array $options
     */
    public function getEvents(\DateTime $begin, \DateTime $end, array $options = array())
    {
        return $this->eventList;
    }
}
