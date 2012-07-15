<?php

/**
The MainController class will contain default resources which will be
used by Views. These resources are:
  title - The View page's title
  content - The content of the page, either a URL or actual content
            as determined by...
  echo_content - Boolean. When true, View echoes $content as is. Else,
                 it includes the file indicated by $content
  stylesheets - The stylesheets to be linked in the page. You can use
                this to include a default stylesheet, if including one
                in the page itself is unmaintanable.
  scripts - JavaScript to be included with the page. As with stylesheets,
            you can use this to include a default script, if including
            one in the page itself is unmaintanable.

All controllers which will invoke a view must extend from this instead of
from CI_Controller.

@author Chad Estioco
*/
class MainController extends CI_Controller{
	
	static protected $data_bundle;
	
	/**
	All classes that will extend MainController should have their own constructors
	calling the constructor of MainController.
	*/
	public function __construct(){
		parent::__construct();
		$data_bundle["title"] = "";
		$data_bundle["content"] = "";
		$data_bundle["stylesheets"] = "";
		$data_bundle["scripts"] = "";
		$data_bundle["echo_content"] = true;
	}
	
}

?>
