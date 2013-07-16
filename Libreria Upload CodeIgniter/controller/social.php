<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*  Libreria para manejo de usuarios
*  creada por @guillermo_lc
*  www.convirtiendote.pro y @convirtiendoteP
*/

class Social extends CI_Controller {

	function __construct(){
		parent::__construct();
		//$this->_isLogedIn();
		$this->load->library('form_validation');
	}


	public function insert()
	{
		$this->form_validation->set_rules('titulo', 'titulo', 'trim|required');
		$this->form_validation->set_rules('descripcion', 'descripcion', 'trim|required');
		$this->form_validation->set_message('required', 'El campo %s es necesario');

		if ($this->form_validation->run() == FALSE){
			$this->index();
		}else{
			$titulo = $this->input->post('titulo');
			$destacado = $this->input->post('destacado');
			$descripcion = $this->input->post('descripcion');

			// realizamos un for para multi upload
			for($i = 0; $i < count($_FILES); $i++)  {   
				//no le hacemos caso a los bacios
				if(!empty($_FILES['imagen'.$i]['name'])){
	        		$respuesta[] = $this->libupload->doUpload($i,$_FILES['imagen'.$i],'social', 'jpg|png|jpeg|gif',9999, 9999, 0);   
            	}
            };

            //un foreach para recorrer la $respuesta y crear thumbs
            foreach ($respuesta as $key => $value) {
        		foreach ($value as $key2 => $value2) {
        			$thumb = $this->libupload->doThumb($value2['file_name'],'social', 200, 200);
        			print_r($value);
        		}
            }

		}
	}
}
