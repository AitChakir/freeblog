<?php
	function view($view, $data = [])
	{
		extract($data);
		ob_start();
		require_once __DIR__."/../app/view/$view.tpl.php"; 
		$data = ob_get_contents();
		ob_end_clean();
		return $data;
	}

	function redirect($url= '/')
	{
		header('Location:'.$url);
		exit;
	}