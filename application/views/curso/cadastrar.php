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
    
    echo PainelUtil::getOpenPainel(IconsUtil::getIcone(IconsUtil::ICON_PLUS_SING) . " Cadastro de curso", PainelUtil::PAINEL_DEFAULT);
        echo DivUtil::openDivRow();
			  echo form_open("curso/cadastrar");
                                echo DivUtil::openDivColMod("col-md-2");
                                echo DivUtil::closeDiv();
				echo DivUtil::openDivColMod("col-md-8");
                                echo form_label('Nome');
			        echo form_input(array('id' => 'nome', 'name' => 'nome', 'class' => 'form-control', 'placeholder' => 'Nome'), set_value('nome'));
                                echo "<br>";
                                echo form_label('Área do conhecimento');
			        echo form_input(array('id' => 'area', 'name' => 'area', 'class' => 'form-control', 'placeholder' => 'Área do conhecimento'), set_value('area'));		    
                                echo "<br>";
                                echo '<div class="text-right">';
                                    echo BotaoUtil::getBataoSubmit(IconsUtil::getIcone(IconsUtil::ICON_SEND) . ' Cadastrar', BotaoUtil::BTN_PRIMARY);
                                echo '</div>';
			    echo DivUtil::closeDiv();
			  echo form_close();
			  echo DivUtil::closeDivRow();
    echo PainelUtil::getClosePainel();
?>
