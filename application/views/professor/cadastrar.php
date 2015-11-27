<?php

if (validation_errors() != NULL):
    echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_DANGER);
    echo validation_errors();
    echo ModMensagemUtil::getCloseAlertMensagem();
endif;

if ($this->session->flashdata('cadastrook')):
    echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_SUCCESS);
    echo $this->session->flashdata('cadastrook');
    echo ModMensagemUtil::getCloseAlertMensagem();
endif;
echo PainelUtil::getOpenPainel(IconsUtil::getIcone(IconsUtil::ICON_PLUS_SING) . " Cadastro de professor", PainelUtil::PAINEL_DEFAULT);
echo DivUtil::openDivRow();
echo form_open("professor/cadastrar");
echo DivUtil::openDivColMod("col-md-1");
echo DivUtil::closeDiv();
echo DivUtil::openDivColMod("col-md-10");
    echo '<h4> <span class="label label-default"> Nome completo *</span> </h4>';
    echo form_input(array('id' => 'nome', 'name' => 'nome', 'class' => 'form-control', 'placeholder' => 'Nome', 'onfocus'), set_value('nome'));
    echo DivUtil::openDivRow();
        echo DivUtil::openDivColMod("col-md-6");
            echo '<h4> <span class="label label-default">SIAPE *</span> </h4>';
            echo form_input(array('id' => 'siape', 'name' => 'siape', 'class' => 'form-control', 'placeholder' => 'SIAPE'), set_value('siape'));
        echo DivUtil::closeDiv();
        echo DivUtil::openDivColMod("col-md-6");
            echo '<h4> <span class="label label-default">CPF *</span> </h4>';
            echo form_input(array('id' => 'cpf', 'name' => 'cpf', 'class' => 'form-control', 'placeholder' => 'CPF'), set_value('cpf'));
        echo DivUtil::closeDiv();
    echo DivUtil::closeDivRow();
    echo DivUtil::openDivRow();
        echo DivUtil::openDivColMod("col-md-6");
            echo '<h4> <span class="label label-default">Data de Nascimento </span> </h4>';
            echo form_input(array('id' => 'datanasc', 'type' => 'date', 'name' => 'datanasc', 'class' => 'form-control', 'placeholder' => ''), set_value('datanasc'));
           
        echo DivUtil::closeDiv();
    echo DivUtil::closeDivRow();
    echo DivUtil::openDivRow();
        echo DivUtil::openDivColMod("col-md-10");
            ?>
                <h4> <span class="label label-default">Sexo </span> </h4>
                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1" style="padding-right: 50px">
                    <input type="radio" id="option-1" class="mdl-radio__button" name="sexo" value="feminino"/>
                    <span class="mdl-radio__label">Feminino</span>
                </label>
                
                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                    <input type="radio" id="option-2" class="mdl-radio__button" name="sexo" value="masculino" />
                    <span class="mdl-radio__label">Masculino</span>
                </label>
            <?php
        echo DivUtil::closeDiv();          
    echo DivUtil::closeDivRow();
    echo "<br>";
    echo '<h4> <span class="label label-primary">Informações de login </span> </h4>';
    echo '<hr>';
    echo '<h4> <span class="label label-warning">Email </span> </h4>';
    echo form_input(array('name' => 'email', 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'exemple@exemple.com'), set_value('email'));
    
    echo DivUtil::openDivRow();
        echo DivUtil::openDivColMod("col-md-6");
                echo '<h4> <span class="label label-info">Senha </span> </h4>';
                echo form_password(array('name' => 'senha', 'class' => 'form-control'), set_value('senha'));
        echo DivUtil::closeDiv();
    
        echo DivUtil::openDivColMod("col-md-6");        
                echo '<h4> <span class="label label-info"> Repita a senha </span> </h4>';
                echo form_password(array('name' => 'senha2', 'class' => 'form-control'), set_value('senha2'));    
        echo DivUtil::closeDiv();          
    echo DivUtil::closeDivRow();
    echo '<br>';
    echo '<div class="text-right">';
        echo BotaoUtil::getBataoSubmit(IconsUtil::getIcone(IconsUtil::ICON_SEND) . ' Cadastrar', BotaoUtil::BTN_PRIMARY);
    echo '</div>';
echo DivUtil::closeDiv();
echo form_close();
echo DivUtil::closeDivRow();
echo PainelUtil::getClosePainel();
