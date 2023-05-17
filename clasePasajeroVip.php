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

    class pasajeroVip extends pasajeros{

        private $nroViajeroRecurente;
        private $cantMillasPasajero;

        public function __construct($nombreP,$apellidoP,$dniP,$telefonoP,$nroAsientoP,$nroTicketP,$nroViajeroRecurente,$cantMillasPasajero,$incrementoP)
        {
            
            parent::__construct($nombreP,$apellidoP,$dniP,$telefonoP,$nroAsientoP,$nroTicketP,$incrementoP);
            $this->nroViajeroRecurente = $nroViajeroRecurente;
            $this->cantMillasPasajero = $cantMillasPasajero;

        }

/****************************************************************************************************************************** */

        public function get_nroViajeroRecurente(){
            return $this->nroViajeroRecurente;
        }

        public function get_cantMillasP(){
            return $this->cantMillasPasajero;
        }

/****************************************************************************************************************************** */

        public function set_nroViajeroRecurente($nroViajeroRecurente){
            $this->nroViajeroRecurente = $nroViajeroRecurente;
        }

        public function set_cantMillasP($cantMillasPasajero){
            $this->cantMillasPasajero = $cantMillasPasajero;
        }

/****************************************************************************************************************************** */

        public function __toString()
        {
            $cadenaP = parent::__toString();

            return

            "|---------------DATOS DE PASAJERO V.I.P ---------------|"."\n".
            $cadenaP."\n".
            "Nro de viajero recurrente del pasajero: ". $this->get_nroViajeroRecurente()."\n".
            "Cantidad de millas acumuladas del pasajero: ". $this->get_cantMillasP()."\n";

        }

/****************************************************************************************************************************** */


        /**
        * Para un pasajero VIP se incrementa el importe un 35% y si la cantidad de millas acumuladas supera a las 300 millas 
        *se realiza un incremento del 30%.
        */

        public function darPorcentajeIncremento()
        {
            $cantMillasPasajero = $this->get_cantMillasP();

            if ( $cantMillasPasajero >= 300){

                $porcentajeIncrementoVip = 30/100;

                parent::set_incrementoP($porcentajeIncrementoVip);

            }else{

                $porcentajeIncrementoVip = 35/100;

                parent::set_incrementoP($porcentajeIncrementoVip);

            }

            return parent::darPorcentajeIncremento();

        }



    } 

