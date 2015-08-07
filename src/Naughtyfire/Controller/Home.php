<?php

namespace Naughtyfire\Controller;

use RedBeanPHP\R as R;
use Respect\Validation\Validator as v;
use Carbon\Carbon as c;

class Home extends \SlimController\SlimController
{

    public function indexAction()
    {
        $this->render('index');
    }


    public function createHolidayAction()
    {
    	
    	$title = $this->app->request->post('title');
    	$date = $this->app->request->post('date');
    	$days = $this->app->request->post('days');
    	$is_enabled = (!empty($this->app->request->post('is_enabled'))) ? true : false;
    	$is_recurring = (!empty($this->app->request->post('is_recurring'))) ? true : false;

    	$date = c::parse($date)->toDateString();
    	
		$rules = array(
		    'title' => v::string()->notEmpty()->setName('title'),
		    'date' => v::date()->notEmpty()->setName('date'),
		    'days' => v::int()->notEmpty()->setName('days'),
		    'is_enabled' => v::bool()->setName('is_enabled'),
		    'is_recurring' => v::bool()->setName('is_recurring')
		);

		$data = $this->app->request->post();
		$data['date'] = $date;
		$data['is_enabled'] = $is_enabled;
		$data['is_recurring'] = $is_recurring;

		$message = array(
			'type' => 'success',
			'text' => 'Successfully added event'
		);

		foreach($data as $key => $value){

		    try{
		        $rules[$key]->check($value);
		    } catch (\InvalidArgumentException $e) {
		        $message = array(
		        	'type' => 'error',
		        	'text' => $e->getMainMessage()
		        );  
		        break;  
		    }

		}

		$event = R::dispense('events');
		$event->title = $title;
		$event->date = $date;
		$event->days = $days;
		$event->is_enabled = $is_enabled;
		$event->is_recurring = $is_recurring;
		R::store($event);

		$this->app->flash('message', $message);
		$this->app->redirect('/');

   		
    }



    public function settingsAction(){

    	$name = '';
    	$email = '';
    	$twilio_sid = '';
    	$twilio_token = '';
    	$twilio_phonenumber = '';
    	$mail_host = '';
    	$mail_port = '';
    	$mail_username = '';
    	$mail_password = '';
    	$subject = '';
     	$msg_template = "Hey Boss,\nI'll be taking my day off on {date} since it's the {title}\n\nRegards,\n{name}";
    	$time_before = '1 week';

		$id = 1;

		$settings = R::load('settings', $id);    	
		if($settings->id){
			$name = $settings->name;
			$email = $settings->email;
			$twilio_sid = $settings->twilio_sid;
			$twilio_token = $settings->twilio_token;
			$twilio_phonenumber = $settings->twilio_phonenumber;
			$mail_host = $settings->mail_host;
			$mail_port = $settings->mail_port;
			$mail_username = $settings->mail_username;
			$mail_password = $settings->mail_password;
			$subject = $settings->subject; 
			$msg_template = $settings->msg_template;
			$time_before = $settings->time_before;
		}

    	$this->render('settings', array(
    		'name' => $name,
    		'email' => $email,
    		'twilio_sid' => $twilio_sid,
    		'twilio_token' => $twilio_token,
    		'twilio_phonenumber' => $twilio_phonenumber,
    		'mail_host' => $mail_host,
    		'mail_port' => $mail_port,
    		'mail_username' => $mail_username,
    		'mail_password' => $mail_password,
    		'subject' => $subject,
    		'msg_template' => $msg_template,
    		'time_before' => $time_before
    	));
    }



