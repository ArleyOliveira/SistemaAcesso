<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Acesso_model extends CI_Model {

    public function do_insert($dados = NULL) {

        if ($dados != NULL):
            $this->db->insert('acessos', $dados);
        endif;
    }

    public function get_all() {
        return $this->db->get('acessosLab');
    }

}
