<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class User extends CI_Controller {

	public function User(){
		parent::__construct();
		parse_str( $_SERVER['QUERY_STRING'], $_REQUEST );
		$CI = & get_instance();
        $CI->config->load("facebook",TRUE);
        $config = $CI->config->item('facebook');
        $this->load->library('Facebook', $config);
	}

	public function logout() {
		$this->load->library('session');
		$this->load->helper('url');

   		setcookie('PHPSESSID', '', time()-3600, "/");
    		$this->session->sess_destroy();
    		redirect('/user/login');
  	}

	function login(){
		// Try to get the user's id on Facebook
		$userId = $this->facebook->getUser();

		// If user is not yet authenticated, the id will be zero
		if($userId == 0){

			// Generate a login url
			$data['url'] = $this->facebook->getLoginUrl(array('scope'=>'email')); 
			$this->load->view('main_index',$data);


		} else {

			$this->load->helper('url');
			// Get user's data and print it
			$user = $this->facebook->api('/me');
			echo "Bine ai venit, ";
			echo $user["name"];
			
			$cookie = array(
			'name' => 'urweb',
			'value' => $user["id"],
			'expire' => time() + 1800,
			'path' => '/'
			 );

			$this->input->set_cookie($cookie);
			$this->load->model('set');
			$this->set->add_user($user['id'],$user['name']);
 
            $this->load->model('get');
            $data['results'] = $this->get->get_locations();
         
			$this->load->view('home',$data);

			$this->facebook->getLogoutUrl(array('next' => site_url('logout')));		
		}
	}

}

?>