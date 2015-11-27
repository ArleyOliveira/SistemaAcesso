
<script type="text/javascript">
    $(document).ready(function(){
        horarios = [];
        $("#addHorario").click(function(){

            diaSemana =  $("#diaSemana").val();
            lab = $("#lab").val();
            entrada = $("#entrada").val();
            saida = $("#saida").val();

            erro = 0;
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
            cont = 0;
            texto = "";
            if(erro == 0){
                acesso = [diaSemana, lab, entrada, saida];
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
            }
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

        function limparcampos(){
           $("#lab").val("Selecione uma opção");
           $("#diaSemana").val("Selecione um dia");
           $("#entrada").val("");
           $("#saida").val("");
        }

        var controller = 'gerenciador';
        var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
        var codigo  = 5;
        var disciplina = $("#disciplina").val();
        var professor = $("#professor").val();
        
        $("#enviar").click(function(){
            cont = 0;
            for(i=0; i < horarios.length; i++){
                //$('#carregar').addClass("mdl-spinner is-active");
                dia = horarios[i][0];
                lab = horarios[i][1];
                inicio = horarios[i][2];
                fim = horarios[i][3];
                 cont++;
                $.ajax({
                    'url' : base_url + '/' + controller + '/enviar',
                    'type' : 'POST', //the way you want to send data to your URL
                    'data' : {'codigo' : codigo},
                    'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
                        cont++;
                    }
                  
                });
                if(horarios.length-1 == i){
                    location.reload();
                    alert(cont);
                }
            }
            
       });
    });
</script>
 
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

echo PainelUtil::getOpenPainel(IconsUtil::getIcone(IconsUtil::ICON_PLUS_SING) . ' Novo acesso', PainelUtil::PAINEL_DEFAULT);
    echo DivUtil::openDivRow();
        echo DivUtil::openDivColMod("col-md-12");
            echo '<h4> <span class="label label-default"> Disciplina * </span> </h4>';
            echo '<select class="form-control" id="disciplina">
                <option value="0" selected="selected">Selecione uma disciplina</option>';
            foreach ($disciplinas->result() as $disciplina) :
                echo '<option value="'.$disciplina->disciplinaCodigo.'"> '.$disciplina->disciplina .' - '. $disciplina->curso . '</option>';
            endforeach;
            echo '</select>';
        echo DivUtil::closeDiv();
    echo DivUtil::closeDivRow();
    
    echo DivUtil::openDivRow();
        echo DivUtil::openDivColMod("col-md-8");
            echo '<h4> <span class="label label-default"> Professor *</span> </h4>';
            echo '<select class="form-control" id="professor">
                <option value="0" selected="selected">Selecione um professor(a)</option>';
            foreach ($professores->result() as $professor) :
                echo '<option value="'.$professor->codigo.'"> '.$professor->nome. '</option>';
            endforeach;
            echo '</select>';
        echo DivUtil::closeDiv();
    echo DivUtil::closeDivRow();
    echo DivUtil::openDivRow() ;
    echo '<hr>';
        echo DivUtil::openDivColMod("col-md-4");
?>
            <div class="form-group" id="diaSemanaGroup">
                <h4> <span class="label label-default"> Dia da semana </span> </h4>
                <select class="form-control" id="diaSemana" name="diaSemana">
                  <option value="0" selected="selected">Selecione uma dia</option>
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
    echo DivUtil::closeDivRow();
    echo DivUtil::openDivRow() . "<br><br>";
        echo DivUtil::openDivColMod("col-md-12");
            echo '<button type="button"  id="enviar" class="btn btn-success">Salvar</button>';
        echo DivUtil::closeDivRow();
    echo DivUtil::closeDivRow();
echo PainelUtil::getClosePainel();