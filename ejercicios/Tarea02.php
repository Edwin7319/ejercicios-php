<html>
<head>
	<title>TAREA 02</title>
	<body>
		<h2><center>
			M&Eacute;TODOS NUM&Eacute;RICOS
		</center></h2>
	
		<table>
			<form method="get" name="form1" action="">
			<tr>
				<td>
					Funci&oacute;n:
				</td>
				<td>
					<input type="text" name="Fx" value="<?php if(isset($_GET['Fx'])) echo $_GET['Fx']; ?>">
				</td>
			</tr>
			<tr>
				<td>
					Derivada:
				</td>
				<td>
					<input type="text" name="Dx" value="<?php if(isset($_GET['Dx'])) echo $_GET['Dx'];?>">
				</td>
			</tr>
			<tr>
				<td>
					Ingrese un Punto:
				</td>
				<td>
					<input type="text" name="Pt" value="<?php if(isset($_GET['Pt'])) echo $_GET['Pt'];?>">
				</td>
			</tr>
			
				<tr>
				<td colspan="2">
					<input type="submit" name="boton" value="Generar">
				</td>
			</tr>
			</form>
			</table>

	<?php 


	if(isset($_GET['boton'])){

				$x=$_GET['Pt'];
				$b=0.1;
				$contador=1;

				function crearFuncion($x,$fun){
					$resultado=0;
					$resultado=$fun;
					$fun=str_replace('x','($x)',$fun);
					$fun=str_replace('^','**',$fun);

					eval ("\$fun=\"$fun\";");
					echo $fun."<br>";

                 return $resultado ;

				} 

				$funcion=crearFuncion($x,$_GET['Fx']);
				$derivada=crearFuncion($x,$_GET['Dx']);

			echo $funcion;
}
	

			?>



		
		<h4> DERIVADA CENTRADA </h4>
		<table border=1 width=60%>
			<tr bgcolor=yellow> 
				<td width=20%> L </td>
				
				<td width=40%> Delta X </td>

				<td width=40%> F'(x)</td>
			</tr>
		</table>
		<table border=1 width=60%>

		<?php
		

		for ($i=0; $i<10; $i++) { 


		?>

		<tr>
		<td width=20%> <?php echo $i; ?> </td>
		<td width=40%> <?php echo "Cosas"; ?> </td>	
		<td width=40%> <?php echo '21312' ?> </td>		
		</tr>

		<?php } ?>		

		</table>



		
		<h4> DERIVADA AVANZADA </h4>
		<table border=1 width=60%>
			<tr bgcolor=blue> 
				<td width=20%> L </td>
				
				<td width=40%> Delta X </td>

				<td width=40%> F'(x)</td>
			</tr>
		</table>
		<table border=1 width=60%>


		<tr>
		<td width=20%> <?php echo $i; ?> </td>
		<td width=40%> <?php echo "Cosas"; ?> </td>	
		<td width=40%> <?php echo "prueba"; ?> </td>		
		</tr>	

		</table>


		
		
		<h4> DERIVADA RETRASADA </h4>
		<table border=1 width=60%>
			<tr bgcolor=green> 
				<td width=20%> L </td>
				
				<td width=40%> Delta X </td>

				<td width=40%> F'(x)</td>
			</tr>
		</table>
		<table border=1 width=60%>

		<?php
		
		for ($i=0; $i<10; $i++) { 

		?>

		<tr>
		<td width=20%> <?php echo $i; ?> </td>
		<td width=40%> <?php echo "Cosas"; ?> </td>	
		<td width=40%> <?php echo "prueba"; ?> </td>		
		</tr>

		<?php } ?>		

		</table>

		
	</body>
	</head>
</html>