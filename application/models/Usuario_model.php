<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function do_insert($dados = NULL) {

        if ($dados != NULL):
            $this->db->insert('usuario', $dados);
            $this->session->set_flashdata('cadastrook', IconsUtil::getIcone(IconsUtil::ICON_OK
                    ).' Cadastro efetuado com sucesso!');
            redirect('usuario/cadastrar');
        endif;
    }

    public function do_delete($condicao = NULL) {

        if ($condicao != NULL):
            $this->db->delete('usuario', $condicao);
            $this->session->set_flashdata('excluirok', IconsUtil::getIcone(IconsUtil::ICON_OK). ' Registro deletado com sucesso!');
        endif;
    }

    public function get_all() {
        return $this->db->get('usuario');
    }

    public function get_byEmail_Admin($email = NULL, $senha = NULL) {
        if ($email != NULL && $senha != NULL):
            $sql = "SELECT * FROM usuario WHERE email = ? AND senha = ?";
            $query = $this->db->query($sql, array($email, $senha));
            if ($query->num_rows() > 0 && $query->num_rows() == 1):
                return $query;
            else:
                return false;
            endif;
        else:
            return false;

        endif;
    }
    
    public function get_byEmail_Professor($email = NULL, $senha = NULL) {
        if ($email != NULL && $senha != NULL):
            $sql = "SELECT * FROM professor WHERE email = ? AND senha = ?";
            $query = $this->db->query($sql, array($email, $senha));
            if ($query->num_rows() > 0 && $query->num_rows() == 1):
                return $query;
            else:
                return false;
            endif;
        else:
            return false;

        endif;
    }

    public function get_byEmailAt($email = NULL, $tabela = NULL) {
        if ($email != NULL && $tabela != NULL):
            $this->db->where('email', $email);
            $this->db->limit(1);
            return $this->db->get($tabela);
        else:
            return false;

        endif;
    }

    public function do_update($dados = NULL, $condicao = NULL) {
        if ($dados != NULL && $condicao != NULL):
            $this->db->update('usuario', $dados, $condicao);
            $this->session->nome = $dados['nome'];
            $this->session->set_flashdata('edicaook', IconsUtil::getIcone(IconsUtil::ICON_OK).' Dados alterado com sucesso!');
            redirect('usuario/update/');
        endif;
    }
    
    public function do_updatepassword($dados = NULL, $condicao = NULL) {
        if ($dados != NULL && $condicao != NULL):
            $TIPOUSUARIO = '';
            if($this->session->tipo == 1):
                $TIPOUSUARIO = 'professor';
            else:
                $TIPOUSUARIO = 'usuario';
            endif;
            $this->db->update($TIPOUSUARIO, $dados, $condicao);
            $this->session->set_flashdata('edicaook', IconsUtil::getIcone(IconsUtil::ICON_OK).' Senha alterada com sucesso!');
            redirect('usuario/updatepassword/');
        endif;
    }

}
