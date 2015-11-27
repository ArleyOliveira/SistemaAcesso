<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Semestre_model extends CI_Model{
 	
	public function do_insert($dados=NULL){
		$this->atualizaStatusDoSemestre();
		if($dados != NULL):
			$this->db->insert('semestreletivo', $dados);
			$this->session->set_flashdata('cadastrook', IconsUtil::getIcone(IconsUtil::ICON_OK) .' Cadastro efetuado com sucesso!');
			redirect('gerenciador/cadastrar');
		endif;
	}
	
	public function get_all(){
		return $this->db->get('semestreletivo');
	}
	
	public function atualizaStatusDoSemestre(){
            $dados = array('status' => 0);
            $condicao = array('status' => 1);
            $this->db->update('semestreletivo', $dados, $condicao);
            $this->db->where('status', 1);	
	}
	
	public function get_SemestreAtual(){
            $this->db->where('status', 1);
            $this->db->limit(1);
            return $this->db->get('semestreletivo');	
	}
        public function verificaAnoSemestre($ano=NULL, $semestre=NULL){
            if($ano != NULL and $semestre != NULL):
                $sql = "SELECT * FROM semestreletivo WHERE ano = ? and semestre = ?"; 
                $query = $this->db->query($sql, array($ano, $semestre));
                
                if($query->num_rows() > 0 && $query->num_rows() == 1):
                    return true;
		else:
                    return false;
		endif;
            else:	
		return false;
            endif;
        }
 }  
