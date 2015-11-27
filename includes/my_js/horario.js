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
       $("#lab").text("Selecione uma opção");
       $("#diaSemana").val("Selecione um dia");
       $("#entrada").val("");
       $("#saida").val("");
    }
});
