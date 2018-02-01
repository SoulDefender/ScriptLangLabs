<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 16.12.2015
 * Time: 0:30
 */

namespace Reminder\Infrastructure\SQLRepositories;


use Reminder\Domain\Task;

class TaskExtractor
{

    /**
     * @param $row
     * @return Task
     */
    public static function extractTask($row) {
        return Task::fromData(
            $row['id'], $row['name'], $row['end_time'], $row['priority'], $row['description'], $row['id_creator']
        );
    }

}
