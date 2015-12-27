<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 13.12.2015
 * Time: 11:37
 */

namespace Reminder\Application\Controller;


use Core\Controller;
use Core\HttpRequest;
use Core\HttpResponse;

class TaskBoardController extends Controller
{
    public function doGet(HttpRequest $request, HttpResponse $response) {
        $curr_date = new \DateTime('now');
        $year = $curr_date->format('Y');
        $month = $curr_date->format('n');
        $day = $curr_date->format('j');
        if($request->getParameter('year') !== null) {
            $year = $request->getParameter('year');
            $month = $request->getParameter('month');
            if($month > 12) {
                $month = 1;
                $year += 1;
            }
            if($month < 1) {
                $month = 12;
                $year -= 1;
            }
        }
        $choosen_date = new \DateTime();
        $choosen_date->setDate($year, $month, $day);
        $d=cal_days_in_month(CAL_GREGORIAN,$month,$year);
        $request->setAttribute('dayOfWeek', $curr_date->setDate($year, $month, 1)->format('N'));
        $request->setAttribute('daysInMonth', $d);
        $request->setAttribute('year', $year);
        $request->setAttribute('month', $month);
        $request->setAttribute('day', $day);
        $request->setAttribute('monthName', $choosen_date->format('F'));
        $request->render('task_calendar.html.twig');
    }
}
