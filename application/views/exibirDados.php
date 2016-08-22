<?php
$this->load->view('controleUsuario/gerenciador');
if(isset($headerHorario))
    $this->load->view('telaUteis/headerHorario');
else
    $this->load->view('telaUteis/header');
if($tela!='') $this->load->view($tela);
$this->load->view('controleUsuario/controleAcessoFuncoes');
if(isset($headerHorario))
    $this->load->view('telaUteis/footerHorario');
else
    $this->load->view('telaUteis/footer');
