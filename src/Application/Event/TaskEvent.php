<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 13.12.2015
 * Time: 13:46
 */

namespace Reminder\Application\Event;


use CalendR\Event\AbstractEvent;

class TaskEvent extends AbstractEvent
{

    protected $begin;

    protected $end;

    protected $uid;

    protected $name;

    /**
     * @param $uid
     * @param \DateTime $start
     * @param \DateTime $end
     * @param string $name
     */
    public function __construct($uid, \DateTime $start, \DateTime $end, $name) {
        $this->uid = $uid;
        $this->begin = clone $start;
        $this->end = clone $end;
        $this->name = $name;
    }

    /**
     * Returns an unique identifier for the Event.
     * Could be any string, but MUST to be unique.
     *   ex : 'event-8', 'meeting-43'
     *
     * @return string an unique event identifier
     */
    public function getUid()
    {
        return $this->uid;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the event begin
     *
     * @return \DateTime event begin
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * Returns the event end
     *
     * @return \DateTime event end
     */
    public function getEnd()
    {
        return $this->end;
    }
}
