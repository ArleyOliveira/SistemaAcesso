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
	
    $dados = $this->CursoDAO->get_by_codigo($codigo)->row();
    
    echo PainelUtil::getOpenPainel(IconsUtil::getIcone(IconsUtil::ICON_PENCIL) . " Editar curso", PainelUtil::PAINEL_DEFAULT);
        echo DivUtil::openDivRow();
			  echo form_open("curso/editar");
                                echo DivUtil::openDivColMod("col-md-2");
                                echo DivUtil::closeDiv();
				echo DivUtil::openDivColMod("col-md-8");
                                echo form_label('Nome');
			        echo form_input(array('id' => 'nome', 'name' => 'nome', 'class' => 'form-control', 'placeholder' => 'Nome', 'value' => $dados->nome), set_value('nome'));
                                echo "<br>";
                                echo form_label('Área do conhecimento');
			        echo form_input(array('id' => 'area', 'name' => 'area', 'class' => 'form-control', 'placeholder' => 'Área do conhecimento', 'value' => $dados->area), set_value('area'));		    
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

