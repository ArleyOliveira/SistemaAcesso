<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="<?php echo base_url('includes/MDL/material.min.js') ?>"></script> 
        <link rel="stylesheet" href="<?php echo base_url('includes/MDL/material.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('includes/MDL/font.css') ?>">
        <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/icon?family=Material+Icons"> -->

        <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
        <script src="<?php echo base_url('includes/jquery/jquery-2.1.4.min.js') ?>"></script>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url('includes/bootstrap/css/bootstrap.min.css') ?>">

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

        <title> <?php echo $titulo; ?> </title>
        <script src="<?php echo base_url('includes/my_js/script.js') ?>"></script>
    </head>
    <body>
        <!-- The drawer is always open in large screens. The header is always shown,
even in small screens. -->
        <div class="demo-layout">
            <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
                 mdl-layout--fixed-header">
                <header class="mdl-layout__header">
                    <div class="mdl-layout__header-row">
                        <span class="mdl-layout-title">Sistema Gerenciador de Acesso</span>
                        <div class="mdl-layout-spacer"></div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                             mdl-textfield--floating-label mdl-textfield--align-right">
                            <label class="mdl-button mdl-js-button mdl-button--icon"
                                   for="fixed-header-drawer-exp">
                                <i class="material-icons">search</i>
                            </label>
                            <div class="mdl-textfield__expandable-holder">
                                <input class="mdl-textfield__input" type="text" name="sample"
                                       id="fixed-header-drawer-exp" />
                            </div>
                        </div>
                    </div>
                </header>
                <div class="mdl-layout__drawer" style="background-color: #555; color: white">
                    <div style="background-color: #222;" class="text-center" >
                        <div class="demo-drawer lor--blue-grey-900 mdl-color-text--blue-grey-50">
                            <header class="demo-drawer-header">
                                <img src='<?php echo base_url("icons/user.jpg") ?>' class="img-circle">
                                <div class="demo-avatar-dropdown">
                                    <span><?php echo $this->session->email; ?></span>
                                    <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                        <i class="material-icons">arrow_drop_down</i>
                                    </button>
                                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-co" for="accbtn">

                                        <li class="mdl-menu__item"><i class="material-icons middle">email</i> <span class="mdl-badge" data-badge="4">Menssagem</span></li>
                                        <li class="mdl-menu__item"> <i class="material-icons">settings</i> Configurações</li>
                                        <li class="mdl-menu__item"> <a href="<?php echo base_url("usuario/ferramentas"); ?>"><i class="material-icons middle">build</i> Ferramentas </a></li>
                                        <?php  
                                        
                                        if($this->session->tipo == 2):
                                        ?>
                                            <li class="mdl-menu__item"> <a href="<?php echo base_url("usuario/cadastrar"); ?>"><i class="material-icons">add</i>Adicionar usuário</a></li>
                                        <?php
                                        endif;
                                        ?>
                                        <li class="mdl-menu__item"> <a href="<?php echo base_url("usuario/logout"); ?>"><i class="material-icons middle">exit_to_app</i> Sair </a></li>
                                    </ul>
                                </div>
                            </header>
                        </div>
                    </div>
                    <span class="mdl-layout-title"><?php echo IconsUtil::getIcone("glyphicon glyphicon-menu-hamburger") ?> Adminstração </span>
                    <!-- Single button -->

                    <nav class="mdl-navigation">
                        <span class="header_menu" id="curso" style="background-color: #f0ad4e"><span class="glyphicon glyphicon-tasks"></span> Curso <span class="glyphicon glyphicon-chevron-down position_up_down" id="c"></span> </span>
                        <div id="iconC">
                            <a id="newcurso" href="<?php echo base_url("curso/cadastrar"); ?>" class="link_menu"><span class="glyphicon glyphicon-plus-sign"></span> Novo curso </a>
                            
                            <a href="<?php echo base_url("curso/consultar"); ?>" class="link_menu"><span class="glyphicon glyphicon-search"></span> Consultar </a>
                        </div>
                        <span class="header_menu" id="disciplina"><span class="glyphicon glyphicon-tasks"></span> Disciplina <span class="glyphicon glyphicon-chevron-down position_up_down" id="d"></span></span>
                        <div id="iconD">
                            <a id="newdisciplina" href="<?php echo base_url("disciplina/cadastrar"); ?>" class="link_menu"><span class="glyphicon glyphicon-plus-sign"></span> Nova Disciplina </a>
                            <a href="<?php echo base_url("disciplina/consultar"); ?>" class="link_menu"><span class="glyphicon glyphicon-search"></span> Consultar </a>
                        </div>
                        
                        <span class="header_menu" id="professor" style="background-color: #428bca"><span class="glyphicon glyphicon-tasks"></span> Professor <span class="glyphicon glyphicon-chevron-down position_up_down" id="p"></span></span>
                        <div id="iconP">
                            
                            <a id="newprofessor" href="<?php echo base_url("professor/cadastra"); ?>" class="link_menu"><span class="glyphicon glyphicon-plus-sign"></span> Novo professor </a>
                            <a href="<?php echo base_url("professor/consultar"); ?>" class="link_menu"><span class="glyphicon glyphicon-search"></span> Consultar </a>
                            <a id="cadidentificador" href="<?php echo base_url("gerenciador/cadastrarIdentificador"); ?>" class="link_menu"><span class="glyphicon glyphicon-edit"></span> Cadastrar Identificador </a>
                            
                            
                        </div>
                        
                        <span class="header_menu" id="acesso" style="background-color: #d9534f"><span class="glyphicon glyphicon-tasks"></span> Acesso <span class="glyphicon glyphicon-chevron-down position_up_down" id="a"></span></span>
                        <div id="iconA">
                            <a id="newacesso" href="<?php echo base_url("gerenciador/cadastrar"); ?>" class="link_menu"><span class="glyphicon glyphicon-user"></span> Novo acesso </a>
                            <a href="<?php echo base_url("gerenciador/consultar"); ?>" class="link_menu"><span class="glyphicon glyphicon-list-alt"></span> Horários </a>
                            <a id="newsemestre" href="<?php echo base_url("semestre/cadastrar"); ?>" class="link_menu"><span class="glyphicon glyphicon-plus-sign"></span> Novo semestre </a>
                            <a id="getrelatorio" href="<?php echo base_url("gerenciador/relatorio"); ?>" class="link_menu"><span class="glyphicon glyphicon-file"></span> Obter relatório </a>
                        </div>
                    </nav>
                </div>
                <main class="mdl-layout__content" style="background-color: #eee">
                    <div class="demo-grid-1 mdl-grid">
                        <div class="mdl-cell mdl-cell--2-col"></div>
                        <div class="mdl-cell mdl-cell--8-col">

