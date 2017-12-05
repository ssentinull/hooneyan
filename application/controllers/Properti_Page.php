<?php 
	defined('BASEPATH') OR exit('No direct script access allowed'); 

	class Properti_Page extends CI_Controller { 

		function __construct()
			{
				parent::__construct();		
				$this->load->model('m_properti_page');
				$this->load->helper(array('form', 'url'));
				$this->load->library('session');
			}

		public function index() 
			{ 
				$this->load->view('Web_Pages/Properti_Page/get_data');
			}

		public function get_data()
			{
				$id_properti = $this->input->post('id_properti');
				$data["properti"] = $this->m_properti_page->pilih($id_properti);
				$this->load->view('Web_Pages/Properti_Page', $data);
			}
	}