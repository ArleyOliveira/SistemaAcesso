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
    
    if($this->session->flashdata('alerta')):
            echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_WARNING);
            echo $this->session->flashdata('alerta');
            echo ModMensagemUtil::getCloseAlertMensagem();
    endif; 

    
        
    echo PainelUtil::getOpenPainel(IconsUtil::getIcone(IconsUtil::ICON_PLUS_SING) . " Cadastro de semestre", PainelUtil::PAINEL_DEFAULT);
        echo DivUtil::openDivRow();
			  echo form_open("semestre/cadastrar");
                                echo DivUtil::openDivColMod("col-md-2");
                                echo DivUtil::closeDiv();
				echo DivUtil::openDivColMod("col-md-6");
                                echo '<h4> <span class="label label-default"> Ano * </span> </h4>';
			        echo form_input(array('id' => 'nome', 'name' => 'ano', 'class' => 'form-control', 'placeholder' => 'Ano', 'type' => 'numeric'), set_value('ano'));
                                echo "<br>";
                                echo '<h4> <span class="label label-default"> Semestre * </span> </h4>';
                                ?>

                                <select name="semestre" id="semestre" multiple class="form-control">
                                    <option value="1"> 1º semestre </option>
                                    <option value="2"> 2º semestre </option>
                                </select>
                                <br/>
                                <?php
                                echo DivUtil::closeDiv();
                                echo DivUtil::openDivRow();
                                echo DivUtil::openDivColMod("col-md-8");
                                    echo '<div class="text-right">';
                                        echo BotaoUtil::getBataoSubmit(IconsUtil::getIcone(IconsUtil::ICON_SEND) . ' Cadastrar', BotaoUtil::BTN_PRIMARY);
                                    echo '</div>';
                                echo DivUtil::closeDiv();
			    echo DivUtil::closeDiv();
			  echo form_close();
			  echo DivUtil::closeDivRow();
    echo PainelUtil::getClosePainel();
?>
