<?php

/*
 * HIX PHP OBFUSCATOR
 *
 * Created on: Set/2009
 *
 * Copyright (c) 2010 - Henrique Ribeiro <contato@brasilapp.com.br>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
*/


// Receiving variables post method

	$codigo = $_POST["entrada"];
	if($codigo == "")
	{
		header('Location: index.php');
	}

        $nivel = $_POST["nivel"];


// Variable initialization

	$j = 0;


// Variables with the tags start and end of PHP Script

	$tagInicio = " ?><?php\n";
	$tagFim    = "?><?php ";


// Generation of the Base64 source code + Tags

	$codigoOfuscado = base64_encode($tagInicio.$codigo.$tagFim);


// Breaking the Code

	$maxCodigo = strlen($codigoOfuscado);

	if(($maxCodigo % 6) != 0)
	{
		while((strlen($codigoOfuscado) % 6) != 0)
		{
			$codigoOfuscado = $codigoOfuscado." ";
			$j++;
		}
	}

	$div = strlen($codigoOfuscado)/6;

	$a = substr($codigoOfuscado, 0, $div);
	$b = substr($codigoOfuscado, $div, $div);
	$c = substr($codigoOfuscado, $div*2, $div);
	$d = substr($codigoOfuscado, $div*3, $div);
	$e = substr($codigoOfuscado, $div*4, $div);
	$f = substr($codigoOfuscado, $div*5, $div);
	$f = str_replace(" ", "",$f);


// Printing Code


	$func1 = geraString($nivel);
	$func2 = geraString($nivel);
	$func3 = geraString($nivel);

	$param1 = geraString($nivel);
	$param2 = geraString($nivel);
	$param3 = geraString($nivel);

	$var1 = geraString($nivel);
	$var2 = geraString($nivel);
	$var3 = geraString($nivel);
	$var4 = geraString($nivel);
	$var5 = geraString($nivel);
	$var6 = geraString($nivel);


	$codigoBase = base64_encode("function $func1(\$$param1){return eval(\$$param1);};function $func2(\$$param2){return base64_decode(\$$param2);};function $func3(\$$param3){return \$$param3;};");
	$codigoResultante1 = "eval(base64_decode('".$codigoBase."'));";
	$codigoResultante2 = "$func1(\"\\\$$var1=\\\"$a\\\";\\\$$var2=\\\$$var1.\\\"$b\\\";\\\$$var3=\\\$$var2.\\\"$c\\\";\\\$$var4=\\\$$var3.\\\"$d\\\";\\\$$var5=\\\$$var4.\\\"$e\\\";\\\$$var6=\\\$$var5.\\\"$f\\\"; $func1($func3($func2(\\\$$var6))); \");";

	$tagInicioCodificado = "<?php\n";
	$tagFimCodificado    = "\n?>";

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>
	<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
	<title>Hix PHP Obfuscator</title>
</head>

<body>

	<div style="text-align: center;"><big style="font-weight: bold;">Ofuscador de C&oacute;digos-Fonte PHP - v2.1</big>
		<br>
		<br>
		<br>

		<b>Result</b>
		<br>
		<b>Warning! Before using the obfuscated source code, put the PHP tags.</b>
		<br>
		<br>
		<textarea cols="100" rows="20" name="saida"><?php echo $codigoResultante1; echo $codigoResultante2; ?></textarea>
		<br>
		<br>
		The purpose of this project is purely academic. So I'm not responsible for the results generated.
		<br>
		There is no guarantee that the code will be 100% compatible.
		<br>
		<br>
		<a href="index.php">Obfuscate another source code</a>
		<br>
		<br>
		<br>
		<span style="font-weight: bold;">Henrique Fernandes Ribeiro</span><br style="font-weight: bold;">
		<span style="font-weight: bold;">henrique (dot) hit (at) gmail (dot) com</span>
		<br>
		Universidade Cat&oacute;lica de Bras&iacute;lia
		<br>
		P&oacute;s-Gradua&ccedil;&atilde;o em Desenvolvimento de	Software Livre
		<br>
		<br>
	</div>

</body>


<?php

        function geraString($len){


		$charsInit = 'abcdefghijlmnopqrstuvxz';
		$maxInit = strlen($charsInit) - 1;

                $chars = 'abcdefghijlmnopqrstuvxzABCDEFGHIJLMNOPQRSTUVXZ0123456789';
                $max = strlen($chars) - 1;

                $string = $charsInit{mt_rand(0,$maxInit)};

                for($i=1;$i<=($len-1);$i++){

                        $string .= $chars{mt_rand(0,$max)};

                }
                return $string;
        }

        function getRealIpAddr()
		{
		    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		    {
		      $ip=$_SERVER['HTTP_CLIENT_IP'];
		    }
		    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		    {
		      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		    }
		    else
		    {
		      $ip=$_SERVER['REMOTE_ADDR'];
		    }
		    return $ip;
}

?>