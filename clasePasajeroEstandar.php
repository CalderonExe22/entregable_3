
<?php

/*  La empresa de transporte desea gestionar la información correspondiente a los pasajeros de los Viajes que pueden ser:
    
    Pasajeros estándares, Pasajeros VIP y Pasajeros con necesidades especiales. La clase Pasajero tiene como atributos el nombre,
    
    el número de asiento y el número de ticket del pasaje del viaje. La clase "PasajeroVIP" tiene como atributos adicionales el número de 
    
    viajero recuente y cantidad de millas de pasajero. La clase Pasajeros con necesidades especiales se refiere a pasajeros que pueden requerir 
    
    servicios especiales como sillas de ruedas, asistencia para el embarque o desembarque, o comidas especiales para personas con alergias o 
    
    restricciones alimentarias.
    
    La empresa ahora necesita implementar la venta de un pasaje, para ello debe realizar la función venderPasaje(pasajero) que registra
    
    la venta de un viaje al pasajero que es recibido por parámetro. La venta se realiza solo si hayPasajesDisponible. Si el pasaje es para
    
    un pasajero VIP se incrementa el importe un 35% y se le da al pasajero unas 1500 millas. Si el pasaje es para un pasajero con necesidades 
    
    especiales y requiere silla de ruedas, asistencia y comida especial entonces el pasaje tiene un incremento del 30%; si solo requiere uno 
    
    de los servicios prestados entonces el incremento es del 15%. Para todos los pasajes si el viaje es ida y vuelta, se incrementa el importe 
    
    del viaje un 50%. El método retorna el importe del pasaje si se pudo realizar la venta. Modifique la clase venta segun se requiera para 
    
    cumplir con los requerimientos mencionados.
    
    Implemente la función hayPasajesDisponible() que retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad
    
    máxima de pasajeros y falso caso contrario.*/

 include_once("clasePasajero.php");

class pasajeroEstandar extends pasajeros{

    
    public function __construct($nombreP,$apellidoP,$dniP,$telefonoP,$nroAsientoP,$nroTicketP,$incrementoP)
    {
        
        parent::__construct($nombreP,$apellidoP,$dniP,$telefonoP,$nroAsientoP,$nroTicketP,$incrementoP);

    }

/*********************************************************************************************************************** */

    public function __toString()
    {   

        $cadenaP = parent::__toString();

        return 

        "|---------------DATOS DE PASAJERO ESTANDAR ---------------|"."\n".
        $cadenaP."\n";

    }

/*********************************************************************************************************************** */

    public function darPorcentajeIncremento()
    {

        $porcentajeIncrementoEst = 15/100;

        parent::set_incrementoP($porcentajeIncrementoEst);

        return parent::darPorcentajeIncremento();

    }


}

