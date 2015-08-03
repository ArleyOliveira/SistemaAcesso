<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Curso_model extends CI_Model{
 	
	public function do_insert($dados=NULL){
                $curso = $this->getByNome($dados['nome']);
                if($curso != false):
                    $codigo = 0;
                    foreach ($curso as $value) {
                        $codigo = $value->codigo;
                    }
                    $condicao = array('codigo' => $codigo);
                    $dadosAtualizar = array('nome' => $dados['nome'], 'area' => $dados['area'], 'f' => 1);
                    $this->db->update('curso', $dadosAtualizar, $condicao);
                    $this->session->set_flashdata('cadastrook', IconsUtil::getIcone(IconsUtil::ICON_OK) .' Constatamos que o curso havia sido cadastrado. Então este foi recuperado com sucesso!');
                    redirect('/curso/cadastrar');
                 else:
			$this->db->insert('curso', $dados);
			$this->session->set_flashdata('cadastrook', IconsUtil::getIcone(IconsUtil::ICON_OK) .' Cadastro efetuado com sucesso!');
			redirect('/curso/cadastrar');
		endif;
	}
	
         public function getByNome($nome = NULL){
                if($nome != NULL):
                        
			$this->db->where('nome', $nome);
			$this->db->limit(1);
			return $this->db->get('curso')->result();
		else:	
			return false;
		
		endif;
            
        }
	
	public function do_delete($dados = NULL, $condicao = NULL){
		if($dados != NULL && $condicao != NULL):
			$this->db->update('curso', $dados, $condicao);
			$this->session->set_flashdata('excluirok',IconsUtil::getIcone(IconsUtil::ICON_OK) . ' Dados excluido com sucesso!');
			redirect('curso/consultar');
		endif;
	}
	
	public function get_all(){
                $this->db->where('f', '1');
		return $this->db->get('curso');
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
	
	public function get_by_codigo($codigo = NULL){
		if($codigo != NULL):
                        
			$this->db->where('codigo', $codigo);
			$this->db->limit(1);
			return $this->db->get('curso');
		else:	
			return false;
		
		endif;		
	}
	
	public function do_update($dados = NULL, $condicao = NULL){
		if($dados != NULL && $condicao != NULL):
			$this->db->update('curso', $dados, $condicao);
			$this->session->set_flashdata('edicaook',IconsUtil::getIcone(IconsUtil::ICON_OK) . ' Dados alterado com sucesso!');
			redirect('curso/consultar');
		endif;
	}
 }
