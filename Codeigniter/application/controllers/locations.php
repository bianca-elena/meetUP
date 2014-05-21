<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Locations extends REST_Controller {
     
     function get()
     {

         $location_type = $this->_get('locations');
         $this->load->model('get');

         if(!$location_type){
              $result = $this->response(array('error' => 'Cannot access this page' ),404);
              $data = _from_xml($result);

              var_dump($data);
              
              $this->load->view('home');
         }
         else{

       //        $res['result'] = $this->get->get_location($location_type);
       //         if ($result){
       //            $data['result'] = $this->response($result,200);
       //        else
       //           $data['result'] = $this->response(array('error' => 'Cannot access this page' ),404);     
              $res['result'] = $location_type;
        
              $this->load->view('locationType',$res);    
            }

         }
}
?>