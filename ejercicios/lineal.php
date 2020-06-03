<html>
    <body>
    <html>
    <center>
        </br><strong>INTERPOLACION LINEAL</strong> </br>
    </center>
    <center>
    <table>
    <form method="get" name="form1" action=" ">
            <tr>
                <td>
                    Punto A:
                </td>
                <td>
                    <input tpe="text" name="A" value="<?php if(isset($_GET['A'])) echo $_GET['A'];?>">
                </td>
            </tr>
            <tr>
                <td>
                    Punto B:
                </td>
                <td>
                    <input type="text" name="B" value="<?php if(isset($_GET['B'])) echo $_GET['B'];?>">
                </td>
            </tr>
                        <tr>
                <td>
                    Punto donde se quiere obtener la aproximacion:
                </td>
                <td>
                    <input type="text" name="C" value="<?php if(isset($_GET['C'])) echo $_GET['C'];?>">
                </td>
            </tr>
        </table>
        <input type="submit" name="btn_calcular" value="Calcular"/><br>
    </center>
    </form>
    <?php
     
    if(isset($_GET['btn_calcular'])){
        $tabla = "
                    <center>
                    <table>
                    <table style=width:10%>
                    <style>
                    table, th, td {
                    border: 1px solid black;
                    }
                    </style>";
        $tabla .= "<tr><th>k</th>
                   <th> Xk</th> 
                   <th> Yk</th>
                   </tr>";
 
        print '<br>';
        $a=$_GET['A'];
        $b=$_GET['B'];
        $e=$_GET['C'];
        $x[0]=explode(',', $a);
        $x[1]=explode(',', $b);
     
         
        for($i=0; $i<2; $i++){
            $y=$i+1;
            $xi=$x[$i][0];
            $yi=$x[$i][1];
            $tabla .= "<tr><td>$y</td>
                           <td> $xi</td>
                           <td> $yi</td>
                           </tr>";
        }
        $tabla .= "</center>
        </table>";
        echo $tabla;
         if ($e> $x[0][0] and $e < $x[1][0]) {
            $gamma = gamma($e[0][0], $x[0][0], $x[1][0]);
 
            $funcionE = fx($gamma, $x[0][1], $x[1][1]);
            echo "<br><strong>f(" . $e . ")=</strong> " . $funcionE;
        } else {
        echo "<br><strong>". $e. " <strong> no se encuentra en el dominio <strong>[ " . $x[0][0] . " , " . $x[1][0] . " ]</striong>";
        }
    }
 
    function fx($gamma, $y1, $y2) {
        return ((1 - $gamma) * $y1) + ($gamma * $y2);
    }
    function gamma($e, $x1, $x2) {
        return($e - $x1) / ($x2 - $x1);
    }
 
    ?>
  </body>
</html>