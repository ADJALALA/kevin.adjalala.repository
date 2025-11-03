<?php
function my_division_modulo($firstNumber, $operChar, $secondNumber){
    if(!is_numeric($firstNumber)|| !is_numeric($secondNumber) || ($operChar !== '/' && $operChar !== '%') || $secondNumber == 0){
        throw new Exception(("the given arguments are'nt good\n"));
    }
    if($operChar === '/'){
        return $firstNumber / $secondNumber;
    }else{
        return $firstNumber % $secondNumber;
    }

}

// echo my_division_modulo(3, '/', 4) . "\n";
// echo my_division_modulo(2, '/', 1) . "\n";
// echo my_division_modulo(3, '%', 2) . "\n";
// try
// {
// echo my_division_modulo(3, '+', 1) . "\n";
// }
// catch (Exception $err)
// {
// echo $err->getMessage();
// }
// try
// {
// echo my_division_modulo(2, '/', 0) . "\n";
// }
// catch (Exception $err)
// {
// echo $err->getMessage();
// }

?>