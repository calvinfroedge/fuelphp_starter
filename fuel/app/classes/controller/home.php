<?php

class Controller_Home extends Controller_Template {

    public function action_index()
    {
        $data = array();
        $this->template->title = 'Example Page';
        $this->template->content = View::factory('sell/home', $data);
    }
}
/* End of file home.php */