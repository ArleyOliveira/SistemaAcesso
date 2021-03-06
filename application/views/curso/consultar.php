 <script type="text/javascript">
    var controller = 'curso';
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
  <li>Curso</li>
  <li class="active">Consultar</li>
</ol>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 text-center"><div id="carregar" class="mdl-js-spinner"></div></div>
    <div class="col-md-4"></div>
</div>
<?php

if ($this->session->flashdata('cadastrook')):
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
      <th>Curso</th>
      <th>Área do conhecimento</th>
      <th>Editar</th>
      <th>Excluir</th>
    </tr>
      <?php
        foreach ($cursos->result() as $curso) {
            echo '<tr>';
                echo '<td>';
                    echo $curso->nome;
                echo '</td>';
                echo '<td>';
                    echo $curso->area;
                echo '</td>';
                echo '<td>';
                    echo   '<a href="'.  base_url('curso/editar/'.$curso->codigo).'"> <i class="material-icons">create</i></a>';
                echo '</td>';
                echo '<td>';
                    echo   '<a href="" onclick="excluir('.$curso->codigo.')"> <i class="material-icons">clear</i></a>';
                echo '</td>';
            echo '</tr>';
            
        }
      ?>
</table>


