<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Disciplina_model extends CI_Model{
 	
	public function do_insert($dados=NULL){
		
		if($dados != NULL):
			$this->db->insert('disciplina', $dados);
			$this->session->set_flashdata('cadastrook', IconsUtil::getIcone(IconsUtil::ICON_OK) .' Cadastro efetuado com sucesso!');
			redirect('/disciplina/cadastrar');
		endif;
	}

        public function do_delete($condicao = NULL){
		if($condicao != NULL):
			$this->db->delete('disciplina', $condicao);
			$this->session->set_flashdata('excluirok', IconsUtil::getIcone(IconsUtil::ICON_OK) .' Registro deletado com sucesso!');
                endif;
	}
	
        public function get_by_codigo($codigo = NULL){
		if($codigo != NULL):
                        
			$this->db->where('codigo', $codigo);
			$this->db->limit(1);
			return $this->db->get('disciplina');
		else:	
			return false;
		
		endif;		
	}
        
	public function get_all(){
      		return $this->db->get('disciplinas');
	}
        
	public function do_update($dados = NULL, $condicao = NULL){
		if($dados != NULL && $condicao != NULL):
			$this->db->update('disciplina', $dados, $condicao);
			$this->session->nome = $dados['nome'];
			$this->session->set_flashdata('edicaook', IconsUtil::getIcone(IconsUtil::ICON_OK) . ' Dados alterado com sucesso!');
			redirect('disciplina/consultar');
		endif;
	}
 }
