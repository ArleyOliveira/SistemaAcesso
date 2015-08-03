
<?php
if($this->session->userdata('email') != '' || $this->session->userdata('email') != NULL):
    redirect("inicio/home");
endif;
$erroAlert = '';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta htpp-equiv="Contente-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Sistema de Acesso - Login</title>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
        <script src="<?php echo base_url('includes/jquery/jquery-2.1.4.min.js') ?>"></script>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url('includes/bootstrap/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('includes/bootstrap/css/signin.css') ?>">

        <!-- My css -->
        <link rel="stylesheet" href="<?php echo base_url('includes/my_css/style.css') ?>">

        <script src="<?php echo base_url('includes/my_js/jquery.maskedinput.js') ?>"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo base_url('includes/bootstrap/js/bootstrap.min.js') ?>"></script>

        <link rel="stylesheet" href="<?php echo base_url('includes/jquery1/jquery-ui.css') ?>">

        <script src="<?php echo base_url('includes/jquery1/jquery-ui.js') ?>"></script>

        <script src="<?php echo base_url('includes/jquery1/external/jquery/jquery.js') ?>"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        -->
        <style type="text/css">
            #banner{
                background-color: #d9534f;
                color: white;
                height: 50px;
                border-radius: 5px;
                font-weight: bold;
                padding-top: 0px;
                margin: 0px;
                
            }
            img{
                width: 32px;
                height: 32px;
            }
        </style>
    </head>

    <body>
        <!--<div class="col-md-12>
            <div class="text-center" id="banner">
                <h2> Bem vindo ao Sistema de Acesso </h2>   
            </div>
        </div>"-->
        <div class="container">
            <div class="row">
             <div class="col-md-6 col-md-offset-3">
                   <!--<h4><label class="label label-warning"> IFNMG - CAMPUS JANUÁRIA </label></h4>-->
                    <?php
                        if ($this->session->flashdata('usuarioinvalido')):
                            echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_DANGER);
                            echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)  . ' ' . $this->session->flashdata('usuarioinvalido');
                            echo ModMensagemUtil::getCloseAlertMensagem();
                            echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_WARNING);
                            echo IconsUtil::getIcone(IconsUtil::ICON_ALERT)  . ' Verifique se o tipo de acesso correponde ao seu perfil de usuário.';
                            echo ModMensagemUtil::getCloseAlertMensagem();
                            $erroAlert = 'form-group has-warning has-feedback';
                        endif;
                     ?>
             </div>
            </div>
            <form class="form-signin" method="POST" action="<?php echo base_url('usuario/login') ?>">
                
                <h3 class="form-signin-heading"><label class="label label-primary"> <img src="<?php echo base_url('icons/userM.png'); ?>">Informe seus dados de login</label></h3>
                <label for="inputEmail" class="sr-only">Email address</label>
                <?php echo form_input(array('id' => 'inputEmail', 'type' => 'email', 'name' => 'email', 'class' => 'form-control', 'placeholder' => 'exemple@exemple.com', 'required'=>'', 'autofocus'=>''), set_value('email'));?>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" name="senha" placeholder="Senha" required>
                <div class="<?php echo $erroAlert ?>">
                    <h4><label class="label label-danger"> Tipo de acesso </label></h4>
                    <select name="tipo" class="form-control">
                        <option value="1">Professor</option>
                        <option value="2">Adminstrador</option>
                    </select>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Lembra minha senha
                    </label>
                </div>
                <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
            </form>

            <div class="row" style="float: bottom">
                <div class="col-md-6 col-md-offset-3">
                    <footer class="text-center"> 
                        <small> Sistema de Acesso by </small>
                        <mark> Equipe TADS - JANUÁRIA</mark> 
                    </footer>
                </div>
            </div>
        </div>   
    </body>
</html>
