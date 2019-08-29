<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'Requests/library/Requests.php';

 class BmTeacherReportController extends CI_Controller {

   	public function __construct()
   	{
             parent :: __construct(); 
             date_default_timezone_set('Asia/Kolkata');

          	 $this->load->model(array('Signup_model','Access_model','MenuSelection/BmTeacherReportModel'));
          	 $this->load->helper( array('form','url','email' )); 
          	 $this->load->library(array('session','form_validation','email'));
                 $loginstatus   = $this->session->userdata('logged_in'); 
                 if($loginstatus["status"] != '1')
                 {

                    redirect('logout');
                 }
                
                Requests::register_autoloader();

       
   	} 


	
    public function index() 
    { 
    	
    	 $service =  $this->Access_model->showAdminService();

         $this->load->view('Admin/MenuCreation/reportLunchCalendarView',['serviceData'=>$service]);

		 // By domPdf library 

		 // $this->pdf->loadHtml($html);
		 // $this->pdf->render();
    	
    }


    public function htmlTopdf() 
    {
             $this->load->library('M_pdf');
               $date = $this->input->post('date'); 
              // print_r($date); die;
            $report = $this->BmTeacherReportModel->showTeacherGrade($date);


           // print_r($report); die;
            $html = $this->load->view('Admin/MenuCreation/BmTeacherReportView',['reportData'=>$report],true);

              //  By Mpdf library can direct download
           $pdfFilePath ="Daily Lunch Label Report-".$date."-.pdf";
           $pdf = $this->m_pdf->load();
	       $pdf->WriteHTML($html,2);
	       $pdf->Output($pdfFilePath, "D");

    }
    
    public function bmMonthlyOrderReport() 
    { 
    	
    	 $service =  $this->Access_model->showAdminService();

         $this->load->view('Admin/MenuCreation/reportMonthlyOrderCalendarView',['serviceData'=>$service]);

		 // By domPdf library 

		 // $this->pdf->loadHtml($html);
		 // $this->pdf->render();
    	
    }
    
    public function monthlyOrderReport()
    {
        
        $service =  $this->Access_model->showAdminService();

        $date = $this->input->post('date1');

        $report = $this->BmTeacherReportModel->monthlyOrderReport($date);
        $this->load->view('Admin/MenuCreation/BmMonthlyOrderReportView',['reportData'=>$report, 'serviceData'=>$service]);
    }
    
    public function bmdailyDeatilReport() 
    { 
    	
    	 $service =  $this->Access_model->showAdminService();

         $this->load->view('Admin/MenuCreation/detailReportDailyOrderCalendarView',['serviceData'=>$service]);

		 // By domPdf library 

		 // $this->pdf->loadHtml($html);
		 // $this->pdf->render();
    	
    }
    
    public function dailyDeatilReport()
    {
        
        $service =  $this->Access_model->showAdminService();
        $date = $this->input->post('date');
        $report = $this->BmTeacherReportModel->dailyDetailOrderReport($date);
        $grades = $this->BmTeacherReportModel->getGrade();
        $this->load->view('Admin/MenuCreation/detailReportDailyOrderView',['reportData'=>$report, 'serviceData'=>$service,'grades'=>$grades]);
    }
    
    public function activateDeactiveCal()
    {
        if($this->input->server('REQUEST_METHOD') == 'POST')
        {
            $status1 = $this->input->post('radiocal');
            $this->BmTeacherReportModel->activateDeactivateCalUpdate($status1);
            $service =  $this->Access_model->showAdminService();
            $status = $this->BmTeacherReportModel->activateDeactivateCal();
            $this->load->view('Admin/MenuCreation/activateDeactivateView',['serviceData'=>$service, 'status'=>$status['status']]);
        }
        else
        {
            $service =  $this->Access_model->showAdminService();
            $status = $this->BmTeacherReportModel->activateDeactivateCal();
            $this->load->view('Admin/MenuCreation/activateDeactivateView',['serviceData'=>$service, 'status'=>$status['status']]);
        }
    }
    
    public function bmMonthlyOrderReportMilkOnly() 
    { 
    	
    	 $service =  $this->Access_model->showAdminService();

         $this->load->view('Admin/MenuCreation/reportMonthlyOrderCalendarMilkOnlyView',['serviceData'=>$service]);
    }
    
    public function monthlyOrderReportMilkOnly()
    {
        
        $service =  $this->Access_model->showAdminService();

        $date = $this->input->post('date1');

        $report = $this->BmTeacherReportModel->milkOnlyOrderReport($date);
        $this->load->view('Admin/MenuCreation/BmMonthlyOrderReportMilkOnlyView',['reportData'=>$report, 'serviceData'=>$service]);
    }
    
    


 }

 ?>