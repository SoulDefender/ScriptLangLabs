<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 13.12.2015
 * Time: 11:38
 */

namespace Reminder\Domain;


class Task
{

    private $id;

    private $name;

    private $end_time;

    private $priority;

    private $description;

    private $creatorId;

    private function __construct() {

    }

    /**
     * Constructor for task
     * @param $id
     * @param $name
     * @param $end_time
     * @param $priority
     * @param $description
     * @param $creatorId
     * @return Task
     */
    public static function fromData($id, $name, $end_time, $priority, $description, $creatorId) {
        $task = new Task();
        $task->id = $id;
        $task->name = $name;
        $task->end_time = $end_time;
        $task->priority = $priority;
        $task->description = $description;
        $task->creatorId = $creatorId;
        return $task;
    }

    /**
     * Constructor for blank task
     * @return Task
     */
    public static function blankTask() {
        $task = new Task();
        $task->setPriority(1);
        return $task;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * @param mixed $end_time
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param mixed $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }


    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCreatorId()
    {
        return $this->creatorId;
    }

    /**
     * @param mixed $creatorId
     */
    public function setCreatorId($creatorId)
    {
        $this->creatorId = $creatorId;
    }

}