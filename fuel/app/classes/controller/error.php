<?php

class Controller_Error extends Controller_Template {

    public function action_index()
    {
        $data = array();
        $this->template->title = 'Example Page';
        $this->template->content = View::factory('test/index', $data);
    }
}
/* End of file home.php */