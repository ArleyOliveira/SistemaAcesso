<?php
    if(validation_errors() != NULL):
		echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_DANGER);
		echo validation_errors();
		echo ModMensagemUtil::getCloseAlertMensagem();
	endif;
	
    if($this->session->flashdata('cadastrook')):
            echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_SUCCESS);
            echo $this->session->flashdata('cadastrook');
            echo ModMensagemUtil::getCloseAlertMensagem();
    endif; 
    
    $codigo = $this->uri->segment(3);
	if($codigo == NULL) redirect('curso/consultar');
    
    $dados = $this->DisciplinaDAO->get_by_codigo($codigo)->row();
    $cursos = $this->CursoDAO->get_all();
    
    echo PainelUtil::getOpenPainel(IconsUtil::getIcone(IconsUtil::ICON_PENCIL) . " Editar disciplina", PainelUtil::PAINEL_DEFAULT);
        echo DivUtil::openDivRow();
			  echo form_open("disciplina/editar");
                                echo DivUtil::openDivColMod("col-md-2");
                                echo DivUtil::closeDiv();
				echo DivUtil::openDivColMod("col-md-8");
                                echo form_label('Nome');
			        echo form_input(array('id' => 'nome', 'name' => 'nome', 'class' => 'form-control', 'placeholder' => 'Nome', 'value' => $dados->nome), set_value('nome'));
                                echo "<br>";
                                echo '
                                        <div class="form-group">
                                          <label for="sel1">Curso </label>
                                          <select class="form-control select2" id="sel1" name="curso">';

                                                foreach ($cursos->result() as $row):
                                                      if($row->codigo == $dados->curso)  
                                                        echo '<option value="'.$row->codigo.' " selected="selected">'.$row->nome.'</option>';
                                                      else 
                                                        echo '<option value="'.$row->codigo.' ">'.$row->nome.'</option>';
                                                endforeach;
                                          echo '</select>
                                        </div>';
                                echo form_hidden("codigo", $dados->codigo);
                                echo "<br>";
                                echo '<div class="text-right">';
                                    echo BotaoUtil::getBataoSubmit(IconsUtil::getIcone(IconsUtil::ICON_SALVAR) . ' Salvar', BotaoUtil::BTN_WARNING);
                                echo '</div>';
			    echo DivUtil::closeDiv();
			  echo form_close();
			  echo DivUtil::closeDivRow();
    echo PainelUtil::getClosePainel();
?>

