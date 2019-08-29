<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_controller extends CI_Controller {
 
    /**
     * Page function to provide 404 response.
     */
    public function show_404() {
        
        # Setting response header as 404
        $this->output->set_status_header('404');
        
        # Load the error view page form views folder (applications/views/error_page_404.php).
        $this->load->view('errors/html/error_404');
    }
 
}


?>