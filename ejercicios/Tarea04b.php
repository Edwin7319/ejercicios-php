<html>
<head>
	<title>TAREA 04</title>
	<body>
		<h2><center>
			M&Eacute;TODO NUM&Eacute;RICOS
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
					Integral Analitica:
				</td>		
				<td>
					<input type="text" name="Ix" value="<?php if(isset($_GET['Ix'])) echo $_GET['Ix'];?>">
				</td>
			</tr>
			<tr>
				<td>
					Cota Inferior (a):
				</td>
				<td>
					<input type="text" name="A" value="<?php if(isset($_GET['A'])) echo $_GET['A'];?>">
				</td>
			</tr>
			<tr>
				<td>
					Cota Superior (b):
				</td>
				<td>
					<input type="text" name="B" value="<?php if(isset($_GET['B'])) echo $_GET['B'];?>">
				</td>
			</tr>
			<tr>
				<td>
					Tolerancia:
				</td>
				<td>
					<input type="text" name="tol" value="<?php if(isset($_GET['tol'])) echo $_GET['tol'];?>">
				</td>
			</tr>
			<tr> 
		        <td>   Escoja el metodo: </td>
			    <td>   <select name="opcion">
			    	   <option value="2" selected>Metodo de Trapecios</option>
                       <option value="3" selected>Metodo de Simpson</option> 
                       <option value="1" selected>Seleccione</option>
                </select> 
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

			function funcion($x, $func){
			    $resultado=0;

			    $resultado=str_replace('x', '($x)', $func);
			    $resultado= str_replace('^', '**', $resultado);
			    $resultado= preg_replace('/(\d)(\()/i', "\\1*\\2", $resultado);
			    eval("\$resultado= ". $resultado .";");

			    return $resultado;                                         
		    }
 		 

 		 if(isset($_GET['boton'])){
     		
     		$cotaInf=$_GET['A'];
		    $cotaSup=$_GET['B'];
		   $tolerancia=$_GET['tol'];
		   $valorInt=funcion($cotaSup,$_GET['Ix'])-funcion($cotaInf,$_GET['Ix']);
		   $opcion=$_GET['opcion'];
		    

		   if($opcion==2){

		   $contador=1;
		   $trapecios=1;
		   echo "<br/>";
		   echo "TABLA DE RESULTADOS METODO DEL TRAPECIO<br/>";
		   echo "<br/>";
		   $aux=1;
		
		 echo "<table border='1' >";
      	 echo "<td bgcolor=yellow>N# Iteracion</td>
      	 <td bgcolor=yellow># de trapecios</td>
      	 <td bgcolor=yellow>Integral Numerica</td>
      	 <td bgcolor=yellow> Integral Analitica</td>
      	 <td bgcolor=yellow>Error/integral</td>";
		  
		  while($aux>$tolerancia && $trapecios<500){
		  	echo"<tr >";  

			$h=($cotaSup-$cotaInf)/$trapecios;
			$s=0;
			$aux=0;
			
			

			 for ($i=1; $i<=$trapecios; $i++){
	
			 	$s=(($h/2)*(funcion(($cotaInf+($i-1)*$h),$_GET['Fx'])+funcion(($cotaInf+($i)*$h),$_GET['Fx']))+$s);
			 	
			 }
				$aux=abs($s-$valorInt);
			  echo 
			  "<td>$contador</td>
			  <td>$trapecios </td>
			  <td> $s </td> 
			  <td>$valorInt </td>
			  <td>$aux </td>";
			  echo"<tr>";
			 $trapecios=$trapecios+2;
			 $contador++;
			
			}
	
		    echo "</table>";


		} elseif($opcion==3){

		
		   $divisiones=2;
		   $contador=1;
		   echo "<br/>";
		   echo "TABLA DE RESULTADOS METODO DE SIMPSON <br/>";
		   echo "<br/>";
		   $aux=1;
		   $area=0;
		
		 echo "<table border='1' >";
      	 echo "<td bgcolor=yellow>N# Iteracion</td>
      	 <td bgcolor=yellow># de trapecios</td>
      	 <td bgcolor=yellow>Integral Numerica</td>
      	 <td bgcolor=yellow> Integral Analitica</td>
      	 <td bgcolor=yellow>Error/integral</td>";
		  
		  while($aux>$tolerancia && $divisiones<500){
		  	echo"<tr >";  

			$h=($cotaSup-$cotaInf)/$divisiones;

			$s=(1/3)*(funcion($cotaInf,$_GET['Fx'])+funcion($cotaSup,$_GET['Fx']));


			for($i=1; $i<$divisiones; $i+=2){

         		$x = $cotaInf + $h * $i;
            	$s += (4/3) * funcion($x,$_GET['Fx']);
      		  }

     		for($i=2; $i<$divisiones; $i+=2){

         		$x = $cotaInf + $h * $i;
           		$s += (2/3) * funcion($x,$_GET['Fx']);

       	 	}

			$s=$s*$h;
			$error=abs($valorInt-$s);


			  echo 
			  "<td>$contador</td>
			  <td>$divisiones </td>
			  <td> $s </td> 
			  <td>$valorInt </td>
			  <td>$error </td>";
			  echo"<tr>";
			 $divisiones+=2;
			 $contador++;
			
			}
	
		    echo "</table>";

		
		}
		

		} 
		    

			?>
		
	</body>
	</head>
</html>