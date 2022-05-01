<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

        class Checksession
        {
            private $CI;

            public function __construct()
            {
                $this->CI =&get_instance();
            }

            public function index()
            {
            	return;
				$resource = strtolower($this->CI->router->fetch_class());
				$allowedaction = array('login','calender');
				//allow user to logout
				if($this->CI->router->method=='logout'){
					return true;
					die;
				}
				if(in_array($resource,$allowedaction) && empty($this->CI->session->userdata['username'])){
					return true;
				}
				if(!empty($this->CI->session->userdata['username']) && $resource =='login'){
					redirect('dashboard');
					die;
				}
				//print_r($menu_model); //die('hooks');
                if($this->CI->router->fetch_class() != "login"){
                    // session check logic here...change this accordingly
                    if($this->CI->session->userdata['username'] == '' ){
                        redirect('login');
						die;
                    }
                }

				if(isset($this->CI->session->userdata['username']) && $this->CI->session->userdata['username']!=''){
					 $resource = strtolower($this->CI->router->fetch_class());
					$privilege = $this->CI->router->fetch_method();
  					$menu_model = $this->CI->session->userdata['menu_model'];
					  array_walk_recursive($menu_model, function (&$v, $k) {
						$v = strtolower($v);
					  });
					 $this->show_model_in_menu($resource, $menu_model); //die;
					if (!empty($this->show_model_in_menu($resource, $menu_model)) || $resource =='dashboard'){
						//echo 'allow';
					} else {
						//die('not exists');
						redirect('dashboard');
						die;
					}
				}

            }

			public function show_model_in_menu($module_name, $menu_model)
			{
				return $module_name = array_search(strtolower($module_name), array_column($menu_model, 'module_name'));
			}
        }