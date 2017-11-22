<?php 
	defined('BASEPATH') OR exit('No direct script access allowed'); 

	class Daftar_User extends CI_Controller
		{
			public function __construct()
				{
					parent::__construct();
					$this->load->helper('url');
					$this->load->model('user_model');
					$this->load->library('session');
				}	

			public function index() 
				{ 
					$this->load->helper('url');
					$this->load->view('Web_Pages/Daftar_User');
				}

			public function register_user()
				{
					$rawdate = htmlentities($_POST['tgl_lahir']);
					$tgl_lahir = date('Y-m-d', strtotime($rawdate));
					$user=array(
						'password'=>md5($this->input->post('password')),
						'nama_user'=>$this->input->post('nama_user'),
						'tipe_akun'=>$this->input->post('tipe_akun'),
						'tgl_lahir'=>$tgl_lahir,
						'email'=>$this->input->post('email'),
						'no_kontak'=>$this->input->post('no_kontak'),
					);
					print_r($user);
					$email_check = $this->user_model->email_check($user['email']);
					if($email_check)
						{
							$tipe_akun = $this->input->post('tipe_akun'); 
							if($tipe_akun == 1)
								$this->user_model->register_user($user);
							else
								$this->user_model->register_agen($user);								
							$this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');
							redirect('Homepage');
						}
					else
						{
							$this->session->set_flashdata('error_msg', 'Error occured,Try again.');
							redirect('Daftar_User');
						}
				}
		}
?>