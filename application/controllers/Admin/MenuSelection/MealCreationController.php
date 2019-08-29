<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MealCreationController extends CI_Controller {
    
    
    public function __construct()
    {
         parent :: __construct();
         $this->load->helper(array('form', 'url'));
		date_default_timezone_set('Asia/Kolkata');
            $this->load->model('MenuSelection/MealCreationModel','obj');
             $this->load->library('session','upload');
               $this->load->model('Access_model');
               //$this->load->helper(array('form', 'url'));
            //  $this->load->library('Signup_controller');
             $loginstatus   = $this->session->userdata('logged_in'); 
               if($loginstatus["status"] != '1')
                   {

                       redirect('logout');
                    }

            
            
    } 
    
    public function index()
    {       $service =  $this->Access_model->showAdminService();
            $locid = $this->obj->locbmid();
            $locationid = $locid['locid'];
            $dataItemCategory = $this->obj->dataItemCategory();
            $this->load->view('Admin/MenuCreation/mealCreationView',
                ['flag'=>0,'serviceData'=>$service, 'category'=>$dataItemCategory]);
    }
    
    public function saveMenuData()
    {
        $meal = $this->input->post('mealname'); 
        $meal_alias = $this->input->post('meal_alias'); 
        $price = $this->input->post('mealprice'); 
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        $result = $this->obj->insertMeal($meal,$meal_alias,$price, $locationid);
        $msg['success'] = false;
        if($result){
                $msg['success'] = true;
        }
        echo json_encode($msg);
    }
    
    public function editMenu()
    {
    
    }
    
    
    public function deleteMeal()
    {
        $result = $this->obj->deleteMealByID();
        $msg['success'] = false;
        if($result){
                $msg['success'] = true;
        }
        echo json_encode($msg);
    }
    
    public function showAllMeal() {
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        $result = $this->obj->showAllMeal($locationid);
        echo json_encode($result);
    }
    
    public function showAllItems() {
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        $mealID =$this->input->post('mealid'); 
        $checkedData = $this->obj->checkedItems($mealID, $locationid);
        $result = $this->obj->getItems($locationid);
        $data['checkData'] = $checkedData;
        $data['dataItem'] = $result;
        echo json_encode($data);
     
    }

    public function updateStatus()
    {
        $mealID =$this->input->post('mealid'); 
        $statusValue =$this->input->post('statusValue'); 

        $result = $this->obj->updatemealStatus($mealID,$statusValue); 
        if($result == 1)
        {
            echo true;
        }
        else{
             echo false;
        }
        

    }
    
     public function mealItemInst() {
        $ItemArray = $this->input->post('ItemArry'); 
        $result = $this->obj->insertMealItemMaping($ItemArray); 
        if($result==1)
        {
                echo $result;
        }
        else
        {
            echo 0;
        }
        
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
   

    public function itemInst() 
    {
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        if(trim($_FILES["userfile"]["name"]) != "")
        {
            

            $target_dir = $GLOBALS['img_path'];

           // $target_dir =  base_url().'application/images/upload';
            $loginstatus   = $this->session->userdata('logged_in'); 
            $loginstatus['id'];
        
           $fname =  basename($this->prep_filename($loginstatus['id']."_".$locationid."_".date( "Y-m-d H:i:s", mktime(0, 0, 0))."_".rand(1000,100000).".png"));
           //$fname =  basename($this->prep_filename($locationid."_".trim($this->input->post('txtItemName'))."_".date( "Y-m-d H:i:s", mktime(0, 0, 0))."_".$_FILES["userfile"]["name"]));
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
                    $msg['success'] = false;
                    $msg['type'] = 'filenotsupported';
                    echo json_encode($msg);
                }
                else
                {

                             // Check if file already exists
                    if (file_exists($target_file)) 
                    {
                        //echo "Sorry, file already exists.";
                        $uploadOk = 0;
                        $msg['success'] = false;
                        $msg['type'] = 'filealreadyexists';
                        echo json_encode($msg); return;
                    }
                    // Check file size
                    if ($_FILES["userfile"]["size"] > 500000) 
                    {
                        //echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                        $msg['success'] = false;
                        $msg['type'] = 'largefile';
                        echo json_encode($msg); return;
                    }


                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) 
                    {
                        //echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                        $msg['success'] = false;
                        $msg['type'] = 'filenotuploaded';
                        echo json_encode($msg);
                    } 
                    else 
                    {
                        if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) 
                        {
                            //echo "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
                            
                            //$target_file1 = $GLOBALS['img_url'].$fname;
                            $target_file1 = $fname;
                            $result = $this->obj->insertItem($locationid, $target_file1);
                            $msg['success'] = false;
                            $msg['type'] = 'add';
                            if($result){
                                    $msg['success'] = true;
                            }
                            echo json_encode($msg);
                            
                        } 
                        else 
                        {
                            //echo "Sorry, there was an error uploading your file.";
                            $msg['success'] = false;
                            $msg['type'] = 'uploadfileerror';
                            echo json_encode($msg);
                        }
                    } 
                }
            } 
            else 
            {
                //echo "File is not an image."; die;
                $uploadOk = 0;
                $msg['success'] = false;
                $msg['type'] = 'filenotsupported';
                echo json_encode($msg);
            }  
          
           
        }
        else
        {
                            $target_file1 = '';
                            $result = $this->obj->insertItem($locationid, $target_file1);
                            $msg['success'] = false;
                            $msg['type'] = 'add';
                            if($result){
                                    $msg['success'] = true;
                            }
                            echo json_encode($msg); 
        }
        
    }
    
    public function ajaxCheckItem()
    {
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        $itemName = $this->input->post('itemName');
        $check = $this->obj->ajaxCheckMealName($itemName, $locationid);
        echo $check;
    }
    
    public function ajaxCheckItemalias()
    {
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        $itemName = $this->input->post('itemName');
        $check = $this->obj->ajaxCheckMealNameAlias($itemName, $locationid);
        echo $check;
        
    }

}

?>