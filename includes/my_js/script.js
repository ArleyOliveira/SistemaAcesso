
$(document).ready(function () {
    var controleC = -1;
    $("#curso").click(function () {
        $("#iconC").slideToggle(500);
        if (controleC == 0) {
            $("#c").removeClass("glyphicon-chevron-up");
            $("#c").addClass("glyphicon-chevron-down");
            controleC = 1;
        } else {
            $("#c").removeClass("glyphicon-chevron-down");
            $("#c").addClass("glyphicon-chevron-up");
            controleC = 0;
        }
    });

    var controleD = -1;
    $("#disciplina").click(function () {
	$("#iconD").slideToggle(500);
	if (controleD == 0) {
	    $("#d").removeClass("glyphicon-chevron-up");
	    $("#d").addClass("glyphicon-chevron-down");
	    controleD = 1;
	} else {
	    $("#d").removeClass("glyphicon-chevron-down");
	    $("#d").addClass("glyphicon-chevron-up");
	    controleD = 0;
	}
    });

    var controleP = -1;
    $("#professor").click(function () {
	$("#iconP").slideToggle(500);
	if (controleP == 0) {
	    $("#p").removeClass("glyphicon-chevron-up");
	    $("#p").addClass("glyphicon-chevron-down");
	    controleP = 1;
	} else {
	    $("#p").removeClass("glyphicon-chevron-down");
	    $("#p").addClass("glyphicon-chevron-up");
	    controleP = 0;
	}
    });

   var controleA = -1;
    $("#acesso").click(function () {
	$("#iconA").slideToggle(500);
	if (controleA == 0) {
	    $("#a").removeClass("glyphicon-chevron-up");
	    $("#a").addClass("glyphicon-chevron-down");
	    controleA = 1;
	} else {
	    $("#a").removeClass("glyphicon-chevron-down");
	    $("#a").addClass("glyphicon-chevron-up");
	    controleA = 0;
	}
    });

	$('.datepicker').datepicker({
		language: 'pt-BR',
		format: "dd/mm/yyyy"
	});

	$('.has_tooltip').tooltip();
	$(".select2").select2();

	$(document).ready(function(){
		$(".excluir").click(function(event) {
			var apagar = confirm('Deseja realmente excluir este registro?');
			if (apagar){
				$codigo = $(this).parent().find('.idElement').val();
				$('#carregar').addClass("mdl-spinner is-active");
				excluir($codigo);
			}else{
				event.preventDefault();
			}
		});
	});

});

