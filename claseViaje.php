<?php

/*Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos 
nombre, apellido, numero de documento y teléfono.

El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero. 
También se desea guardar la información de la persona 
responsable de realizar el viaje, para ello cree una clase ResponsableV que registre el 
número de empleado, número de licencia, nombre y apellido.
La clase Viaje debe hacer referencia al responsable de realizar el viaje.

Volver a implementar las operaciones que permiten modificar el nombre, apellido y teléfono
 de un pasajero. Luego implementar la operación que agrega los pasajeros al viaje, 
solicitando por consola la información de los mismos. Se debe verificar que el pasajero no 
este cargado mas de una vez en el viaje. De la misma forma cargue la información del
responsable del viaje.

Nota: Recuerden que deben enviar el link a la resolución en su repositorio en GitHub.*/

/*La empresa de transporte desea gestionar la información correspondiente a los pasajeros de los Viajes que pueden ser: Pasajeros estándares, Pasajeros VIP y 
Pasajeros con necesidades especiales. 
La clase Pasajero tiene como atributos el nombre, el número de asiento y el número de ticket del pasaje del viaje. La clase "PasajeroVIP" tiene 
como atributos adicionales el número de viajero frecuente y cantidad de millas de pasajero. La clase Pasajeros con necesidades especiales se refiere a 
pasajeros que pueden requerir servicios especiales como sillas de ruedas, asistencia para el embarque o desembarque, o comidas especiales para personas 
con alergias o restricciones alimentarias.  Implementar el método darPorcentajeIncremento () que retorne el porcentaje que debe aplicarse como incremento 
según las características del pasajero. Para un pasajero VIP se incrementa el importe un 35% y si la cantidad de millas acumuladas supera a las 300 millas 
se realiza un incremento del 30%. Si el pasajero tiene necesidades especiales y requiere silla de ruedas, asistencia y comida especial entonces el pasaje tiene 
un incremento del 30%; si solo requiere uno de los servicios prestados entonces el incremento es del 15%. Por último, para los pasajeros comunes el porcentaje de 
incremento es del 10 %.
Modificar la clase viaje para almacenar el costo del viaje, la suma de los costos abonados por los pasajeros e implementar el método
 venderPasaje($objPasajero) que debe incorporar el pasajero a la colección de pasajeros ( solo si hay espacio disponible), actualizar 
 los costos abonados y retornar el costo final que deberá ser abonado por el pasajero.
Implemente la función hayPasajesDisponible() que retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad máxima de pasajeros y falso caso contrario*/

include_once("clasePasajero.php");
include_once("clasePasajeroVip.php");
include_once("clasePasajeroEstandar.php");
include_once("clasePasajeroEspeciales.php");

class viaje{

    private $codigoViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $cantPasajeros;
    private $pasajerosEstandars;
    private $pasajerosVip;
    private $pasajerosEspeciales;
    private $responsableViaje;
    private $precioViaje;
    private $sumaTotalViajes;


    public function __construct($codViaje,$dest,$maxPasaj,$cantDePasajeros,$pasajerosEstandars,$pasajerosVip,$pasajerosEspeciales,$responsableViaje,$precioViaje,$sumaTotalViajes){
        /* int $codViaje,$dest,$maxPasaj,$cantDePasajeros
           string $dest*/

        $this->codigoViaje = $codViaje;
        $this->destino = $dest;
        $this->cantMaxPasajeros = $maxPasaj;
        $this->cantPasajeros = $cantDePasajeros;
        $this->pasajerosEstandars = $pasajerosEstandars;
        $this->pasajerosVip = $pasajerosVip;
        $this->pasajerosEspeciales = $pasajerosEspeciales;
        $this->responsableViaje = $responsableViaje;
        $this->precioViaje = $precioViaje;
        $this->sumaTotalViajes = $sumaTotalViajes;
        
    }

 /**************************metodo de retorno de valores de la clase***************************************** */

    public function get_codijo_viaje (){
        return $this->codigoViaje;
    }

    public function get_destino_viaje (){
        return $this->destino;
    }

    public function get_cantMax_pasajeros (){
        return $this->cantMaxPasajeros;
    }

    public function get_cant_pasajeros (){
        return $this->cantPasajeros;
    }

    public function get_pasajeros_estandars (){
        return $this->pasajerosEstandars;
    }

