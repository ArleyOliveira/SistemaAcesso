<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Professor_model extends CI_Model{
 	
	public function do_insert($dados=NULL){
		
		if($dados != NULL):
			$this->db->insert('professor', $dados);
			$this->session->set_flashdata('cadastrook', IconsUtil::getIcone(IconsUtil::ICON_OK) .' Cadastro efetuado com sucesso!');
			redirect('professor/cadastrar');
		endif;
	}
	
	
	public function do_delete($condicao = NULL){
		
		if($condicao != NULL):
			$this->db->delete('usuario', $condicao);
			$this->session->set_flashdata('excluirok', 'Registro deletado com sucesso!');
		endif;
		
		redirect('crud/retrieve');
	}
	
	public function get_all(){
		return $this->db->get('professor');
	}
	
	public function get_byEmail($email= NULL, $senha = NULL){
		if($email != NULL && senha != NULL):
			$sql = "SELECT * FROM usuario WHERE email = ? AND senha = ?";
			$query = $this->db->query($sql, array($email, $senha));
			if($query->num_rows() > 0 && $query->num_rows() == 1):
				return $query;
			else:
				return false;
			endif;
		else:	
			return false;
		
		endif;		
	}
	
	public function get_byEmailAt($email = NULL){
		if($email != NULL):
			$this->db->where('email', $email);
			$this->db->limit(1);
			return $this->db->get('professor');
		else:	
			return false;
		
		endif;		
	}
        
        public function get_byIdentificador($identificador = NULL){
		if($identificador != NULL):
			$this->db->where('identificador', $identificador);
			$this->db->limit(1);
                        
			$query = $this->db->get('professor');
                        if($query->num_rows() > 0 && $query->num_rows() == 1):
				return $query;
			else:
				return false;
			endif;
		else:	
			return false;
		
		endif;		
	}
	
        public function get_byCodigo($codigo = NULL){
		if($codigo != NULL):
			$this->db->where('codigo', $codigo);
			$this->db->limit(1);
			return $this->db->get('professor')->result();
		else:	
			return false;
		
		endif;		
	}
	public function do_update($dados = NULL, $condicao = NULL){
		if($dados != NULL && $condicao != NULL):
			$this->db->update('professor', $dados, $condicao);
			$this->session->nome = $dados['nome'];
			$this->session->set_flashdata('edicaook', 'Dados alterado com sucesso!');
			redirect(current_url());
		endif;
	}
        public function do_updateIdentificador($dados = NULL, $condicao = NULL){
		if($dados != NULL && $condicao != NULL):
			$this->db->update('professor', $dados, $condicao);
			$this->session->nome = $dados['nome'];
			$this->session->set_flashdata('cadastrook', IconsUtil::getIcone(IconsUtil::ICON_OK).' Operação realizada com sucesso!');
			redirect(current_url());
		endif;
	}
 }
