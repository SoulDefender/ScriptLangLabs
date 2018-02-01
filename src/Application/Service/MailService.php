<?php

namespace Reminder\Application\Service;


class MailService
{

    private $config;

    public function __construct($config) {
        $this->config = $config;
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $body
     */
    public function sendMessage($from, $to, $subject, $body) {
        $mail = new \PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = $this->config->smtpSecure; // secure transfer enabled REQUIRED for GMail
        $mail->Host = $this->config->smtpHost;
        $mail->Port = $this->config->smtpPort; // or 587
        $mail->IsHTML(true);
        $mail->Username = $this->config->smtpUserName;
        $mail->Password = $this->config->smtpPassword;
        $mail->SetFrom($from);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        $mail->Send();
    }

}
