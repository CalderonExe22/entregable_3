<?php

/*Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos nombre, apellido, numero de documento y teléfono.
El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero. También se desea guardar la información de la persona 
responsable de realizar el viaje, para ello cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido.
La clase Viaje debe hacer referencia al responsable de realizar el viaje.

Volver a implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero. Luego implementar la operación que agrega los pasajeros al viaje, 
solicitando por consola la información de los mismos. Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. De la misma forma cargue la información del
responsable del viaje.

Nota: Recuerden que deben enviar el link a la resolución en su repositorio en GitHub.*/

class responsableV{

    private $nombreR;
    private $apellidoR;
    private $nroEmpleadoResponsable;
    private $nroLicencia;

    public function __construct($nombreR,$apellidoR,$nroEmpleadoResponsable,$nroLicencia){

        $this->nombreR = $nombreR;
        $this->apellidoR = $apellidoR;
        $this->nroEmpleadoResponsable = $nroEmpleadoResponsable ;
        $this->nroLicencia = $nroLicencia;
    }

    /********************************metodos get de la clase**************************** */
    public function get_nombre_responsable ( ){
        return $this->nombreR;
    }

    public function get_apellido_responsable ( ){
        return$this->apellidoR;
    }

    public function get_nroEmpleado_responsable ( ){
        return $this->nroEmpleadoResponsable;
    }

    public function get_nroLicencia_responsable ( ){
        return $this->nroLicencia;
    }

    /*************************metodos set de la clase*************************************** */

    public function set_nombre_responsable ($nombre){
        $this->nombreR = $nombre;
    }

    public function set_apellido_responsable ( $apellido ){
        $this->apellidoR = $apellido;
    }

    public function set_nroEmpleado_responsable ( $nroEmpleadoResponsable){
        $this->nroEmpleadoResponsable = $nroEmpleadoResponsable;
    }

    public function set_nroLicencia_responsable( $nroLicencia){
        $this->nroLicencia = $nroLicencia;
    }

/****************************************************************************** */

    public function __toString(){
        return 
        "nombre del responsable del viaje: ". $this->get_nombre_responsable()."\n".
        "apellido del responsable del viaje: ". $this->get_apellido_responsable()."\n".
        "numero de empleado del responsable del viaje: ". $this->get_nroEmpleado_responsable()."\n".
        "numero de licencia del responsable del viaje: ". $this->get_nroLicencia_responsable()."\n";
    }


}