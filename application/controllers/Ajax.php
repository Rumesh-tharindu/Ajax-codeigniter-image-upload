<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller{
    function index(){
        $this->load->view('image');
    }
    function ajaxImageStore(){
        if(isset($_FILES["image_file"]["name"]))  
        {  
             $config['upload_path'] = './uploads/';  
             $config['allowed_types'] = 'jpg|jpeg|png|gif';  
             $this->load->library('upload', $config);
              
             if(!$this->upload->do_upload('image_file'))  
             {  
                 $error =  $this->upload->display_errors(); 
                 echo json_encode(array('msg' => $error, 'success' => false));
             }  
             else 
             {  
                  $data = $this->upload->data(); 
                  $insert['name'] = $data['file_name'];
                  $this->db->insert('images',$insert);
                  $getId = $this->db->insert_id();

                  $arr = array('msg' => 'Image has not uploaded successfully', 'success' => false);

                  if($getId){
                   $arr = array('msg' => 'Image has been uploaded successfully', 'success' => true);
                  }
                  echo json_encode($arr);
             }  
        }  
    }
}

?>