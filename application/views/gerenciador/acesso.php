
<script type="text/javascript">
    $(document).ready(function(){
        horarios = [];
        $("#addHorario").click(function(){
            controle = 0;
            erro = 0;
            disciplina = 0;
            professor = 0;
            if(controle == 0){
                 disciplina =  $("#dis").val();
                 professor =  $("#prof").val();

                if(disciplina == 0 || disciplina == null){
                    erro = erro + 1;
                    $("#disciplinaGroup").addClass("form-group has-error");
                }
                
                if(professor == 0 || professor == null){
                    erro = erro + 1;
                    $("#professorGroup").addClass("form-group has-error");
                }
  
            }
            diaSemana =  $("#diaSemana").val();
            lab = $("#lab").val();
            entrada = $("#entrada").val();
            saida = $("#saida").val();

            if(diaSemana == 0 || diaSemana == null){
                erro = erro + 1;
                $("#diaSemanaGroup").addClass("form-group has-error");
            }
            if(lab == 0 || lab == null){
                erro = erro + 1;
                $("#labGroup").addClass("form-group has-error");
            }

            if(entrada == "" || entrada == null){
                erro++;
                $("#inicioGroup").addClass("form-group has-error");
            }

            if(saida == "" || saida == null){
                erro++;
                $("#saidaGroup").addClass("form-group has-error");
            }
            if(erro == 0 && dateCompare(entrada, saida) != -1){
                alert("Horário de entrada inferior ou igual ao horário de saída.");
                erro++;
            }
            if(erro != 0){
                var menssage = '<strong> Atenção ! </Strong> Os campos com (*) precisam ser preenchidos.';
                exibirMensagemErro(menssage, 'warning');
            }
            cont = 0;
            texto = "";
            if(erro == 0){
                controle++;
                acesso = [diaSemana, lab, entrada, saida, disciplina, professor];
                horarios[horarios.length] = acesso;
                diasSemana = ["Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sabádo"];
                t = "<table class=table table-striped> <tr> <th> Dia da semana </th> <th> Laboratório </th> <th> Inicio </th> <th> Fim </th> </tr> ";
                for(i=0; i < horarios.length; i++){
                    dia = horarios[i][0] - 2;
                    t = t + "<tr><td>" +diasSemana[dia]+ " </td> <td> Laboratório "+ horarios[i][1]+" </td> <td> "+ horarios[i][2]+" </td> <td> "+ horarios[i][3]+" </td> </tr>";
                }
                t = t + "</table>";
                $("#tabela").html(t);
                limparcampos();
                desabilitarCampos();
            }
        });
        
        $("#disciplinaGroup").click(function(){
            $("#disciplinaGroup").removeClass("form-group has-error");
        });
        
        $("#professorGroup").click(function(){
            $("#professorGroup").removeClass("form-group has-error");
        });
        
        $("#diaSemana").click(function(){
            $("#diaSemanaGroup").removeClass("form-group has-error");
        });
        
        $("#diaSemana").click(function(){
            $("#diaSemanaGroup").removeClass("form-group has-error");
        });

        $("#lab").click(function(){
            $("#labGroup").removeClass("form-group has-error");
        });

        $("#entrada").click(function(){
            $("#inicioGroup").removeClass("form-group has-error");
        });

        $("#saida").click(function(){
            $("#saidaGroup").removeClass("form-group has-error");
        });
        function desabilitarCampos(){
            $("#dis").attr("disabled", true);
            $("#prof").attr("disabled", true);
        }
        
        function limparcampos(){
           $("#lab").val("Selecione uma opção");
           $("#diaSemana").val("Selecione um dia");
           $("#entrada").val("");
           $("#saida").val("");
        }

        var controller = 'gerenciador';
        var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';

        $("#enviar").click(function(){
            if(horarios.length > 0){
                $('#carregar').addClass("mdl-spinner is-active");
                var dados = JSON.stringify(horarios);

                $.ajax({
                    'url' : base_url + '/' + controller + '/cadastrar',
                    'type' : 'POST', //the way you want to send data to your URL
                    'data' : {'dados' : dados},
                    'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
                       
                        location.reload();
                        //document.write('<html>' + dados + '</html>');
                    }
                });
            }else{   
                var menssage = '<strong> Erro! </Strong> Nenhum horário foi cadastrado.';
                exibirMensagemErro(menssage, 'danger');
            }
       });
       function exibirMensagemErro(mensagem, type){
            var msg = '<div class="alert alert-'+type+' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+ mensagem + ' </div>';
            $("#menssage").html(msg);
       }
       function dateCompare(time1,time2) {
            var t1 = new Date();
            var parts = time1.split(":");
            t1.setHours(parts[0],parts[1],0,0);
            var t2 = new Date();
            parts = time2.split(":");
            t2.setHours(parts[0],parts[1],0,0);

            // returns 1 if greater, -1 if less and 0 if the same
            if (t1.getTime() > t2.getTime()) return 1;
            if (t1.getTime() < t2.getTime()) return -1;
            return 0;
       }
       
    });
</script>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 text-center"><div id="carregar" class="mdl-js-spinner"></div></div>
    <div class="col-md-4"></div>