    public function get_pasajeros_vip(){
        return $this->pasajerosVip;
    }

    public function get_pasajeros_especiales(){
        return $this->pasajerosEspeciales;
    }

    public function get_responsable_viaje (){
        return $this->responsableViaje;
    }

    public function get_precio_viaje(){
        return $this->precioViaje;
    }

    public function get_suma_viajes_dinero(){
        return $this->sumaTotalViajes;
    }

 /*****************metodos de setiado de valores de la clase************************************** */

    public function set_codijo_viaje ($codigoViaje){
        $this->codigoViaje = $codigoViaje;
    }

    public function set_destino_viaje ($destino){
        $this->destino = $destino;
    }

    public function set_cantMax_pasajeros ($cantMax){
        $this->cantMaxPasajeros = $cantMax;
    }

    public function set_cant_pasajeros ($cant){
        $this->cantPasajeros = $cant;
    }

    public function set_pasajeros_estandars ($pasajerosEstandars){
        $this->pasajerosEstandars = $pasajerosEstandars;
    }

    public function set_pasajeros_vip($pasajerosVip){
        $this->pasajerosVip = $pasajerosVip;
    }

    public function set_pasajeros_especiales($pasajerosEspeciales){
        $this->pasajerosEspeciales = $pasajerosEspeciales;
    }

    public function set_responsable_viaje ($respViaje){
        $this->responsableViaje = $respViaje;
    }

    public function set_presio_viaje($precioViaje){
        $this->precioViaje = $precioViaje;
    }

    public function set_suma_viajes_dinero($sumaTotalViajes){
        $this->sumaTotalViajes = $sumaTotalViajes;
    }

/*********************************************************** ****************************************************/

    /**
     * busca a traves del dni ingresado por parametro, retorna el indice de la coleccion del objetos pasajerosEstandars con el 
     * mismo dni, si no lo encuentra retorna -1
     * @param int $nroDni
     * @return int $indicePasajero
     */
    public function buscarPasajeroEstandar($nroDni){
    
        $pasajerosEstandars = $this->get_pasajeros_estandars();//coleccion de objetos de pasajeros

        $contador = count($pasajerosEstandars);

        $i = 0;

        $indicePasajeroEstandar = -1;

        $seEncontro = false;

        while ( $i < $contador && !$seEncontro){

            $objPasajeroEstandar = $pasajerosEstandars[$i];

            if ( $objPasajeroEstandar->get_dni_pasajero () == $nroDni ){

                $seEncontro = true;
                $indicePasajeroEstandar = $i;

            }

            $i++;

        }

        return $indicePasajeroEstandar;
        
    }

/************************************************************************************************************************************************* */

    /**
     * 
     */

     public function buscarPasajeroVip($nroDni){

        $pasajerosVip = $this->get_pasajeros_vip();

        $contador = count($pasajerosVip);

        $i = 0;

        $indicePasajeroVip = -1;

        $seEncontro = false;

        while ( $i < $contador && !$seEncontro ){

            $objPasajeroVip = $pasajerosVip[$i];

            if ( $objPasajeroVip->get_dni_pasajero () == $nroDni ){

                $seEncontro = true;

                $indicePasajeroVip = $i;

            }

            $i++;

        }

        return $indicePasajeroVip;

     }

/********************************************************************************************************************************************** */

    /**
     * 
     */

     public function buscarPasajeroEspecial($nroDni){

        $pasajerosEspeciales = $this->get_pasajeros_especiales();

        $contador = count($pasajerosEspeciales);

        $i = 0;

        $seEncontro = false;

        $indicePasajeroEspecial = -1;

        while ( $i < $contador && !$seEncontro){

            $objPasajeroEspecial = $pasajerosEspeciales[$i];

            if ( $objPasajeroEspecial->get_dni_pasajero () == $nroDni){

                $seEncontro = true;

                $indicePasajeroEspecial = $i;

            }

            $i++;

        }

        return $indicePasajeroEspecial;

     }

/******************************************************************************************************************************************** */

