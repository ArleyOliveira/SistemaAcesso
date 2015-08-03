<?php
if($this->session->userdata('email') != '' || $this->session->userdata('email') != NULL):
    redirect("gerenciador/entrada");
endif;
?>
<html lang="pt-br">
    <head>
        <meta htpp-equiv="Contente-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Sistema de Gestão de Estacionamento</title>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
        <script src="<?php echo base_url('includes/jquery/jquery-2.1.4.min.js') ?>"></script>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url('includes/bootstrap/css/bootstrap.min.css') ?>">
       
        <script src="<?php echo base_url('includes/bootstrap/js/bootstrap.min.js') ?>"></script>


    </head>
    <body>
<?php
echo DivUtil::openDivRow();


echo DivUtil::openDivColMod("col-md-6 col-md-offset-3");
echo "<h2 class=text-center> Sistema de Acesso</h2>";

if ($this->session->flashdata('usuarioinvalido')):
    echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_DANGER);
    echo $this->session->flashdata('usuarioinvalido');
    echo ModMensagemUtil::getCloseAlertMensagem();
endif;
echo PainelUtil::getOpenPainel(IconsUtil::getIcone(IconsUtil::ICON_USER) . ' Login', PainelUtil::PAINEL_INFO);
echo form_open("usuario/login");
echo form_label('Email (*)') . "<br />";
echo form_input(array('name' => 'email', 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'exemple@exemple.com'), set_value('email')) . "<br />";
echo form_label("Senha") . "<br />";
echo form_password(array('name' => 'senha', 'class' => 'form-control'), set_value('senha')) . "<br />";
echo DivUtil::openDivRow();
echo DivUtil::openDivColMod("col-md-3 col-md-offset-3");
echo DivUtil::closeDiv();
echo DivUtil::openDivColMod("col-md-3 col-md-offset-3");
echo BotaoUtil::getBataoSubmit(IconsUtil::getIcone(IconsUtil::ICON_SEND) . ' Entrar ', BotaoUtil::BTN_PRIMARY);
echo DivUtil::closeDiv();
echo DivUtil::closeDiv();
echo form_close();

