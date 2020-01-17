<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __constructor() {
		parent::__contructor();
    }

	public function test() {
        echo 'Controller listo';
	}
	
	public function index(){
		$databasesArray = $this->usuario->getAllDataBaseList();
		$this->load->view('login', compact('databasesArray'));
	}

	public function checklogin(){
	
		if (!empty($_POST)) {
			$usuario = $this->input->post('usuario');
			$password = $this->input->post('password');
			$codedatabase = $this->input->post('tipoinstitucion');
			$codebodega = $this->input->post('bodega');

			$dataDB = $this->usuario->checklogin($usuario, $password);

			if ($usuario==trim($dataDB->Cedula)) {
				$newdata = array(
					'usercode'  => $dataDB->Codigo,
					'codedatabase' => $codedatabase,
					'codebodega' => $codebodega,
					'cedula' => $dataDB->Cedula,
					'nombreusuario'  => $dataDB->Nombre . $dataDB->Apellido,
					'user_role'     => trim($dataDB->CodDpto),
					'logged_in' => TRUE
				);
			
			$this->session->set_userdata($newdata);
			redirect('CarteraCliente/');	 // TO controller
			} else {
	
				$this->session->set_flashdata('errormassage','Usuario o contraseña incorrecta');
				redirect('login');		
			}
		}else {
			redirect('login');	
		}
	}

	public function getLocales(){
		$db_code = $this->input->get('db_code');
		$resultSet = $this->usuario->getAllLocalesByEmpresa($db_code);
        echo json_encode($resultSet);
	}

	public function logout(){
		$this->load->library('session');
    	$this->session->sess_destroy();

		redirect('/');
	}
}