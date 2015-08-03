<?php

namespace Naughtyfire\Controller;

use RedBeanPHP\R as R;
use Respect\Validation\Validator as v;
use Carbon\Carbon as c;

class Notifier extends \SlimController\SlimController
{


    public function notifyAction()
    {

      $id = 1;
      $settings = R::load('settings', $id);

      $time_before = c::now()->modify('+' . $settings->time_before)->toDateString();

      $transport = \Swift_SmtpTransport::newInstance($settings->mail_host, $settings->mail_port)
        ->setUsername($settings->mail_username)
        ->setPassword($settings->mail_password);

      $mailer = \Swift_Mailer::newInstance($transport);

      $client = new \Services_Twilio($settings->twilio_sid, $settings->twilio_token);

      $recepients = R::findAll('recepients');

   		$events  = R::find("events", "is_enabled = 1 AND date = '$time_before'");

      foreach($events as $event){
      
          foreach($recepients as $recepient){

            $subject = str_replace(array('{title}', '{date}'), array($event->title, $event->date), $settings->subject);
            $body = str_replace(array('{title}', '{date}', '{name}'), array($event->title, $event->date, $settings->name), $settings->msg_template);

            if($recepient->email && $settings->mail_username && $settings->mail_password){

              $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setBody($body)
                ->setFrom(array($settings->email => $settings->name))
                ->setTo(array($recepient->email => $recepient->name));        

              try {
                  $response = $mailer->send($message);
              }catch (\Exception $e){
                  //todo: log error
              }

            }else if($recepient->phone_number && $settings->twilio_sid && $settings->twilio_token && $settings->twilio_phonenumber){
             
              $message = $client->account->messages->sendMessage(
                $settings->twilio_phonenumber, 
                $recepient->phone_number, 
                $body
              );

            }
              
          }


      }
    }

  
}