<?php

class TemplateController extends \BaseController {
    
    
    public function load()
	{
	    $template = Input::get('template');
	    if($template == 'post'){
	        return View::make('posts/post_template');
	    }
	}
    
}