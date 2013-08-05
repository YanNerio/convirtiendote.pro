<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*  Libreria para manejo de usuarios
*  creada por @guillermo_lc
*  www.convirtiendote.pro y @convirtiendoteP
*/

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function logout(){
		$this->libauth->logout();
	}

	public function login(){
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es necesario');

        if ($this->form_validation->run() == FALSE){
            $this->vista();
        }else{
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if( $this->libauth->login($email, $password) == TRUE){
                redirect('vista.php/vista/dashboard/');
            } else {
                $this->vista();
            }
        }
    }

    public function delete($email){
		if($this->libauth->delete($email)){
			$msg = "Usuario Borrado correctamente";
		} else {
			$msg = "No se pudo borrar";
		}
		$this->vista($msg);
	}

	public function update(){
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es necesario');

        if ($this->form_validation->run() == FALSE){
            $this->vista();
        }else{
        	$id = $this->input->post('id');
        	$email = $this->input->post('email');
        	$password = $this->input->post('password');
        	$nombre = $this->input->post('nombre');
        	$nivel = $this->input->post('nivel');

        	if($this->libauth->update($id,$email, $password, $nivel, $nombre)  != FALSE){
        		$msg = "Usuario Actualizado";
        	} else {
        		$msg = "No se ha podido actualizar";
        	}
        	$this->vista($id,$msg);
        }
	}

}
