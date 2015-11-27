<script type="text/javascript">
   $(document).ready(function(){
        var controller = 'gerenciador';
        var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
        
        $("#prof").change(function () {
            codigo = $("#prof").val();
            $.ajax({ 
                'url' : base_url + '/' + controller + '/consultaIdentificador',
                'type' : 'POST', //the way you want to send data to your URL
                'data' : {'codigo' : codigo},
                'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
                    if(data != null && data != ''){
                        $("#identificador").val(data);
                        alterarBotton(2);
                    }else{
                       //alert("Identififasdado não cadastrado!");
                       $("#identificador").val("");
                       alterarBotton(1);
                    }
                }
            });
        });

        function alterarBotton(tipo){
            if(tipo == 1){
                $("#botao").html('<span class="glyphicon glyphicon-send" aria-hidden="true"></span> Cadastrar');
                $("#botao").removeClass("btn-warning");
                $("#botao").addClass("btn-primary");
            }else{
                $("#botao").html('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar');
                $("#botao").removeClass("btn-primary");
                $("#botao").addClass("btn-warning");
                $("#identificador").attr('readonly', true);  
            }         
        }

        $("#identificador").dblclick(function(){
            $("#identificador").removeAttr('readonly');
        });
    });
</script>
 
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

echo PainelUtil::getOpenPainel(IconsUtil::getIcone(IconsUtil::ICON_PLUS_SING) . ' Cadastro de Identificador', PainelUtil::PAINEL_DEFAULT);  
    
    echo form_open("gerenciador/cadastrarIdentificador");
        echo DivUtil::openDivRow();
            echo DivUtil::openDivColMod("col-md-8");
                echo '<h4> <span class="label label-default"> Professor *</span> </h4>';
                echo '<select class="form-control" id="prof" name="professor">
                    <option value="" selected="selected">Selecione um professor(a)</option>';
                foreach ($professores as $professor) :
                    echo '<option value="'.$professor->codigo.'">'.$professor->nome. '</option>';
                endforeach;
                echo '</select>';
            echo DivUtil::closeDiv();
        echo DivUtil::closeDivRow();
        echo DivUtil::openDivRow();
            echo DivUtil::openDivColMod("col-md-8");
                echo '<h4> <span class="label label-default"> Identificador * </span> </h4>';
                echo form_input(array('id' => 'identificador', 'name' => 'identificador','class' => 'form-control', 'placeholder' => 'identificador'), set_value('identificador')).'<br>';
            echo DivUtil::closeDiv();
            echo DivUtil::openDivColMod("col-md-2");
                ?>
                    
                <?php
            echo DivUtil::closeDiv();
        echo DivUtil::closeDivRow();
        echo DivUtil::openDivRow();
                echo DivUtil::openDivColMod("col-md-8");
                    echo '<div class="text-right">';
                   ?>
                        <button type="submit" id="botao" class="btn btn-primary" > <?php echo IconsUtil::getIcone(IconsUtil::ICON_SEND); ?> Cadastrar</button>
                   <?php
                    //echo BotaoUtil::getBataoSubmit(IconsUtil::getIcone(IconsUtil::ICON_SEND) . ' Cadastrar', BotaoUtil::BTN_PRIMARY);
                    echo '</div>';
            echo DivUtil::closeDiv();
        echo DivUtil::closeDivRow();
    echo form_close();
    
echo PainelUtil::getClosePainel();
