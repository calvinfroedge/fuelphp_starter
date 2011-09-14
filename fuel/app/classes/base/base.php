<?php

class Base extends Controller_Template {

    public function before()
    {
    	parent::before();
    	$data = array(
    		'meta' => View::factory('common/meta'),
    		'css' => View::factory('common/css'),
    		'js_head' => View::factory('common/js_head')
    	);
    	$this->template->head = View::factory('common/head', $data);
    	$this->template->js_bot = View::factory('common/js_bot');
    	$this->template->header = View::factory('common/header');
    	$this->template->footer = View::factory('common/footer');
    }
}
/* End of file base.php */