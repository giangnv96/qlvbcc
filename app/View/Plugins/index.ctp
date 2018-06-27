<?php
	global $tmpVariable;
	if(count($tmpVariable)>0)
	{
		foreach($tmpVariable as $key=>$value)
		{
			$$key= $value;
		}
	}
	
	if($urlFilePlugin)
	{
		if($routesType=='Plugin'){
			if(file_exists($urlLocal['urlLocalPlugin'].$urlFilePlugin)){
				include($urlLocal['urlLocalPlugin'].$urlFilePlugin);
			}
		}elseif($routesType=='Theme'){
			if(file_exists($urlLocal['urlLocalTheme'].$urlFilePlugin)){
				include($urlLocal['urlLocalTheme'].$urlFilePlugin);
			}
		}

	}
?>