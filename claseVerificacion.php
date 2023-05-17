<?php

//clase adicional para verificar que los valores sea solo integ o string
//no tiene metodo __construct()

class verificacion{

    /**
     * verifica que el valor ingresado sea de tipo integ
     * @return int $valor
     */
    public function soloInteg(){

        $valor = trim(fgets(STDIN));

        while(!is_numeric($valor)){
            echo "ingrese solo numeros: ";
            $valor = trim(fgets(STDIN));
        }

        return $valor;

    }

    /** 
    * verifica si el dato ingresado a la variable es un string
    * @return string $string
    */
    public function esString(){
           
       $string = trim(fgets(STDIN));/*se ingresa el valor*/
   
       while(ctype_alpha($string) == false){/*se valida si es una cadena del tipo string con ctype_alpha(devuelve un booleano)*/
   
           echo "ingrese solo letras, no numeros: ";
           $string = trim(fgets(STDIN));
           
       }
       
       return $string;
    }

    
}