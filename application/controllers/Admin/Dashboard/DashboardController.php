<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {
    
    public function __construct() {
    parent::__construct();
         $this->load->library('session');
         $this->load->model('Access_model');
            $loginstatus   = $this->session->userdata('logged_in'); 
               if($loginstatus["status"] != '1')
                   {     
                      redirect('logout');
                    }

    }
   
    public function index()
    {
        
        
        $this->load->model('Dashboard/DashboardModel','obj');
        $data =  $data = $this->obj->getMenuItemByDate(); 
        //print_r($data);
        //die;
       // $dataItem = $this->obj->getItem();
        
        $x = 'hi divesh';
        
       $prefs['template'] = '
        {table_open}<table class="table table-bordered table-hover  no-footer dtr-inline">{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
        {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}';
       
        $prefs['start_day'] = 'monday';
        $prefs['month_type'] = 'long';
        $prefs['day_type'] = 'abr';
        $prefs['show_next_prev'] = true;
        $prefs['next_prev_url'] = 'http://localhost/st-john/dashboard/index';
        $prefs['show_other_days'] = false;

   
//        $prefs = array(
//        'template'     =>  $prefs1,
//        'start_day'    => 'monday',
//        'month_type'   => 'long',
//        'day_type'     => 'abr',
//        'show_next_prev'   => true,
//        'next_prev_url'   => 'http://localhost/st-john/dashboard/',
//        'show_other_days'  => false
//        );
        
        $this->load->library('calendar', $prefs);
        
        $data1 = array(
        3  => 'http://example.com/news/article/2006/06/03/',
        7  => 'http://example.com/news/article/2006/06/07/',
        13 => 'http://example.com/news/article/2006/06/13/',
        26 => 'http://example.com/news/article/2006/06/26/'
        );
        
        $dataCal = array(
        'year' => $this->uri->segment(3),
        'month' => $this->uri->segment(4)
        );

        $service = $this->Access_model->showAdminService();
        
        $this->load->view('Admin/Dashboard/dashboardView',
              ['data'=>$data, 'caldata'=>$data1, 'dataCal'=>$dataCal,'serviceData'=>$service] );
    }
    
    public function ajaxItem()
    {
        echo $menu = $this->input->post('id'); 
        //echo "Hi Div";
    }
    
     public function insertMenuItem()
    {
       $date = $this->input->post('date');
       $menuID = $this->input->post('optionsRadios'); 
       $itemID = $this->input->post('optionsCheck'); 
       
       $this->load->model('MenuSelection/MenuItemSelModel','obj');
       //$dataMenu = $this->obj->insertMenuItemMapping($menuID, $itemID);
       //print_r($itemID);
       // echo "Hi Div";
       if($this->obj->insertMenuItemMapping($date, $menuID, $itemID))
       {
            redirect('menuitemsel', 'refresh');
       }
    }



}

?>