    /** 
     * verifica primero si el dni se encuentra dentro de la coleccion de objetos pasajeros con el metodo buscarPasajero
     * y modifica los datos del pasajero en cuenstion usando el metodo set de la clase viaje(siempre y cuando el pasajero se 
     * encuentre en la coleccion).
     * y retorna el indice del pasajero modificado o -1 si no se pudo modificar
     * @param string $nombre,$apellido
     * @param int $dni,$telefono,$buscarDni
     * @return int $indice
     */
    public function  modificarPasajeroEstandar($nombre,$apellido,$telefo,$dni,$nroAsiento,$nroTicket,$buscarDni){

        $losPasajerosEstandars = $this->get_pasajeros_estandars();
        
        $contador = count($losPasajerosEstandars);

        $indice = $this->buscarPasajeroEstandar($buscarDni);

        if ( $indice >= 0 ){

            $objPasajero = $losPasajerosEstandars[$indice];
            $objPasajero->set_nombre_pasajero($nombre);
            $objPasajero->set_apellido_pasajero($apellido);
            $objPasajero->set_dni_pasajero ($dni);
            $objPasajero->set_telefono_pasajero($telefo);
            $objPasajero->set_nro_asiento($nroAsiento);
            $objPasajero->set_nro_ticketViaje($nroTicket);

            $losPasajerosEstandars[$indice] = $objPasajero;
            
            $this->set_pasajeros_estandars($losPasajerosEstandars);

        }

        return $indice;

    }

/********************************************************************************************************************************************************* */


    public function modificarPasajeroVip($nombre,$apellido,$dni,$telefono,$nroAsiento,$nroTicket,$nroViajeroRecurrente,$cantMillas,$buscarDni){

        $losPasajerosVip = $this->get_pasajeros_vip();

        $contador = count($losPasajerosVip);

        $indice = $this->buscarPasajeroVip($buscarDni);

        if ($indice >= 0){

            $objPasajero = $losPasajerosVip[$indice];
            $objPasajero->set_nombre_pasajero($nombre);
            $objPasajero->set_apellido_pasajero($apellido);
            $objPasajero->set_dni_pasajero ($dni);
            $objPasajero->set_telefono_pasajero($telefono);
            $objPasajero->set_nro_asiento($nroAsiento);
            $objPasajero->set_nro_ticketViaje($nroTicket);
            $objPasajero->set_nroViajeroRecurente($nroViajeroRecurrente);
            $objPasajero->set_cantMillasP($cantMillas);

            $losPasajerosVip[$indice] = $objPasajero;

            $this->set_pasajeros_vip($losPasajerosVip);
        }

        return $indice;


    }



/********************************************************************************************************************************************************* */

    public function modificarPasajeroEspecial($nombre,$apellido,$dni,$telefono,$nroAsiento,$nroTicket,$PoseeSillaDeRuedas,$asistencia,$comidasEspeciales,$buscarDni){

        $losPasajerosEspeciales = $this->get_pasajeros_especiales();

        $contador = count($losPasajerosEspeciales);

        $indice = $this->buscarPasajeroEspecial($buscarDni);

        if ( $indice >= 0){

            $objPasajero = $losPasajerosEspeciales[$indice];
            $objPasajero->set_nombre_pasajero($nombre);
            $objPasajero->set_apellido_pasajero($apellido);
            $objPasajero->set_dni_pasajero ($dni);
            $objPasajero->set_telefono_pasajero($telefono);
            $objPasajero->set_nro_asiento($nroAsiento);
            $objPasajero->set_nro_ticketViaje($nroTicket);
            $objPasajero->set_PoseeSillaDeRuedas($PoseeSillaDeRuedas);
            $objPasajero->set_Asistencia ($asistencia);
            $objPasajero->set_comidas_especiales($comidasEspeciales);

            $losPasajerosEspeciales[$indice] = $objPasajero;

            $this->set_pasajeros_especiales($losPasajerosEspeciales);
        }

    }

/********************************************************************************************************************************************************* */

