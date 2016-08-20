<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horario_model extends CI_Model
{

    public function do_insert($dados = NULL)
    {

        if ($dados != NULL):
            $this->db->insert('horario', $dados);
            //$this->session->set_flashdata('cadastrook', IconsUtil::getIcone(IconsUtil::ICON_OK) .' Cadastro efetuado com sucesso!');
            //redirect('gerenciador/cadastrar');
        endif;
    }

    public function get_all()
    {
        return $this->db->get('horario');
    }


    public function get_PorLaboratorio($lab = NULL, $semestreLetivo = NULL)
    {
        try {

            if ($lab != NULL && $semestreLetivo != NULL) {

                for ($i = 2; $i <= 7; $i++) {
                    $horario[$i] = array();
                    $sql = "SELECT h.codigo, d.nome as disciplina, TIME_FORMAT(inicio, '%H:%i') as inicio, TIME_FORMAT(fim, '%H:%i') as fim FROM horario h join disciplina d on h.disciplina = d.codigo where lab = ? and semestreletivo = ? and dia = ? order by inicio";
                    $query = $this->db->query($sql, array($lab, $semestreLetivo, $i));

                    foreach ($query->result() as $key=> $value) {
                        $horario[$i][] = (array('codigo' => $value->codigo, 'disciplina' => $value->disciplina, 'inicio' => $value->inicio, 'fim' => $value->fim));
                    }
                }

                return array(
                    'segunda' => $horario[2],
                    'terca' => $horario[3],
                    'quarta' => $horario[4],
                    'quinta' => $horario[5],
                    'sexta' => $horario[6],
                    'sabado' => $horario[7],
                );

            }
        }catch (Exception $e){
            echo "Ocorreu um erro ao tentar buscar os horários agendados!";
        }
        return false;
    }

    public function do_delete($condicao = NULL)
    {
        if ($condicao != NULL):
            $this->db->delete('horario', $condicao);
            $this->session->set_flashdata('excluirok', IconsUtil::getIcone(IconsUtil::ICON_OK) . ' Registro deletado com sucesso!');
        endif;
    }

}
