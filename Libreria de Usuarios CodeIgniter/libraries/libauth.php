<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script'); 
/*
*  Libreria para manejo de usuarios
*  creada por @guillermo_lc
*  www.convirtiendote.pro y @convirtiendoteP
*/
class Libauth
{
	protected $ci;
	
	function __construct()
	{
		$this->CI =& get_instance();
	}

	/* metodo para buscar un usuario */
	public function find($email, $password = NULL){
		if(empty($password) || $password == NULL){
			$query = $this->CI->db->get_where('users', array('email' => $email));
		} else {
			$query = $this->CI->db->get_where('users', array('email' => $email,'password' => $password));
		}
		return ($query->num_rows() > 0) ? $query->row() : FALSE;
	}

	/* metodo para hacer login */
	public function login($email, $password){
		if(($find = $this->find($email, $password)) == FALSE){
			$data['error'] = "Error usuario no encontrado";
			return FALSE;
		} else {
			$this->CI->session->sess_destroy();	
			$this->CI->session->sess_create();
			$this->CI->session->set_userdata(array(
												'nivel'    => $find->nivel,
												'logedIn'  => true,
												'email'    => $email,
												'password' => $password,
											));
			return TRUE;
		}
	}

	/* metodo para hacer un logut */
	public function logout(){
		$this->CI->session->sess_destroy();
		redirect('/');
	}

	/* metodo para crear un usuario */
	public function create($email, $password, $nivel = NULL, $nombre = NULL){
		if($this->find($email) == TRUE){
			return FALSE;
		} else {
			$data  = array (
				'email' => $email,
				'password' => $password,
				'nivel' => $nivel,
				'nombre' => $nombre,
			);
			if($this->CI->db->insert('users',$data)){
				return TRUE;
			}
		}
	}

	/* metodo para actualizar un usuario */
	public function update($usuario_id,$email, $password = NULL, $nivel = NULL, $nombre = NULL){
		if($this->find($email) == FALSE){
			return FALSE;
		} else {
			$data  = array (
				'email' => $email,
				'password' => $password,
				'nivel' => $nivel,
				'nombre' => $nombre,
			);
			$this->CI->db->where('user_id', $usuario_id);
			return 	$this->CI->db->update('users',$data);
		}
	}
   	
   	/* metodo para borrar un usuario */
	public function delete($id){
		$this->CI->db->where('user_id', $id)->delete('users');
		return ($this->CI->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	/* metodo para enlistar los usuarios */
	public function getAll(){
		$this->CI->db->select('user_id,email,password,nivel,nombre');
        $this->CI->db->from('users');
        $query = $this->CI->db->get();
        return ($query->result() > 0) ? $query->result() : FALSE;
	}

	/* metodo para buscar un usuario por su ID */
	public function findById($id){
		if(!empty($id) || $id != NULL){
			$query = $this->CI->db->get_where('users', array('user_id' => $id));
		} else {
			return FALSE;
		}
		return ($query->row() !=  NULL || $query->row() != "") ? $query->row() : FALSE;
	}

	/* metodo para ver si el usuario esta logeado */
	public function isLogedIn(){
		if ($this->CI->session->userdata('logedIn') != true) {
			redirect('./');
		}
	}
	
}