<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BmItemInstController extends CI_Controller {


    
    public function __construct()
    {
         parent :: __construct();
		date_default_timezone_set('Asia/Kolkata');         
             $this->load->library('session');
              $this->load->model('Access_model');
              $this->load->helper(array('form', 'url'));
            //  $this->load->library('Signup_controller');
             $loginstatus   = $this->session->userdata('logged_in'); 
              $this->load->model('MenuSelection/BmItemInstModel','obj');
               if($loginstatus["status"] != '1')
                   {

                       redirect('logout');
                    }

            
            
    } 
    
    public function index()
    {
//            $this->load->view('Admin/MenuCreation/insertItemView',
//                ['flag'=>0]);
             $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
                  $service =  $this->Access_model->showAdminService();
           
            $dataItem = $this->obj->getItem($locationid);
            $dataItemCategory = $this->obj->dataItemCategory();
            $this->load->view('Admin/MenuCreation/bmInsertItemView',
                ['flag'=>0, 'dataItem'=>$dataItem,'serviceData'=>$service, 'category'=>$dataItemCategory]);
    }

    public function prep_filename($filename)
    {
        if (strpos($filename, '.') === false)
        {
                return $filename;
        }

        $parts = explode('.', $filename);
        $ext = array_pop($parts);
        $filename = array_shift($parts);

        foreach ($parts as $part)
        {
                if ($this->mimes_types(strtolower($part)) === false)
                {
                        $filename .= '.' . $part . '_';
                }
                else
                {
                        $filename .= '.' . $part;
                }
        }

        $filename .= '.' . $ext;

        return strtolower($filename);
        
    }
    public function saveItemData()
    {
        
        $target_dir = $GLOBALS['img_path'];
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        $item = $this->input->post('item_name'); 
        $item_alias = $this->input->post('item_alias'); 
        $price = $this->input->post('price_name'); 
        $categoryID = $this->input->post('category');  //echo date( "Y-m-d H:i:s", mktime(0, 0, 0)); 
        $loginstatus   = $this->session->userdata('logged_in'); 
        $loginstatus['id'];
        $fname='';
        //echo "DIV"; die;
        if(trim($_FILES["userfile"]["name"]) != "")
        {
          //  $file_name= $_FILES["userfile"]["name"];
             $fname =  basename($this->prep_filename($loginstatus['id']."_".$locationid."_".date( "Y-m-d H:i:s", mktime(0, 0, 0))."_".rand(1000,100000)));
             //echo $fname; echo "<br>";
            $config['upload_path']          = $target_dir;
            $config['allowed_types']        = 'png';
            $config['max_size']             = 10000;
            $config['file_name']   	        = $fname;
            //$config['max_width']            = 1024;
            //$config['max_height']           = 768;
            $this->load->library('upload', $config);
           
             
        }
        else
        {
            $fname='';
            //echo "DP";
        }
        
         $target_file = $target_dir.str_replace(' ', '_', $fname);
        

        
       
        
        // Check if file already exists
        //  if (file_exists($target_file)) 
         // {
              //echo "Sorry, file already exists.";
           //     $service =  $this->Access_model->showAdminService();
           //     $dataItem = $this->obj->getItem($locationid);
            //    $dataItemCategory = $this->obj->dataItemCategory();
            //    $this->load->view('Admin/MenuCreation/bmInsertItemView',
            //        ['error'=>'File Already Exist!!', 'flag'=>0, 'dataItem'=>$dataItem,'serviceData'=>$service, 'category'=>$dataItemCategory]);
         // }
       //   else
          //{
              
                if($fname!='')
                {
                     $this->upload->do_upload('userfile');
                     $data = array('upload_data' => $this->upload->data());
                }
                else
                {}
              
             
               // if ( ! $this->upload->do_upload('userfile'))
               // {
//
//                        $error = array('error' => $this->upload->display_errors());
//                        $service =  $this->Access_model->showAdminService();
                          // echo "DP";
//                        $dataItem = $this->obj->getItem($locationid);
//                        $dataItemCategory = $this->obj->dataItemCategory();
//
//                       // $this->load->view('bmiteminst', $error);
//                        $this->load->view('Admin/MenuCreation/bmInsertItemView',
//                        ['error'=>$error['error'], 'flag'=>0, 'dataItem'=>$dataItem,'serviceData'=>$service, 'category'=>$dataItemCategory]);
             //   }
              //  else
              //  {

                      
                       // $file_name = $upload_data['file_name'];


                       //echo str_replace(' ', '_', $fname);
                        if($fname!='')
                        {
                            $imagePath = str_replace(' ', '_', $fname.".png");
                        }
                        else
                        {
                            $imagePath='';
                        }
                       
                        if($this->obj->insertItem($item, $item_alias, $categoryID, $price, $locationid, $imagePath))
                        {
                           redirect('bmiteminst', 'refresh');
                        }

                        //$this->load->view('upload_success', $data);
              //  }
        //  }
        
      
       
        
        
      
    }
    
    
    public function editItem()
    {
       // echo "Cool"; die;
         $service =  $this->Access_model->showAdminService();
         if($this->input->server('REQUEST_METHOD') == 'POST')
         {
            //echo "POST HAIN"; 
            if(trim($_FILES["userfile"]["name"]) != "")
            {
                $locid = $this->obj->locbmid();
                $locationid = $locid['locid'];
                $target_dir = $GLOBALS['img_path'];
                $loginstatus   = $this->session->userdata('logged_in'); 
                $loginstatus['id'];
                $fname =  basename($this->prep_filename($loginstatus['id']."_".$locationid."_".date( "Y-m-d H:i:s", mktime(0, 0, 0))."_".rand(1000,100000).".png"));
                $fname = str_replace(' ', '_', $fname);
                $target_file = $target_dir.$fname;
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["userfile"]["tmp_name"]);
                if($check !== false) 
                {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;

                      // Allow certain file formats
                    if( $imageFileType != "png") 
                    {
                        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    else
                    {

                                 // Check if file already exists
                        if (file_exists($target_file)) 
                        {
                            //echo "Sorry, file already exists.";
                            $uploadOk = 0;
                        }
                        // Check file size
                        if ($_FILES["userfile"]["size"] > 500000) 
                        {
                            //echo "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }


                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) 
                        {
                            //echo "Sorry, your file was not uploaded.";
                            // if everything is ok, try to upload file
                        } 
                        else 
                        {
                            if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) 
                            {
                                $path123 = $GLOBALS['img_path'].$this->input->post('hiddenfile');
                                unlink($path123);
                                $ItemID = $this->uri->segment('3');
                                $itemName = $this->input->post('item_name'); 
                                $itemAlias = $this->input->post('item_alias'); 
                                $price = $this->input->post('price_name'); 
                                $categoryid = $this->input->post('category'); 
                                $target_file1 = $fname;
                                $data = $this->obj->updateItemByID($ItemID, $itemName, $itemAlias,$price, $categoryid, $target_file1);
                                if($data)
                                {
                                    redirect('bmiteminst', 'refresh');
                                }
                            } 
                            else 
                            {
                                //echo "Sorry, there was an error uploading your file.";
                               
                            }
                        } 
                    }
                } 
                else 
                {
                    //echo "File is not an image."; die;
                }
            }
            else
            {
                $ItemID = $this->uri->segment('3');
                $itemName = $this->input->post('item_name'); 
                $itemAlias = $this->input->post('item_alias'); 
                $price = $this->input->post('price_name'); 
                $categoryid = $this->input->post('category'); 
                $target_file1 = $this->input->post('hiddenfile');    
                $data = $this->obj->updateItemByID($ItemID, $itemName, $itemAlias,$price, $categoryid, $target_file1);
                if($data)
                {
                    redirect('bmiteminst', 'refresh');
                }
            }
        }
        else
        {
           $ItemID = $this->uri->segment('3');
           $dataItem = $this->obj->getItemByID($ItemID);  
           $dataCategory = $this->obj->dataItemCategory();
           $this->load->view('Admin/MenuCreation/bmeditItemView',
               ['flag'=>0, 'dataItem'=>$dataItem, 'dataCategory'=>$dataCategory,'serviceData'=>$service]);
        }
    }
    
    
    public function deleteItem()
    {
        //echo "POST HAIN";   
        $ItemID = $this->uri->segment('3');
        $menuName = $this->input->post('menu_name'); 
        //$this->load->model('MenuSelection/ItemInstModel');
        $dataMenu = $this->obj->deleteItemByID($ItemID);
        // print_r($dataMenu); die;
        if($dataMenu)
        {
            redirect('bmiteminst', 'refresh');
        }
    }
    
    public function ajaxCheckItem()
    {
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        $itemName = trim($this->input->post('itemName'));
        $check = $this->obj->ajaxCheckItemName($itemName, $locationid);
        echo $check;
        
    }
    
     public function ajaxCheckItemAlias()
    {
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        $itemName = trim($this->input->post('itemName'));
        $check = $this->obj->ajaxCheckItemAliasName($itemName, $locationid);
        echo $check;
        
    }
    
}

?>