    /*
     * agrega un objeto pasajero nuevo siempre y cuando este no se encuentre ya registrado(usamos tambien el metodo buscarPasajero para 
     * asegurar que el dni del pasajero que ingresemos
     * no este en la coleccion de pasajeros) . retorna -1 si el agregado fue exitoso o el indice del pasajero si este ya se encontraba 
     * registrado
     * @param objet $objPasajeroAniadir
     * @return int $indice
     
    public function agregarPasajero($objPasajeroAniadir){

        $losPasajeros = $this->get_info_pasajeros();
        
        $contador = count($losPasajeros);
        
        $buscarPasajero = $objPasajeroAniadir->get_dni_pasajero();

        $indice = $this->buscarPasajero($buscarPasajero);

        if( $indice == -1 && $contador < $this->get_cantMax_pasajeros()){   

            $losPasajeros[] = $objPasajeroAniadir;

            $cantNueva = count($losPasajeros);

            $this->set_info_pasajeros($losPasajeros);

            $this->set_cant_pasajeros($cantNueva);

        }

        return $indice;

    }*/

/************************************************************************************************************************************************ */

    /**
     * usando el numero de empleado, se busca dentro de la coleccion de la clase responsable a algun responsable de viaje con 
     * el mismo numero de empleado, si se encuentra retorna el indice de la coleccion, sino retornara -1
     * @param int $nroEmpleadoR
     * @return int $indice
     */
    public function buscarResponsable($nroEmpleadoR){

        $responsables = $this->get_responsable_viaje();

        $contador = count($responsables);

        $i = 0;

        $encontro = false;

        $indice = -1;

        while ( $i < $contador && !$encontro){

            $objResponsable = $responsables[$i];

            if ( $objResponsable->get_nroEmpleado_responsable ( ) == $nroEmpleadoR){

                $encontro = true;
                $indice = $i;

            }

            $i++;
        }

        return $indice;

    }

/******************************************************************************************************************************************************* */

    /**
     * modifica los datos del responsable con el mismo nro de empleado(para verificar el nro empleado se usa el metodo buscarResponsable).
     * si el responsable se encuentra dentro de la coleccion de la coleccion de objetos responsables, entonse se modifica los datos atraves 
     * del metodo set.
     * retorna el indice del responsable modificado, sino se pudo modificar, retorna -1
     * @param int $nroEmpleadoR,$nroLicencia,$buscarNroEmpleadoR
     * @param string $nombre, $apellido
     */
    public function modificarResponsable($nroEmpleadoR,$nroLicencia, $nombre, $apellido,$buscarNroEmpleadoR){

        $responsables = $this->get_responsable_viaje();

        $contador = count($responsables);

        $indice = $this->buscarResponsable($buscarNroEmpleadoR);

        if ( $indice >= 0){

            $objResponsable = $responsables[$indice];

            $objResponsable->set_nombre_responsable ($nombre);
            $objResponsable->set_apellido_responsable ( $apellido );
            $objResponsable->set_nroLicencia_responsable( $nroLicencia);
            $objResponsable->set_nroEmpleado_responsable ( $nroEmpleadoR);

            $responsables[$indice] = $objResponsable;

            $this->set_responsable_viaje($responsables);

        }

        return $indice;

    }

/****************************************************************************************************************************** */

    /**
     * se ingresa un nuevo objeto responsable dentro de la coleccion de este mismo siempre y cuando no
     *  se encuentre ya registrado dentro de la coleccion , si el ingreso es exitoso 
     * retorna -1, sino retorna el indice del objeto responable
     */
    public function agregarResponsable($agregarResponsable){

        $responsables = $this->get_responsable_viaje();

        $indice = $agregarResponsable->get_nroEmpleado_responsable ( );

        $seEncuentra = $this->buscarResponsable($indice);

        if ( $seEncuentra == -1){

            $responsables[] = $agregarResponsable;
            
            $this->set_responsable_viaje($responsables);

        }

        return $seEncuentra;

    }


/***************************************************************************************************************************** */

    /**
     * retorna verdadero si la cantidad de pasajeros del viaje es menor a la 
     * cantidad máxima de pasajeros y falso caso contrario
     * @return boolean
     */

     public function hayPasajesDisponible(){

        $cantMaxPasajeros = $this->get_cantMax_pasajeros();
        $cantDePasajeros = $this->get_cant_pasajeros();

        $hayPasajerosDisp = null;

        if( $cantDePasajeros < $cantMaxPasajeros){

            $hayPasajerosDisp = true;

        }else{

            $hayPasajerosDisp = false;

        }

        return $hayPasajerosDisp;


     }



/***************************************************************************************************************************** */

    /**
    * incorporar el pasajero a la colección de pasajeros ( solo si hay espacio disponible), actualizar 
    *los costos abonados y retornar el costo final que deberá ser abonado por el pasajero.
    */

