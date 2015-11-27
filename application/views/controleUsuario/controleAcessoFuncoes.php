
<?php
    if($this->session->tipo == 1){
        ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#newdisciplina").hide();
                $("#newcurso").hide();
                $("#newacesso").hide();
                $("#getrelatorio").hide();
                $("#newsemestre").hide();
                $("#newprofessor").hide();
                $("#cadidentificador").hide();
            });
        </script>
       
        <?php
    }
   
 ?>
