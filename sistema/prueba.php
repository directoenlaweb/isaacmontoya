<HTML>
<HEAD>
	<?php
$pagina = curl_init();
curl_setopt($pagina, CURLOPT_URL, "http://www.banxico.org.mx/tipcamb/llenarTiposCambioAction.do?idioma=sp");
curl_setopt($pagina, CURLOPT_HEADER, 0);
curl_setopt($pagina, CURLOPT_RETURNTRANSFER, true); 
$pagina2 = curl_exec($pagina);
curl_close($pagina);
$pagina2 = explode('<div id="FIX_DATO">',$pagina2,2);
$dolar = explode('</div>',$pagina2[1],2);
$precioDolar = $dolar[0];
?>

<script>
var precioC1 = <?php echo($precioDolar)?> * 30;
var precioC2 = <?php echo($precioDolar)?> * 35;
var precioC3 = <?php echo($precioDolar)?> * 40;

function combo(thelist, theinput)
{
  //thelist = document.getElementById(thelist);
  theinput = document.getElementById(theinput);  
  var idx = thelist.selectedIndex;
  var content = thelist.options[idx].innerHTML;
  if(content == "ClienteLigero1"){
  	theinput.value = "$"+precioC1;		
  }else if(content == "ClienteLigero2"){
  	theinput.value = "$"+precioC2;
  }else{
  	theinput.value = "$"+precioC3;
  }
}

function calcular(thelist, cantidad, resultado)
{
	console.log("Entro");
	thelist = document.getElementById(thelist);
	var lista = thelist.selectedIndex;
	var content = thelist.options[lista].innerHTML;
	console.log(content);
	resultado = document.getElementById(resultado);
	cantidad = document.getElementById(cantidad);
	var cant = cantidad.value;
  	if(content == "ClienteLigero1"){
  		resultado.value = "$"+precioC1*cant;		
  	}else if(content == "ClienteLigero2"){
  		resultado.value = "$"+precioC2*cant;
  	}else{
  		resultado.value = "$"+precioC3*cant;
  	}

}

</script>
</HEAD
<BODY>

<select name="thelist" id="thelist" onClick="combo(this, 'theinput')">
  <option>ClienteLigero1</option>
  <option>ClienteLigero2</option>
  <option>ClienteLigero3</option>
</select>
<input type="text" id="theinput" name="theinput" disabled="false"/>
<input type="text" id="cantidad" name="cantidad" value="0">
<button type="button" onClick="calcular('thelist', 'cantidad', 'resultado')">Calcular</button>
<?php
	echo("<script>");
	echo("combo('thelist','theinput');");
	echo("</script>");
?>
<input type="text" id="resultado" name="resultado" disabled="false"/>


</BODY>
</HTML>