</div>
 
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
echo DivUtil::openDivRow();
    echo DivUtil::openDivColMod("col-md-12");
        echo '<div id="menssage">';
        echo '</div>';
    echo DivUtil::closeDiv();
echo DivUtil::closeDivRow();
echo PainelUtil::getOpenPainel(IconsUtil::getIcone(IconsUtil::ICON_PLUS_SING) . ' Novo acesso', PainelUtil::PAINEL_DEFAULT);  
    echo DivUtil::openDivRow();
        echo '<div id="disciplinaGroup" class="col-md-12">';
            echo '<h4> <span class="label label-default"> Disciplina * </span> </h4>';
            echo '<select class="form-control" id="dis" name="disciplina">
                <option value="0" selected="selected">Selecione uma disciplina</option>';
            foreach ($disciplinas->result() as $disciplina) :
                echo '<option value="'.$disciplina->disciplinaCodigo.'"> '.$disciplina->disciplina .' - '. $disciplina->curso . '</option>';
            endforeach;
            echo '</select>';
        echo '</div>';
    echo DivUtil::closeDivRow();
    
    echo DivUtil::openDivRow();
        echo '<div id="professorGroup" class="col-md-8">';
            echo '<h4> <span class="label label-default"> Professor *</span> </h4>';
            echo '<select class="form-control" id="prof" name="professor">
                <option value="0" selected="selected">Selecione um professor(a)</option>';
            foreach ($professores->result() as $professor) :
                echo '<option value="'.$professor->codigo.'"> '.$professor->nome. '</option>';
            endforeach;
            echo '</select>';
        echo '</div>';
    echo DivUtil::closeDivRow();
    echo DivUtil::openDivRow() ;
    echo '<hr>';
        echo DivUtil::openDivColMod("col-md-4");
?>
            <div class="form-group" id="diaSemanaGroup">
                <h4> <span class="label label-default"> Dia da semana </span> </h4>
                <select class="form-control" id="diaSemana" name="diaSemana">
                  <option value="0" selected="selected">Selecione um dia</option>
                  <option value="2">Segunda</option>
                  <option value="3">Terça</option>
                  <option value="4">Quarta</option>
                  <option value="5">Quinta</option>
                  <option value="6">Sexta</option>
                  <option value="7">Sabádo</option>
                </select>
            </div>
<?php
        echo DivUtil::closeDivRow();
        echo DivUtil::openDivColMod("col-md-4");
?>
            <div class="form-group" id="labGroup">
                <h4> <span class="label label-default"> Laboratório </span> </h4>
                <select class="form-control" id="lab" name="lab">
                  <option selected="selected" value="0">Selecione uma opção</option>
                  <option value="1">Lab 1</option>
                  <option value="2">Lab 2</option>
                  <option value="3">Lab 3</option>
                  <option value="4">Lab 4</option>
                </select>
            </div>
<?php
        echo DivUtil::closeDivRow();
    echo DivUtil::closeDivRow();
    echo DivUtil::openDivRow();
        echo DivUtil::openDivColMod("col-md-4");
            echo '<div id="inicioGroup">';
                echo '<h4> <span class="label label-success"> Inicio </span> </h4>';
                echo form_input(array('id' => 'entrada', 'name' => 'entrada', 'class' => 'form-control',  'type' => 'time'));
            echo '</div>';
        echo DivUtil::closeDivRow();
    
        echo DivUtil::openDivColMod("col-md-4");
            echo '<div id="saidaGroup">';
                echo '<h4> <span class="label label-danger"> Fim </span> </h4>';
                echo form_input(array('id' => 'saida', 'name' => 'saida', 'class' => 'form-control', 'type' => 'time'));
            echo '</div>';
        echo DivUtil::closeDivRow();
        
        echo DivUtil::openDivColMod("col-md-3 text-right");  
?>
</br> 
        <button id ="addHorario" class="mdl-button mdl-js-button mdl-button--fab mdl-button--primary">
            <i class="material-icons">add</i>
        </button>
<?php
        echo DivUtil::closeDivRow();
    echo DivUtil::closeDivRow();
    echo DivUtil::openDivRow();
        echo DivUtil::openDivColMod("col-md-12") . "<br>";
            echo '<div id="tabela">';
            echo '</div>';
        echo DivUtil::closeDivRow();
    echo '<hr>';
    echo DivUtil::closeDivRow();
    echo DivUtil::openDivRow() . "<br><br>";
    
        echo DivUtil::openDivColMod("col-md-2");
        
        echo DivUtil::closeDivRow();
        echo DivUtil::openDivColMod("col-md-8");
          echo '<div class="text-right">';
                echo '<button type="button"  id="enviar" class="btn btn-success btn-block">'. IconsUtil::getIcone(IconsUtil::ICON_SALVAR).' Salvar</button>';
          echo '</div>';  
        echo DivUtil::closeDivRow();
        echo DivUtil::openDivColMod("col-md-2");
        echo DivUtil::closeDivRow();
    echo DivUtil::closeDivRow();
echo PainelUtil::getClosePainel();