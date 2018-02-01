<?php
return [
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'reminder',
    'DB_USER' => 'root',
    'DB_PASSWORD' => '1111',
    'encode' => 'utf-8',
    'cookietime' => 3600, // время жизни куков администратора в секундах
    'session_expiration_time' => 3600, //время жизни сессии в секундах
    'version' => '1.0.0 ',
    'default_route' => '/',
    // Присваиваем имена контроллерам: формат: имя => полное имя
    'controllers' => [
        'login' => 'Reminder\\Application\\Controller\\loginController',
        'logout' => 'Reminder\\Application\\Controller\\logoutController',
        'register' => 'Reminder\\Application\\Controller\\registerController',
        'passwordRecovery' => 'Reminder\\Application\\Controller\\passwordRecoveryController',
        'passwordReset' => 'Reminder\\Application\\Controller\\passwordResetController',
        'emailSent' => 'Reminder\\Application\\Controller\\emailSentController',
        'taskBoard' => 'Reminder\\Application\\Controller\\taskBoardController',
        'newTask' => 'Reminder\\Application\\Controller\\newTaskController',
        'tasks' => 'Reminder\\Application\\Controller\\tasksController',
        'task' => 'Reminder\\Application\\Controller\\taskController',
    ],
    // Описываем пути в формате: путь => имя контроллера
    'routes' => [
        '/' => 'taskBoard',
        '/index' => 'taskBoard',
        '/login' => 'login',
        '/register' => 'register',
        '/password/recovery' => 'passwordRecovery',
        '/password/reset' => 'passwordReset',
        '/email/sent' => 'emailSent',
        '/logout' => 'logout',
        '/taskBoard' => 'taskBoard',
        '/newTask' => 'newTask',
        '/task' => 'task',
        '/tasks' => 'tasks'
    ],
    'smtpSecure' => 'ssl', // if not work try to change to tls
    'smtpHost' => 'smtp.gmail.com',
    'smtpPort' => '465',
    'smtpUserName' => 'maksutov.dmitry@gmail.com',
    'smtpPassword' => '5916X17x2443',
];