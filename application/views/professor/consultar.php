<div class="scroll">
    <ol class="breadcrumb">
      <li>Professor</li>
      <li class="active">Consultar</li>
    </ol>
    <table class="table table-striped">
        <tr>
          <th>SIAPE</th>
          <th>Nome</th>
          <th>Sexo</th>
          <th><i class="material-icons">email</i></th> 
          <th>Editar</th>
          <th>Excluir</th>    
        </tr>

          <?php
            foreach ($professores->result() as $professor) {
                echo '<tr>';
                    echo '<td>';
                        echo $professor->siape;
                    echo '</td>';
                    echo '<td>';
                        echo $professor->nome;
                    echo '</td>';
                    echo '<td>';
                        echo $professor->sexo;
                    echo '</td>';
                    echo '<td>';
                        echo $professor->email;
                    echo '</td>';
                    echo '<td>';
                        echo   '<a href=""> <i class="material-icons">create</i></a>';
                    echo '</td>';
                    echo '<td>';
                        echo   '<a href=""> <i class="material-icons">clear</i> </a>';
                    echo '</td>';
                echo '</tr>';

            }
          ?>
    </table>
</div>

