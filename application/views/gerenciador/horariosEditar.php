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
    <table class="table">
        <legend> Laboratório 01 </legend>
        <tr>
            <th> Segunda </th>
            <th> Terça </th>
            <th> Quarta </th>
            <th> Quinda </th>
            <th> Sexta </th>
        </tr>
        <tr>
            <td>
                <table class="table table-bordered"> <!-- segunda -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th> 
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab1['segunda'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- terça -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab1['terca'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- quarta -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab1['quarta'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- quinta -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab1['quinta'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- sexta -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab1['sexta'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>
        </tr>
    </table>

    <!-- Laborátorio 02 -->
    <table class="table">
        <legend> Laboratório 02 </legend>
        <tr>
            <th> Segunda </th>
            <th> Terça </th>
            <th> Quarta </th>
            <th> Quinda </th>
            <th> Sexta </th>
        </tr>
        <tr>
            <td>
                <table class="table table-bordered"> <!-- segunda -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab2['segunda'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- terça -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab2['terca'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- quarta -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab2['quarta'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- quinta -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab2['quinta'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- sexta -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th> 
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab2['sexta'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>
        </tr>
    </table>

    <!-- Laboratorio 03 -->
    <table class="table">
        <legend> Laboratório 03 </legend>
        <tr>
            <th> Segunda </th>
            <th> Terça </th>
            <th> Quarta </th>
            <th> Quinda </th>
            <th> Sexta </th>
        </tr>
        <tr>
            <td>
                <table class="table table-bordered"> <!-- segunda -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab3['segunda'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- terça -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab3['terca'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- quarta -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th> 
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab3['quarta'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- quinta -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>   
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab3['quinta'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- sexta -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>  
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab3['sexta'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>
        </tr>
    </table>

    <!-- Laboratorio 04 -->
    <table class="table">
        <legend> Laboratório 04 </legend>
        <tr>
            <th> Segunda </th>
            <th> Terça </th>
            <th> Quarta </th>
            <th> Quinda </th>
            <th> Sexta </th>
        </tr>
        <tr>
            <td>
                <table class="table table-bordered"> <!-- segunda -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab4['segunda'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- terça -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab4['terca'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- quarta -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab4['quarta'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- quinta -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab4['quinta'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>

            <td>
                <table class="table table-bordered"> <!-- sexta -->
                    <tr> 
                        <th>Disciplina</th>
                        <th class="text-center">Horário</th>  
                        <th></th>
                    </tr>
                    <?php
                        $horario = $lab4['sexta'];
                        for($i=0; $i < sizeof($horario); $i++){
                    ?>
                            <tr>
                                <td><?php echo $horario[$i]['disciplina'][0].$horario[$i]['disciplina'][1].$horario[$i]['disciplina'][2].$horario[$i]['disciplina'][3] ?></td>
                                <td class="text-center"><?php echo $horario[$i]['inicio']. ' - ' . $horario[$i]['fim'] ?></td>
                                <td class="text-center" > <a onclick="excluir(<?php echo $horario[$i]['codigo'];?>)"><?php echo IconsUtil::getIcone(IconsUtil::ICON_REMOVE)?></a></td>
                            </tr>
                    <?php
                        }
                        if(sizeof($horario) == 0){
                    ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="label label-danger">Não há horário agendado!</span></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>
            </td>
        </tr>
    </table>
</div>

