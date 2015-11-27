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
?>
<a name="cadastro"></a>
<div class="panel panel-default">
  <div class="panel-heading">    
  	<h3 class="panel-title">
  		<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Cadastro de Usuário</h3>
  </div>
  <div class="panel-body">
  
<?php
	echo form_open('usuario/cadastrar');
        echo '<h4> <span class="label label-default">Nome </span> </h4>';
	
	echo form_input(array('id' => 'nome', 'name' => 'nome', 'class' => 'form-control', 'placeholder' => 'Nome Completo'), set_value('nome')) . "<br />";
        ?>
            <h4> <span class="label label-default">Sexo </span> </h4>
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                <input type="radio" id="option-1" class="mdl-radio__button" name="sexo" value="feminino" checked />
                <span class="mdl-radio__label">Feminino</span>
             </label>
             <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                <input type="radio" id="option-2" class="mdl-radio__button" name="sexo" value="masculino" />
                <span class="mdl-radio__label">Masculino</span>
             </label><br><br>
        <?php
        echo '<h4> <span class="label label-default">Data de Nascimento </span> </h4>';	
	echo '<input type="date" name="datanasc" id="datanasc" class="form-control">';
	echo form_label('Email (*)') . "<br />";
	echo form_input(array('name' => 'email', 'type' => 'email',  'class' => 'form-control' , 'placeholder' => 'exemple@exemple.com'), set_value('email')) . "<br />";
?>
	<div class="row">
	  <div class="col-md-6">
	  	<?php
	  		echo form_label("Senha") . "<br />";
	  		echo form_password(array('name' => 'senha', 'class' => 'form-control'), set_value('senha')) . "<br />";
	 	?>
	  </div>
	</div>
	
	<div class="row">
	  <div class="col-md-6">
	  	<?php
	  		echo form_label("Repita a senha") . "<br />";
			echo form_password(array('name' => 'senha2', 'class' => 'form-control'), set_value('senha2')) . "<br />";
	 	?>
	  </div>
	</div>
<?php
	echo DivUtil::openDivRow();
	echo DivUtil::openDivColMod("col-md-12");
			echo '<span id="sumit" style="display: inline;float: right;">';
			echo BotaoUtil::getBataoSubmit(IconsUtil::getIcone(IconsUtil::ICON_SEND) . ' Cadastrar ', BotaoUtil::BTN_PRIMARY);
			echo '</span>';
		echo DivUtil::closeDiv();
		echo DivUtil::closeDivRow();
	echo form_close();
	
?>
 </div>
</div>