    public function venderPasaje($objPasajero){

        $pasajerosEspeciales = $this->get_pasajeros_especiales();

        $pasajerosVip = $this->get_pasajeros_vip();

        $pasajerosEstandars = $this->get_pasajeros_estandars();

        $espacioDisp = $this->hayPasajesDisponible();

        $precioViaje = $this->get_precio_viaje();

        $estaRegistrado = $objPasajero->get_dni_pasajero ();

        $montoViaje = 0;

        if ( $espacioDisp ){

            if ( get_class($objPasajero) == "pasajeroEstandar" && $this->buscarPasajeroEstandar($estaRegistrado) == -1 ){

                $pasajerosEstandars[] = $objPasajero;

                $this->set_pasajeros_estandars($pasajerosEstandars);

                $montoViaje = $montoViaje + $precioViaje + ($objPasajero->darPorcentajeIncremento() * $precioViaje);

                $sumaTotal = $this->get_suma_viajes_dinero() + $montoViaje;

                $this->set_suma_viajes_dinero($sumaTotal);

            }

            if ( get_class($objPasajero) == "pasajeroVip" && $this->buscarPasajeroVip($estaRegistrado) == -1 ){

                $pasajerosVip[] = $objPasajero;

                $this->set_pasajeros_vip($pasajerosVip);

                $montoViaje = $montoViaje + $precioViaje + ($objPasajero->darPorcentajeIncremento() * $precioViaje);

                $sumaTotal = $this->get_suma_viajes_dinero() + $montoViaje;

                $this->set_suma_viajes_dinero($sumaTotal);

            }

            if ( get_class($objPasajero) == "pasajeroEspecial" && $this->buscarPasajeroEspecial($estaRegistrado) == -1  ){

                $pasajerosEspeciales[] = $objPasajero;

                $this->set_pasajeros_especiales ( $pasajerosEspeciales);

                $montoViaje = $montoViaje + $precioViaje + ($objPasajero->darPorcentajeIncremento() * $precioViaje);

                $sumaTotal = $this->get_suma_viajes_dinero() + $montoViaje;

                $this->set_suma_viajes_dinero($sumaTotal);

            }

            $cantNuevaPasajeros = count($this->get_pasajeros_especiales()) + count($this->get_pasajeros_estandars()) + count($this->get_pasajeros_vip());

            $this->set_cant_pasajeros($cantNuevaPasajeros);

        }

        return $montoViaje;

    }

/***************************************************************************************************************************************************************** */

public function modificarMonto(){


    $nuevoMonto = $this->get_precio_viaje();
    $pasajerosEspeciales = $this->get_pasajeros_especiales();
    $pasajerosEstandars = $this->get_pasajeros_estandars();
    $pasajerosVip = $this->get_pasajeros_vip();
    $nuevoTotalPasajesEsp = 0;
    $nuevoTotalPasajesEst = 0;
    $nuevoTotalPasajesVip = 0;

    for ( $i = 0; $i < count($pasajerosEspeciales) ; $i++){

        $nuevoTotalPasajesEsp = $nuevoTotalPasajesEsp + $nuevoMonto + ($pasajerosEspeciales[$i]->darPorcentajeIncremento() * $nuevoMonto);

    }

    for ( $i = 0; $i < count($pasajerosEstandars) ; $i++){

        $nuevoTotalPasajesEst = $nuevoTotalPasajesEst + $nuevoMonto + ($pasajerosEstandars[$i]->darPorcentajeIncremento() * $nuevoMonto);

    }

    for ( $i = 0; $i < count($pasajerosVip) ; $i++){

        $nuevoTotalPasajesVip = $nuevoTotalPasajesVip + $nuevoMonto + ($pasajerosVip[$i]->darPorcentajeIncremento() * $nuevoMonto);

    }

    $nuevoMonto = $nuevoTotalPasajesEsp + $nuevoTotalPasajesEst + $nuevoTotalPasajesVip;

    $this->set_suma_viajes_dinero($nuevoMonto);
    

}

/*********************************************************************************************************************************************************************************************/

