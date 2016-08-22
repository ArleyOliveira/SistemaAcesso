<?php
if ($this->session->flashdata('acessoinvalido')):
    echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_WARNING);
    echo $this->session->flashdata('acessoinvalido');
    echo ModMensagemUtil::getCloseAlertMensagem();
endif;
if ($this->session->tipo == 2) {
    ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 text-center">
            <div id="carregar" class="mdl-js-spinner"></div>
        </div>
        <div class="col-md-4 text-right">
            <a href="<?php echo base_url("gerenciador/editar"); ?>"> Modo Edição </a>
        </div>
    </div>
    <?php
}
?>
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
                <th> Quinta</th>
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
                                    <th class="text-center">Horário</th>
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