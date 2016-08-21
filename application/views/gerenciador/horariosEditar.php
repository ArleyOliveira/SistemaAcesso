<?php 
    if($this->session->tipo != 2)
        redirect("gerenciador/consultar");
    
    if ($this->session->flashdata('excluirok')):
        echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_SUCCESS);
        echo $this->session->flashdata('excluirok');
        echo ModMensagemUtil::getCloseAlertMensagem();
    endif;
 ?>
<script type="text/javascript">    
    var controller = 'gerenciador';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    function excluir(codigo){
        $('#carregar').addClass("mdl-spinner is-active");
        $.ajax({
            'url' : base_url + '/' + controller + '/excluirHorario',
            'type' : 'POST', //the way you want to send data to your URL
            'data' : {'codigo' : codigo},
            'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
                location.reload();
            }
        });
    }
</script>
<!-- Carregar -->
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 text-center"><div id="carregar" class="mdl-js-spinner"></div></div>
    <div class="col-md-4 text-right">
        <a href="<?php echo base_url("gerenciador/consultar"); ?>"> Modo Visualização </a>
    </div>
</div>


<div class="scroll">
    <?php
    for($i = 1; $i <= 4; $i++){ ?>
        <table class="table">
            <legend> Laboratório <?php echo $horarios[$i]['lab']; ?></legend>
            <thead>
            <tr>
                <th> Segunda</th>
                <th> Terça</th>
                <th> Quarta</th>
                <th> Quinda</th>
                <th> Sexta</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                $horarioLab = $horarios[$i]['horariosLab'];
                for($d = 2; $d < 7; $d++){
                $horarioDia = $horarioLab[$d];
                ?>
                <td>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Disciplina</th>
                            <th class="text-center" colspan="2">Horário</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        for($h = 0; $h < sizeof($horarioDia); $h++){
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    if (strlen($horarioDia[$h]['disciplina']) <= 3)
                                        echo $horarioDia[$h]['disciplina'].".";
                                    else
                                        echo substr($horarioDia[$h]['disciplina'], 0, 3);
                                    ?>
                                </td>
                                <td class="text-center"><?php echo $horarioDia[$h]['inicio'] . ' - ' . $horarioDia[$h]['fim'] ?></td>
                                <td class="text-center"> <a onclick="excluir(<?php echo $horarioDia[$h]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                            <?php
                        }
                        if (sizeof($horarioDia) == 0) {
                            ?>
                            <tr>
                                <td colspan="2" class="text-center"><span class="label label-danger">Não há horário agendado!</span>
                                </td>
                            </tr>
                            <?php
                        } ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </td>
            </tr>
            </tbody>
        </table>
    <?php } ?>
</div>