    public function buscarAsiento($nroAsiento){

        $pasajerosEspeciales = $this->get_pasajeros_especiales();
        $pasajerosVip = $this->get_pasajeros_vip();
        $pasajerosEstandars = $this->get_pasajeros_estandars();

        $i = 0;

        $asientoOcupado = false;

        while($i < count($pasajerosEstandars) && !$asientoOcupado){
            $objPasajeroEstandar = $pasajerosEstandars[$i];

            if ( $objPasajeroEstandar->get_nro_asiento() == $nroAsiento ){

                $asientoOcupado = true;

            }

            $i++;
        }

        while ( $i < count($pasajerosVip) && !$asientoOcupado){
            $objPasajeroVip = $pasajerosVip[$i];

            if ( $objPasajeroVip->get_nro_asiento() == $nroAsiento){

                $asientoOcupado = true;

            }

            $i++;
        }

        while ( $i < count($pasajerosEspeciales) && !$asientoOcupado ){
            $objPasajeroEspecial = $pasajerosEspeciales[$i];

            if ( $objPasajeroEspecial->get_nro_asiento() == $nroAsiento){

                $asientoOcupado = true;

            }

            $i++;

        }

        return $asientoOcupado;

    }

/******************************************************************************************************************************************************************************************* */

public function mostrarPasajerosEstandars (){

    $losPasajerosEstandars = $this->get_pasajeros_estandars();
    $mostrarPasajerosEstandars = "";

    for ( $i = 0; $i < count($losPasajerosEstandars); $i++){
        $mostrarPasajerosEstandars = $mostrarPasajerosEstandars.$losPasajerosEstandars[$i];
    }

    return $mostrarPasajerosEstandars;

}

/************************************************************************************************************************* */

public function mostrarPasajerosVip (){

    $losPasajerosVip = $this->get_pasajeros_vip();
    $mostrarPasajerosVip = "";

    for ( $i = 0; $i < count($losPasajerosVip); $i++){
        $mostrarPasajerosVip = $mostrarPasajerosVip.$losPasajerosVip[$i];
    }

    return $mostrarPasajerosVip;

}

/************************************************************************************************************************* */

public function mostrarPasajerosEspeciales(){

    $losPasajerosEspeciales = $this->get_pasajeros_especiales();
    $mostrarPasajerosEspeciales = "";

    for ( $i = 0; $i < count($losPasajerosEspeciales); $i++){

        $mostrarPasajerosEspeciales = $mostrarPasajerosEspeciales.$losPasajerosEspeciales[$i];

    }

    return $mostrarPasajerosEspeciales;

}

/************************************************************************************************************************* */

public function mostrarResponsableViaje(){

    $losResponsables = $this->get_responsable_viaje();
    $mostrarResponsables = "";
    for( $i = 0; $i < count($losResponsables); $i++){
        $mostrarResponsables = $mostrarResponsables. $losResponsables[$i];
    }

    return $mostrarResponsables;

}

/************************************************************************************************************************* */


    public function __toString(){


        $losResponsables = $this->get_responsable_viaje();
        $mostrarResponsables = "";
        for( $i = 0; $i < count($losResponsables); $i++){
            $mostrarResponsables = $mostrarResponsables. $losResponsables[$i];
        }

        return
        "\n"."****************DATOS DEL VIAJE****************"."\n".
        "codijo del viaje: ". $this->get_codijo_viaje()."\n".
        "destino del viaje: ". $this->get_destino_viaje()."\n".
        "cantidad maxima de pasajeros: ". $this->get_cantMax_pasajeros()."\n".
        "cantidad de pasajeros: ". $this->get_cant_pasajeros()."\n".
        "precio del viaje: ". $this->get_precio_viaje()."\n".
        "suma de viajes vendidos al destino: ". $this->get_suma_viajes_dinero()."\n".
        "\n"."*************DATOS DE LOS PASAJEROS************* " ."\n"."\n".
        $this->mostrarPasajerosEstandars()."\n".
        $this->mostrarPasajerosVip()."\n".
        $this->mostrarPasajerosEspeciales()."\n".
        "\n"."*************DATOS DE LOS RESPONSABLES*************"."\n".
        $this->mostrarResponsableViaje()."\n";

    }

}



/*$pasajero = new pasajeroEstandar("exe","calderon",2332,323232,45,65757,0);
$pasajero->darPorcentajeIncremento();


$viajes = new viaje(2332,"rio",3,2,[],[],[],[],1500,0);
echo $pasajero->darPorcentajeIncremento();*/

