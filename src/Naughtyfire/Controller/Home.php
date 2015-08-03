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
    	$is_enabled = (!empty($this->app->request->post('is_enabled'))) ? true : false;
    	$is_recurring = (!empty($this->app->request->post('is_recurring'))) ? true : false;

    	$date = c::parse($date)->toDateString();
    	
		$rules = array(
		    'title' => v::string()->notEmpty()->setName('title'),
		    'date' => v::date()->notEmpty()->setName('date'),
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
		$event->is_enabled = $is_enabled;
		$event->is_recurring = $is_recurring;
		R::store($event);

		$this->app->flash('message', $message);
		$this->app->redirect('/');

   		
    }



 

  
}