<?php
	
	class PainelUtil{
		const PAINEL_DEFAULT = "panel-default";
		const PAINEL_PRIMARY = "panel-primary";
		const PAINEL_SUCESSO = "panel-success";
		const PAINEL_INFO = "panel-info";
		const PAINEL_WARNING = "panel-warning";
		const PAINEL_DANGER = "panel-danger";
		
		public static function getOpenPainel($titulo, $classe)
		{
			$div = '
				<div class="panel '. $classe .'">
				  <div class="panel-heading">' . $titulo .'</div>
				  <div class="panel-body">
			';
			return $div;
		}
		
		public static function getClosePainel()
		{
			return '</div>';
		}
	} 
