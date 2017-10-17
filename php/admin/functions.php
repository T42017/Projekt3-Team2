<?php

function GetPermaLink($skip = 0)
{
	$path = ltrim($_SERVER['REQUEST_URI'], '/');
	$elements = explode('/', $path);
	
	if(empty($elements[0]))
	{
		return null;
	}
	else
	{
		for($i=0; $i< $skip;$i++)
			array_shift($elements);
		
		$req = array_shift($elements);
		return strtolower($req);
	}
}

?>