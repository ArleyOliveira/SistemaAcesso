 <script type="text/javascript">    
    var controller = 'disciplina';
    var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
    function excluir(codigo){        
        $('#carregar').addClass("mdl-spinner is-active");
        $.ajax({
            'url' : base_url + '/' + controller + '/excluir',
            'type' : 'POST', //the way you want to send data to your URL
            'data' : {'codigo' : codigo},
            'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
                
            }
        });
    }
</script>
<ol class="breadcrumb">
  <li>Disciplina</li>
  <li class="active">Consultar</li>
</ol>
<div id="m">
    
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 text-center"><div id="carregar" class="mdl-js-spinner"></div></div>
    <div class="col-md-4"></div>
</div>
<?php
if ($this->session->flashdata('acessoinvalido')):
    echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_WARNING);
    echo $this->session->flashdata('acessoinvalido');
    echo ModMensagemUtil::getCloseAlertMensagem();
endif;

if ($this->session->flashdata('edicaook')):
    echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_SUCCESS);
    echo $this->session->flashdata('edicaook');
    echo ModMensagemUtil::getCloseAlertMensagem();
endif;
if ($this->session->flashdata('excluirok')):
    echo ModMensagemUtil::getAlertMensagemClose(ModMensagemUtil::ALERT_SUCCESS);
    echo $this->session->flashdata('excluirok');
    echo ModMensagemUtil::getCloseAlertMensagem();
endif;
?>
<table class="table table-striped">
    <tr>
        <th> Disciplina </th>
        <th> Curso </th>
        <th> Editar </th>
        <th> Excluir </th>
    </tr>
    <?php
    foreach ($disciplinas->result() as $disciplina) :
        echo '<tr>';
            echo '<td>';
                echo $disciplina->disciplina;
            echo '</td>';
            echo '<td>';
                echo $disciplina->curso;
            echo '</td>';
            echo '<td>';
                echo   '<a href="'.  base_url('disciplina/editar/'.$disciplina->disciplinaCodigo).'"> <i class="material-icons">create</i></a>';;
            echo '</td>';
            echo '<td>';
                echo   '<a href="" onclick="excluir('.$disciplina->disciplinaCodigo.')"> <i class="material-icons">clear</i></a>';
            echo '</td>';
        echo '</tr>';
    endforeach;
    ?>
</table>
