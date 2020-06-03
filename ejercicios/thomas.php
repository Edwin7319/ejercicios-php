<html>
    <body>
    <html>
    <center>
        </br><strong>RESOLUCION DE SISTEMAS LINEALES</strong> </br>
    </center>
    <center>
    <table>
    <form action="" method="Get">
         
        <br>
            <tr>
            <td>
            <form for="<br>".<"opc">Opciones:
            </td>
            <td>
            <select name="opc">
            <option value="AT">Algortimo de Thomas</option>
            <option value="NM">Newton Multivariable</option>
            </td>
            </tr>
        </br>
        </table>
        <input type="submit" name="btn_calcular" value="Calcular"/><br>
    </center>
    </form>
    <?php
        function imprimirMatriz($matriz,$n,$m,$nom){
        echo '<table  cellspacing="0" cellpadding="1" align="center">';
        echo "<div align=\"center\">".$nom."</div><br>";
        echo '<br>';
        for($i = 0; $i < $n; $i++){
            echo '<tr>';
            for($j = 0; $j < $m; $j++){
                echo '<td align = "center" width="55" style="border:2px solid black">'.$matriz[$i][$j].'</td>';
            }
        }
        echo '</table>';
        echo "<br>";
    }
 
    function Thomas($a, $b, $k, $n){
        for($i = 1; $i < $n; $i++){
            $a[$i][$i] = $a[$i][$i] - ($a[$i][$i-1]*$a[$i-1][$i])/$a[$i-1][$i-1];
            $b[$i][0] = $b[$i][0] - ($a[$i][$i-1]*$b[$i-1][0])/$a[$i-1][$i-1];
            $a[$i][$i-1] = 0;
        }
        $x[$n-1][0] = $b[$n-1][0]/$a[$n-1][$n-1];
         
        for($k = $n-2; $k >= 0; $k--)
            $x[$k][0] = ($b[$k][0]-$a[$k][$k+1]*$x[$k+1][0])/$a[$k][$k];
        return $x;
    }
     
    if(isset($_GET['btn_calcular'])){
        print '<br>';
        $o=$_GET['opc'];
 
        $i=0;
        $line;
         
        $file_handle = fopen("Matriz1.txt", "r");
         
        while (!feof($file_handle)) {
        $line[$i] = fgets($file_handle);
        $i++;
        }   
        fclose($file_handle);
        for ($j=0; $j<sizeof($line);$j++){
            $line[$j] = str_replace(array("\n", "\r"), '', $line[$j]);
        }
        $j=0;
        while (strcmp($line[$j], 'b')!=0){
            $data[$j] = explode(',', $line[$j]);
            $j++;
        }
        $j++;
        while (strcmp($line[$j], 'fxy')!=0){
            $aux= explode(',', $line[$j]);
            $j++;
        }   
        for($z=0;$z<sizeof($aux);$z++){
            $b[$z][0]=$aux[$z];
        }
        $j++;
        $fxy=$line[$j];
        $j++;
        while (strcmp($line[$j], 'J')!=0){
            $aux2= explode(',', $line[$j]);
            $j++;
        }
        for($z=0;$z<sizeof($aux2);$z++){
            $f[$z][0]=$aux2[$z];
        }
        $j++;
        $w=0;
        while(strcmp($line[$j], 'X')!=0){
            $ja[$w]= explode(',', $line[$j]);
            $j++;
            $w++;
        }
        $j++;
        $aux3= explode(',', $line[$j]);
        for($z=0;$z<sizeof($aux3);$z++){
            $x0[$z][0]=$aux3[$z];
        }
        $k=0;
        $n = sizeof($data); 
        $t=true;
     
        if($o=='AT'){
            imprimirMatriz($data, $n, $n, "MATRIZ COEFICIENTE:");
            imprimirMatriz($b, $n, 1, "MATRIZ TERMINOS INDEPENDIENTES:");
            imprimirMatriz(Thomas($data, $b, $k, $n),$n,1, "RESULTADO FINAL :");    
        }else{
            echo '<center>
        </br><strong>Funcion:';
        echo $fxy;
        echo'</strong> </br></center><br>';
            imprimirMatriz($x0, sizeof($x0), 1, "Estimativa Incial:");
            imprimirMatriz($f, sizeof($f), 1, "Vector F:");
            imprimirMatriz($ja, sizeof($ja), sizeof($ja), "MATRIZ COEFICIENTE:");
            while($t==true){
            $f1=Newton1($f,$x0);
            $ja1=Newton2($ja,$x0);
            $delta=Thomas($ja1,$f1,$k,sizeof($ja));
            $x1=Newton3($delta,$x0);
            $f2=Newton1($f,$x1);
            if(abs($f1[0][0]-$f2[0][0])<1e-8){
                imprimirMatriz($x1, sizeof($x1), 1, "RESULTADO:");
                $t=false;
            }else{
                $x0=$x1;
            }
            }   
        }
         
    }
    function Newton3($delta,$x0){
        for($z=0;$z<sizeof($delta);$z++){    
            $x1[$z][0]= $x0[$z][0]+$delta[$z][0];   
        }
        return $x1;
    }
    function Newton1($f,$x0){
        for($z=0;$z<sizeof($f);$z++){    
            $aux4=evaluarFuncion($f[$z][0],$x0[$z][0],'x',$x0[1][0],'y');
            eval('$aux5 = '.$aux4.';');
            $vf[$z][0]= -1*$aux5;
        }
        return $vf;
    }
     
    function Newton2($ja,$x0){
        for($z=0;$z<sizeof($ja);$z++){   
            for($j=0;$j<sizeof($ja);$j++){
                $aux6=evaluarFuncion($ja[$z][$j],$x0[$z][0],'x',$x0[1][0],'y');
                eval('$aux7 = '.$aux6.';');
                $ja1[$z][$j]= $aux7;
            }
        }
        return $ja1;
    }
    function fnEval($funcion){
        $funcion=str_replace("x",'($x)',$funcion);
        $funcion=str_replace("^","**",$funcion);
        $funcion=str_replace("sen","sin",$funcion);
        return $funcion; 
    }
                         
    function evaluarFuncion($funcion, $parametro1,$x,$parametro2,$y){
        $funcion=str_replace($x, $parametro1, $funcion);
        $funcion=str_replace($y, $parametro2, $funcion);
        $funcion=str_replace("^","**",$funcion);
        $funcion=str_replace("sen","sin",$funcion);
        return $funcion;
    }
     
 
    ?>
  </body>
</html>