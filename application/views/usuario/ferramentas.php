<?php
    $perfil = '';
    $senha = '';
    $useradmin = '';
    $outros = '';
    if($active == 'perfil')
      $perfil = 'active';
    else  if($active == 'senha')
      $senha = 'active';
    else if($active == 'useradmin')
      $useradmin = 'active';
    else 
      $outros = 'active';
    $TIPODEUSUARIO = '';
    if($this->session->tipo == 1):
        $usuario = $this->UsuarioDAO->get_byEmailAt($this->session->email,'professor');
        $TIPODEUSUARIO = 'professor';
    else:
        $usuario = $this->UsuarioDAO->get_byEmailAt($this->session->email,'usuario');
        $TIPODEUSUARIO = 'usuario';
    endif;
    $user;
    if($usuario != false){
        
        foreach ($usuario->result() as $value) {
            $user = $value;
        }
    }
?>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-justified" role="tablist">
      <li role="presentation" class="<?php echo $perfil ?>"><a href="#perfil" aria-controls="perfil" role="tab" data-toggle="tab"><i class="material-icons">create</i> Perfil</a></li>
    <li role="presentation" class="<?php echo $senha ?>"><a href="#senha" aria-controls="senha" role="tab" data-toggle="tab"><i class="material-icons">security</i> Segurança</a></li>
    <li role="presentation" class="<?php echo $useradmin ?>"><a href="#useradmin" aria-controls="useradmin" role="tab" data-toggle="tab"><i class="material-icons">person_add </i> Administrador</a></li>
    <li role="presentation" class="<?php echo $outros ?>"><a href="#outros" aria-controls="outros" role="tab" data-toggle="tab"><i class="material-icons">settings</i>Mais</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <br>
    <?php 
        if ($this->session->flashdata('edicaook')):
            echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_SUCCESS);
            echo $this->session->flashdata('edicaook');
            echo ModMensagemUtil::getCloseAlertMensagem();
        endif;
        if(validation_errors() != NULL):
		echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_DANGER);
		echo validation_errors();
		echo ModMensagemUtil::getCloseAlertMensagem();
	endif;
    ?>
    <!-- inicio dados perfil -->
    <div role="tabpanel" class="<?php echo 'tab-pane '.$perfil ?>" id="perfil">
        <?php
            echo '<h3> <span class="label label-primary"> <span class="glyphicon glyphicon-list-alt"></span> Dados de perfil </span> </h3>';
            echo '<br>';
            echo DivUtil::openDivRow();
                echo form_open($TIPODEUSUARIO.'/update');
                echo DivUtil::openDivColMod("col-md-10");
                    echo '<h4> <span class="label label-default"> Nome completo </span> </h4>';
                    echo form_input(array('id' => 'nome', 'name' => 'nome', 'class' => 'form-control', 'placeholder' => 'Nome', 'value' => $user->nome), set_value('nome'));
                echo DivUtil::closeDiv();          
            echo DivUtil::closeDivRow();
            if($this->session->tipo == 1):
                echo DivUtil::openDivRow();
                    echo DivUtil::openDivColMod("col-md-5");
                        echo '<h4> <span class="label label-default">SIAPE</span> </h4>';
                        echo form_input(array('id' => 'siape', 'name' => 'siape', 'class' => 'form-control', 'placeholder' => 'SIAPE', 'value' => $user->siape), set_value('siape'));
                    echo DivUtil::closeDiv();
                    echo DivUtil::openDivColMod("col-md-5");
                        echo '<h4> <span class="label label-default">CPF </span> </h4>';
                        echo form_input(array('id' => 'cpf', 'name' => 'cpf', 'class' => 'form-control', 'placeholder' => 'CPF', 'value' => $user->cpf), set_value('cpf'));
                    echo DivUtil::closeDiv();
                echo DivUtil::closeDivRow();
                
            endif;
            echo DivUtil::openDivRow();
                echo DivUtil::openDivColMod("col-md-5");
                    echo '<h4> <span class="label label-default">Data de Nascimento </span> </h4>';
                    echo form_input(array('id' => 'datanasc', 'type' => 'date', 'name' => 'datanasc', 'class' => 'form-control', 'placeholder' => '', 'value' => $user->datanasc), set_value('datanasc'));
                 echo DivUtil::closeDiv();
            echo DivUtil::closeDivRow();
            echo DivUtil::openDivRow();
                echo DivUtil::openDivColMod("col-md-10");
                    $sexo = 1;
                 ?>
                    <h4> <span class="label label-default">Sexo </span> </h4>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1" style="padding-right: 50px">
                        <?php 
                            if($user->sexo == 'feminino')
                              echo '<input type="radio" id="option-1" class="mdl-radio__button" name="sexo" value="Feminino" checked />';
                            else
                              echo '<input type="radio" id="option-1" class="mdl-radio__button" name="sexo" value="Feminino"/>';   
                         ?>
                        <span class="mdl-radio__label">Feminino</span>
                    </label>
                   
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                        <?php
                            if($user->sexo == 'masculino')
                               echo '<input type="radio" id="option-2" class="mdl-radio__button" name="sexo" value="Masculino" checked/>';
                            else
                                echo '<input type="radio" id="option-2" class="mdl-radio__button" name="sexo" value="Masculino" />';
                          ?>
                        <span class="mdl-radio__label">Masculino</span>
                    </label>
                <?php
                 echo DivUtil::closeDiv(); 
            echo DivUtil::closeDivRow();
            echo DivUtil::openDivRow();
                echo '<div class="col-md-10 text-right">';
                        echo '<br>';
                        echo BotaoUtil::getBataoSubmit(IconsUtil::getIcone(IconsUtil::ICON_SALVAR) . ' Salvar alterações', BotaoUtil::BTN_WARNING);
                echo '</div>';
            echo DivUtil::closeDivRow();
        echo form_close();
        ?>
    
    </div>    
    <!-- fim dados perfil -->
    
    <!-- inicio dados senha -->
    <div role="tabpanel" class="<?php echo 'tab-pane '.$senha ?>"  id="senha">
  
        <?php
           echo form_open('usuario/updatepassword');
           
           echo '<h3> <span class="label label-primary"> <span class="glyphicon glyphicon-pencil"></span> Alterar senha </span> </h3>';
           echo DivUtil::openDivRow();
               echo DivUtil::openDivColMod("col-md-6");
                    echo '<h4> <span class="label label-warning">Email </span> </h4>';
                    echo form_input(array('name' => 'email','value' =>$this->session->email, 'disabled' => 'disabled', 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'exemple@exemple.com'), set_value('email'));
               echo DivUtil::closeDiv();          
           echo DivUtil::closeDivRow();
           echo DivUtil::openDivRow();
               echo DivUtil::openDivColMod("col-md-6");
                       echo '<h4> <span class="label label-info">Senha </span> </h4>';
                       echo form_password(array('name' => 'senha', 'class' => 'form-control'), set_value('senha'));    
                       echo '<h4> <span class="label label-info"> Repita a senha </span> </h4>';
                       echo form_password(array('name' => 'senha2', 'class' => 'form-control'), set_value('senha2'));    
               echo DivUtil::closeDiv();          
           echo DivUtil::closeDivRow();
           echo '<br>';
           echo DivUtil::openDivRow();
                echo '<div class="col-md-6 text-right">';
                    echo BotaoUtil::getBataoSubmit(IconsUtil::getIcone(IconsUtil::ICON_SALVAR) . ' Alterar senha', BotaoUtil::BTN_WARNING);
                echo '</div>';
           echo DivUtil::closeDivRow();
           echo form_close();
        ?>
    </div>
    <!-- fim dados senha -->
    <!-- Usuário admin -->
    <div role="tabpanel" class="tab-pane" id="useradmin">
        <table class="table table-striped">
            <th> Nome </th>
            <th> Permissão </th>
        </table>
    </div>
    <!-- fim do usuário admin -->
    
    <div role="tabpanel" class="tab-pane" id="outros">Outros</div>
  </div>

</div>