    public function updateSettingsAction(){

		$name = $this->app->request->post('name');
		$email = $this->app->request->post('email');
		$twilio_sid = $this->app->request->post('twilio_sid');
		$twilio_token = $this->app->request->post('twilio_token');
		$twilio_phonenumber = $this->app->request->post('twilio_phonenumber');
		$mail_host = $this->app->request->post('mail_host');
		$mail_port = $this->app->request->post('mail_port');
		$mail_username = $this->app->request->post('mail_username');
		$mail_password = $this->app->request->post('mail_password');
		$subject = $this->app->request->post('subject');
    	$msg_template = $this->app->request->post('msg_template');
    	$time_before = $this->app->request->post('time_before');

		$rules = array(
		    'name' => v::string()->notEmpty()->setName('name'),
		    'email' => v::email()->notEmpty()->setName('email'),
		    'twilio_sid' => v::string()->setName('twilio_sid'),
		    'twilio_token' => v::string()->setName('twilio_token'),
    		'twilio_phonenumber' => v::phone()->setName('twilio_phonenumber'),
    		'mail_host' => v::string()->setName('mail_host'),
    		'mail_port' => v::numeric()->setName('mail_port'),
    		'mail_username' => v::string()->setName('mail_username'),
    		'mail_password' => v::string()->setName('mail_password'),
    		'subject' => v::string()->notEmpty()->setName('subject'),
		    'msg_template' => v::string()->notEmpty()->setName('msg_template'),
		    'time_before' => v::string()->notEmpty()->setName('time_before'),
		);
		
		$data = $this->app->request->post();
		$message = array(
			'type' => 'success',
			'text' => 'Successfully updated settings'
		);

		foreach($data as $key => $value){

		    try{
		        $rules[$key]->check($value);
		    } catch (\InvalidArgumentException $e) {
		        $message = array(
		        	'type' => 'error',
		        	'text' => $e->getMainMessage()
		        );  
		        break;  
		    }

		}


    	if($message['type'] == 'success'){

    		$id = 1;
	    	$settings = R::load('settings', $id);
	    	if($settings){
	    		$settings->name = $name;
	    		$settings->email = $email;
	    		$settings->twilio_sid = $twilio_sid;
	    		$settings->twilio_token = $twilio_token;
	    		$settings->twilio_phonenumber = $twilio_phonenumber;
	    		$settings->mail_host = $mail_host;
	    		$settings->mail_port = $mail_port;
	    		$settings->mail_username = $mail_username;
	    		$settings->mail_password = $mail_password; 
	    		$settings->subject = $subject;
	    		$settings->msg_template = $msg_template;
	    		$settings->time_before = $time_before;
	    		R::store($settings);
	    	}else{
				$setting = R::dispense('settings');
				$setting->name = $name;
				$setting->msg_template = $msg_template;
				$settings->time_before = $time_before;
				R::store($setting);
	    	}
    	}


		$this->app->flash('message', $message);
		$this->app->redirect('/settings');
    }

  
    public function recepientsAction(){

    	$recepients = $books = R::findAll('recepients');

    	$this->render('recepients', array('recepients' => $recepients));

    }


    public function newRecepientAction(){

    	$this->render('new_recepient');
    }   


    public function createRecepientAction(){

    	$name = $this->app->request->post('name');
    	$email = $this->app->request->post('email');
		$phone_number = $this->app->request->post('phone_number');    	

    	
		$rules = array(
		    'name' => v::string()->notEmpty()->setName('name'),
		    'email' => v::email()->notEmpty()->setName('email'),
		    'phone_number' => v::phone()->setName('phone_number')
		);

		$data = $this->app->request->post();

		$message = array(
			'type' => 'success',
			'text' => 'Successfully added recepient'
		);

		foreach($data as $key => $value){

		    try{
		        $rules[$key]->check($value);
		    } catch (\InvalidArgumentException $e) {
		        $message = array(
		        	'type' => 'error',
		        	'text' => $e->getMainMessage()
		        );  
		        break;  
		    }

		}

		if($message['type'] == 'success'){		
			$recepient = R::dispense('recepients');
			$recepient->name = $name;
			$recepient->email = $email;
			$recepient->phone_number = $phone_number;
			R::store($recepient);
		}

		$this->app->flash('message', $message);
		$this->app->redirect('/recepients/new');

    }

}