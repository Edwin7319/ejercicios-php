<?php  

echo "NOMBRE: Guamushig Gualotuña Edwin Paul <br/>";
echo "GRUPO:  Gr-01 <br/>";
echo "Funcion ingresada: (x^3)+(x^2)+3, con un valor de 5 para X <br/>";

$h=0.1;
$x=5;
$tolerancia=0.0;
$cont=1;

function crearFun($v){
    return pow($v,3)+pow($v, 2)+3;
}
 
 $derivada=0.0;

do{
    
    

    $derivada=(crearFun($x+$h)-crearFun($x-$h))/(2*$h);
    $h=$h/2;
    $aux=(crearFun($x+$h)-crearFun($x-$h))/(2*$h);
    $tolerancia=abs($derivada-$aux);
   
    echo "--------------------------------------------------------<br>";
    echo"El valor de B es:  $h <br>";
    echo "Valor de la Derivada ".$cont." es:  ".$derivada." <br>";
     echo "Valor de tolerancia:  $tolerancia <br>";
    $cont++;


}while ($tolerancia>(1/10000000000));

echo "<br>";
echo "******************************************<br>";
echo"El valor de B es:  $h <br>";
echo "******************************************<br>";
?>