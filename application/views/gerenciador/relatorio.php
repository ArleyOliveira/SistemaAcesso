<?php
echo PainelUtil::getOpenPainel("<i class='material-icons'>insert_drive_file</i> 
Consulta dos Acessos nos Laborátorios", PainelUtil::PAINEL_DEFAULT);
?>

<table class="table table-striped">
    <tr>
        <th><?php echo IconsUtil::getIcone("glyphicon glyphicon-user") ?>  Professor</th>
        <th><?php echo IconsUtil::getIcone("glyphicon glyphicon-send") ?> Laborátorio</th>
        <th> <?php echo IconsUtil::getIcone("glyphicon glyphicon-calendar") ?> Data</th>
        <th> <?php echo IconsUtil::getIcone("glyphicon glyphicon-log-in") ?> Entrada</th>
        <th> <?php echo IconsUtil::getIcone("glyphicon glyphicon-log-out") ?> Saída</th>    
    </tr>

    <?php
    foreach ($acessos->result() as $acesso) {
        echo '<tr>';
            echo '<td>';
                echo $acesso->professor;
            echo '</td>';
            echo '<td>';
                echo "Lab " . $acesso->laboratorio;
            echo '</td>';
            echo '<td>';
                echo $acesso->data;
            echo '</td>';
            echo '<td>';
                echo $acesso->entrada;
            echo '</td>';
            echo '<td>';
                echo $acesso->saida;
            echo '</td>';
        echo '</tr>';
    }
    ?>
</table>
<?php 
    echo PainelUtil::getClosePainel();
    