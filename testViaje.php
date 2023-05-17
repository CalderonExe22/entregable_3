<?php


include_once("claseVerificacion.php");
include_once("claseResponsable.php");
include_once("clasePasajero.php");
include_once("clasePasajeroVip.php");
include_once("clasePasajeroEstandar.php");
include_once("clasePasajeroEspeciales.php");
include_once("claseViaje.php");


/*PROGRAMA VIAJE FELIZ*/
/*muestra un menu de opciones que nos permine agregar, modificar y visualizar los datos tanto de un viaje ingresado o un pasajero*/

/* int $opcion, int $elCodijo,$laCantMaxPasajeros, $laCantPasajeros, $modificador, $nuevoCodViaje, $nroPersona, $laOpcion,$laOpcion2,$laOpcion3,
$modificadorPers,$numeroDoc,$nuevaCantMaxPasaj,$nuevaCantPasaj.$nuevoDni,$elDniPasajero
string $elDestino, $nuevoDestino,  $nuevoNombre,$nuevoApellido  ,$elApellidoPasajero,$elNOmbrePasajeros
obj $datosViajes,  $verificador$pasajeros, $responsable*/ 


/* instanciamos la clase pasajeros con dos pasajeros dentro de la coleccion $pasajeros*/

$pasajerosEstandars =[];
$pasajerosVip = [];
$pasajerosEspeciales = [];
    
/**************************************************************************************/

$verificar = new verificacion();//instancia clase que verifica si es integ y string

echo "\n"."Ingrese el codigo del viaje: ";
$elCodijo = $verificar->soloInteg();/* para solo ingresar un valor tipo integ*/

echo "\n"."Ingrese el destino del viaje: ";

$elDestino = $verificar->esString();/*valida que sea un string*/

echo "\n"."Ingrese cantidad maxima de pasajeros a bordo: ";
$laCantMaxPasajeros = trim(fgets(STDIN));

/*instruccion para que el valor solo sea del tipo string y sea mayor a cero*/

while(is_numeric($laCantMaxPasajeros) && $laCantMaxPasajeros <= 0){
    echo "ingrese  un numero mayor a 0: ";
    $laCantMaxPasajeros = trim(fgets(STDIN));
    
}

$laCantPasajeros = count($pasajerosEstandars) + count($pasajerosEspeciales) + count($pasajerosVip);/*indicamos la cantidad de pasajeros con un count*/

echo "\n"."ingrese el precio del viaje: ";
$elPrecioViaje = $verificar->soloInteg();

echo "\n"."INGRESE DATOS DEL RESPONSABLE DEL VIAJE: "."\n";

echo "\n"."ingrese nombre del responsable: ";
$nombreR = $verificar->esString();
echo "\n"."ingrese apellido del responsable: ";
$apellidoR = $verificar->esString();
echo "\n"."ingrese nro de empleado del responsable: ";
$nroEmpleadoR = $verificar->soloInteg();
echo "\n"."ingrese nro de licencia del responsable: ";
$nroLicenciaR =  $verificar->soloInteg();

$responsable = [new responsableV ( $nombreR,$apellidoR,$nroEmpleadoR,$nroLicenciaR),];/*instanciamos la coleccion de objetos con los datos de los responsables del viaje*/

$datosViajes = new viaje($elCodijo,$elDestino,$laCantMaxPasajeros,$laCantPasajeros,$pasajerosEstandars,$pasajerosVip,$pasajerosEspeciales,$responsable,$elPrecioViaje,0);/*instanciar objeto datos agregados de un viaje, el atributo suma de viajes vendidos es 0 porque no se an vendido pasajes*/

do{
    
    echo "\n"."HOLA BIENVENIDO AL PROGRAMA "."\n";
    echo "1) Modificar datos de pasajeros."."\n";
    echo "2) vender ticket de viaje a un pasajero."."\n";
    echo "3) Modificar responsable del viaje."."\n";
    echo "4) Agregar otro responsable."."\n";
    echo "5) Modificar datos de viajes."."\n";
    echo "6) mostrar datos de viaje y pasajeros."."\n";
    echo "7) salir."."\n";
    echo "\n"."Ingrese alguna de las siguientes opciones: ";

    $opcion=trim(fgets(STDIN));

    /*esta instruccion evalua que el valor ingresado no sea un string y sea solamente un numero de las opciones*/
    while (!is_int($opcion) && !($opcion >= 1 && $opcion <= 7)) {
        echo "Debe ingresar un número entre 1 y 7: ";
        $opcion = trim(fgets(STDIN));
    }

    switch($opcion){
        
        case 1:
 
            echo "\n". "(1) Modificar datos de pasajero estandar."."\n";
            echo "\n". "(2) Modificar datos pasajero vip."."\n";
            echo "\n". "(3) Modificar datos pasajero especial."."\n";
            echo "\n". "(4) Salir."."\n";
            echo "INGRESE SU ELECCION; ";

            $opcion2 = trim(fgets(STDIN));

            while (!is_int($opcion2) && !($opcion2 >= 1 && $opcion2 <= 4)) {
                echo "Debe ingresar un número entre 1 y 4: ";
                $opcion2 = trim(fgets(STDIN));
            }
            
            switch($opcion2){
                case 1:
                    echo "\n"."Ingrese el numero de documento de la persona a modificar: ";

                    $numeroDoc = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

                    echo "\n"."ingrese el nuevo nombre de la persona: ";
                        
                    $nuevoNombre = $verificar->esString();//metodo verifica que el valor sea solo tipo string

                    echo "\n"."ingrese el nuevo apellido de la persona: ";
                            
                    $nuevoApellido = $verificar->esString();//metodo verifica que el valor sea solo tipo string

                    echo "\n"."ingrese el nuevo numero de documento de la persona: ";
                    $nuevoDni = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

                    echo  "\n"."ingrese nuevo numero de telefono:";
                    $nuevoTelefono = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

                    echo "\n". "ingrese nuevo nro de asiento: ";
                    $nuevoNroAsiento = $verificar->soloInteg();

                    echo "\n". "ingrese nuevo nro de ticket: ";
                    $nuevoNroTicket = $verificar->soloInteg();

                    $modificacion = $datosViajes->modificarPasajeroEstandar($nuevoNombre,$nuevoApellido,$nuevoDni,$nuevoTelefono,$nuevoNroAsiento,$nuevoNroTicket,$numeroDoc); //retornara el indice donde se encuentra el pasajero dentro de la coleccion de pasajeros

                    //usamos un una instruccion if para verificar si la modificacion se concreto o no
                    if ( $modificacion >= 0 ){                         
                                                            
                        echo "\n"."modificacion exitosa."."\n";
        
                    }else{
                        echo "no se encontro al pasajero."."\n";
                    }

                    break;

                case 2:

                    echo "\n"."Ingrese el numero de documento de la persona a modificar: ";

                    $numeroDoc = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

                    echo "\n"."ingrese el nuevo nombre de la persona: ";
                        
                    $nuevoNombre = $verificar->esString();//metodo verifica que el valor sea solo tipo string

                    echo "\n"."ingrese el nuevo apellido de la persona: ";
                            
                    $nuevoApellido = $verificar->esString();//metodo verifica que el valor sea solo tipo string

                    echo "\n"."ingrese el nuevo numero de documento de la persona: ";
                    $nuevoDni = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

                    echo  "\n"."ingrese nuevo numero de telefono:";
                    $nuevoTelefono = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

                    echo "\n". "ingrese nuevo nro de asiento: ";
                    $nuevoNroAsiento = $verificar->soloInteg();

                    echo "\n". "ingrese nuevo nro de ticket: ";
                    $nuevoNroTicket = $verificar->soloInteg();

                    echo "\n". "ingrese nuevo nro de viajero recurrente: ";
                    $nuevoNroViajeroRecurrente = $verificar->soloInteg();

                    echo "desea modificar cantidad de millas del pasajero? esto puede modificar el precio del pasaje"."\n";

                    echo "(1) si."."\n";
                    echo "(2) no."."\n";
                    echo "INGRESE SU ELECCION: ";

                    $modificarPrecioVip = trim(fgets(STDIN));

                    while (!is_int(  $modificarPrecioVip) && !(  $modificarPrecioVip >= 1 &&  $modificarPrecioVip <= 2)) {
                        echo "Debe ingresar un número entre 1 y 2: ";
                        $modificarPrecioVip = trim(fgets(STDIN));
                    }

                    if (  $modificarPrecioVip == 1){

                        echo "\n". "ingrese nueva cantidad de millas del pasajero: ";
                        $nuevaCantMillas = $verificar->soloInteg();

                        $anteriorespasajerosVip = $datosViajes->get_pasajeros_vip();
                        $indicePasajeroVip = $datosViajes->buscarPasajeroVip($numeroDoc);

                        if ( $indicePasajeroVip >= 0){

                            $anteriorObjPasajeroVip = $anteriorespasajerosVip[$indicePasajeroVip];
                            $precioPasajeAnt = $datosViajes->get_precio_viaje() + $anteriorObjPasajeroVip->darPorcentajeIncremento() * $datosViajes->get_precio_viaje();

                        }
                    

                        $modificacion = $datosViajes->modificarPasajeroVip($nuevoNombre,$nuevoApellido,$nuevoDni,$nuevoTelefono,$nuevoNroAsiento,$nuevoNroTicket,$nuevoNroViajeroRecurrente,$nuevaCantMillas,$numeroDoc); //retornara el indice donde se encuentra el pasajero dentro de la coleccion de pasajeros

                        

                        //usamos un una instruccion if para verificar si la modificacion se concreto o no
                        if ( $modificacion >= 0 ){        

                            $nuevoPasajerosVip = $datosViajes->get_pasajeros_vip();
                            $nuevoObjPasajeroVip = $nuevoPasajerosVip [$modificacion];
                            $nuevoPrecioPasajeAnt = $datosViajes->get_precio_viaje() + $nuevoObjPasajeroVip->darPorcentajeIncremento() * $datosViajes->get_precio_viaje();
                            $restamosPrecioAnt = $datosViajes->get_suma_viajes_dinero() - $precioPasajeAnt;
                            $sumamosNuevoPrecio = $restamosPrecioAnt + $nuevoPrecioPasajeAnt;
                            $datosViajes->set_suma_viajes_dinero($sumamosNuevoPrecio);
                                                                
                            echo "\n"."modificacion exitosa."."\n";
            
                        }else{
                           echo "no se encontro al pasajero."."\n";
                        }

                    }


                    break;

                case 3:

                    echo "\n"."Ingrese el numero de documento de la persona a modificar: ";

                    $numeroDoc = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

                    echo "\n"."ingrese el nuevo nombre de la persona: ";
                        
                    $nuevoNombre = $verificar->esString();//metodo verifica que el valor sea solo tipo string

                    echo "\n"."ingrese el nuevo apellido de la persona: ";
                            
                    $nuevoApellido = $verificar->esString();//metodo verifica que el valor sea solo tipo string

                    echo "\n"."ingrese el nuevo numero de documento de la persona: ";
                    $nuevoDni = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

                    echo  "\n"."ingrese nuevo numero de telefono:";
                    $nuevoTelefono = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

                    echo "\n". "ingrese nuevo nro de asiento: ";
                    $nuevoNroAsiento = $verificar->soloInteg();

                    echo "\n". "ingrese nuevo nro de ticket: ";
                    $nuevoNroTicket = $verificar->soloInteg();

                    echo "\n". "desea modificar los datos de asistencia,silla de ruedas y comidas especiales del pasajero? esto puede modificar el precio del pasaje."."\n";
                    echo "(1) si."."\n";
                    echo "(2) no."."\n";
                    echo "INGRESE SU ELECCION: ";
                    $modificarPrecioEsp = trim(fgets(STDIN));

                    while (!is_int( $modificarPrecioEsp) && !( $modificarPrecioEsp >= 1 && $modificarPrecioEsp <= 2)) {
                        echo "Debe ingresar un número entre 1 y 2: ";
                        $modificarPrecioEsp = trim(fgets(STDIN));
                    }

                    if ( $modificarPrecioEsp == 1){

                        echo "posee silla de ruedas? (si/no)";
                        $nuevoPoseeSillaDeRuedas = $verificar->esString();
                        echo "nesecita asistencia de algun tipo?(si/no)";
                        $nuevoAsistencia = $verificar->esString();
                        echo "comidas especiales o alergico a algun ingrediente?(si/no)";
                        $nuevoComidasEspeciales = $verificar->esString();

                        $anteriorespasajerosEsp = $datosViajes->get_pasajeros_especiales();
                        $indicePasajeroEsp = $datosViajes->buscarPasajeroEspecial($numeroDoc);

                        if ( $indicePasajeroEsp >= 0){

                            $anteriorObjPasajeroEsp = $anteriorespasajerosEsp[$indicePasajeroEsp];
                            $precioPasajeAnt = $datosViajes->get_precio_viaje() + $anteriorObjPasajeroEsp->darPorcentajeIncremento() * $datosViajes->get_precio_viaje();

                        }
                   
                        $modificacion = $datosViajes->modificarPasajeroEspecial($nuevoNombre,$nuevoApellido,$nuevoDni,$nuevoTelefono,$nuevoNroAsiento,$nuevoNroTicket,$nuevoPoseeSillaDeRuedas,$nuevoAsistencia,$nuevoComidasEspeciales,$numeroDoc); //retornara el indice donde se encuentra el pasajero dentro de la coleccion de pasajeros

                        //usamos un una instruccion if para verificar si la modificacion se concreto o no
                        if ( $modificacion >= 0 ){        

                            $nuevoPasajerosEsp = $datosViajes->get_pasajeros_especiales();
                            $nuevoObjPasajeroEsp = $nuevoPasajerosEsp [$modificacion];
                            $nuevoPrecioPasajeAnt = $datosViajes->get_precio_viaje() + $nuevoObjPasajeroEsp->darPorcentajeIncremento() * $datosViajes->get_precio_viaje();
                            $restamosPrecioAnt = $datosViajes->get_suma_viajes_dinero() - $precioPasajeAnt;
                            $sumamosNuevoPrecio = $restamosPrecioAnt + $nuevoPrecioPasajeAnt;
                            $datosViajes->set_suma_viajes_dinero($sumamosNuevoPrecio);
                                                            
                            echo "\n"."modificacion exitosa."."\n";
        
                        }else{
                            echo "no se encontro al pasajero."."\n";
                        }

                    }


                break;

            }

            break;

        case 2:

            echo "(1) Vender pasaje estandar."."\n";
            echo "(2) vender pasaje vip."."\n";
            echo "(3) vender pasaje especial."."\n";
            echo "(4) salir."."\n";
            echo "INGRESE ALGUNA OPCION: ";

            $opcion3 = trim(fgets(STDIN));

            while (!is_int($opcion3) && !($opcion3 >= 1 && $opcion3 <= 4)) {
                echo "Debe ingresar un número entre 1 y 4: ";
                $opcion3 = trim(fgets(STDIN));
            }

            switch($opcion3){

                case 1:

                    echo "\n" ."ingrese nombre del pasajero: ";
                    $nombre = $verificar->esString();
                    echo "ingrese apellido del pasajero: ";
                    $apellido = $verificar->esString();
                    echo "ingrese nro de documento: ";
                    $dni = $verificar->soloInteg();
                    echo "ingrese numero de telefono: ";
                    $telefono = $verificar->soloInteg();
                    echo "ingrese nro de asiento: ";
                    $nroAsiento = $verificar->soloInteg();

                    while ( $datosViajes->buscarAsiento($nroAsiento)){
                        echo "asiento ocupado, ingrese otro"."\n"; 
                        $nroAsiento = $verificar->soloInteg();
                    }

                    echo "ingrese nroTicket: ";
                    $nroTicket = $verificar->soloInteg();
                    
                    //instanciamos el objeto del nuevo pasajero con los datos ingresado por consola
                    $objPasajeroAgregarEst = new pasajeroEstandar ( $nombre,$apellido,$dni,$telefono,$nroAsiento,$nroTicket,0);
                    $objPasajeroAgregarEst->darPorcentajeIncremento();
                    
                    $agregarPasajero = $datosViajes->venderPasaje($objPasajeroAgregarEst);//metodo retorna un indice o -1 si no encontro indice en la coleccion de los pasajeros
                    
                    //con la instruccion if, verificamos si se pudo agregar al nuevo pasajero( el metodo agregarPasajero retorna -1 si el pasajero no se encuentra dentro de la coleccion)
                    //por lo tanto si no esta en la lista se agregara al pasajero, y se retorna un indice de pasajero entonce no se agregara
                    if ( $agregarPasajero > 0 ){
                        echo "se agrego correctamente."."\n";
                    }else{
                        echo "ya se encuentra registrado o no hay lugares disponibles"."\n";
                    }           

                    break;

                case 2:

                    echo "\n" ."ingrese nombre del pasajero: ";
                    $nombre = $verificar->esString();
                    echo "ingrese apellido del pasajero: ";
                    $apellido = $verificar->esString();
                    echo "ingrese nro de documento: ";
                    $dni = $verificar->soloInteg();
                    echo "ingrese numero de telefono: ";
                    $telefono = $verificar->soloInteg();
                    echo "ingrese nro de asiento: ";
                    $nroAsiento = $verificar->soloInteg();

                    while ( $datosViajes->buscarAsiento($nroAsiento)){
                        echo "asiento ocupado, ingrese otro"."\n"; 
                        $nroAsiento = $verificar->soloInteg();
                    }

                    echo "ingrese nroTicket: ";
                    $nroTicket = $verificar->soloInteg();
                    echo "ingrese nro de viajero concurrente: ";
                    $nroViajeroRecurrente = $verificar->soloInteg();
                    echo "ingrese cantidad de millas del pasajero: ";
                    $cantMillas = $verificar->soloInteg();
                    
                    //instanciamos el objeto del nuevo pasajero con los datos ingresado por consola

                    $objPasajeroAgregarVip = new pasajeroVip ( $nombre,$apellido,$dni,$telefono,$nroAsiento,$nroTicket,$nroViajeroRecurrente,$cantMillas,0);

                    $objPasajeroAgregarVip->darPorcentajeIncremento();
                    
                    $agregarPasajero = $datosViajes->venderPasaje($objPasajeroAgregarVip);//metodo retorna un indice o -1 si no encontro indice en la coleccion de los pasajeros
                    
                    //con la instruccion if, verificamos si se pudo agregar al nuevo pasajero( el metodo agregarPasajero retorna -1 si el pasajero no se encuentra dentro de la coleccion)
                    //por lo tanto si no esta en la lista se agregara al pasajero, y se retorna un indice de pasajero entonce no se agregara
                    if ( $agregarPasajero > 0 ){
                        echo "se agrego correctamente."."\n";
                    }else{
                        echo "ya se encuentra registrado o no hay lugares disponibles"."\n";
                    }           

                    break;

                case 3:

                    echo "\n" ."ingrese nombre del pasajero: ";
                    $nombre = $verificar->esString();
                    echo "ingrese apellido del pasajero: ";
                    $apellido = $verificar->esString();
                    echo "ingrese nro de documento: ";
                    $dni = $verificar->soloInteg();
                    echo "ingrese numero de telefono: ";
                    $telefono = $verificar->soloInteg();
                    echo "ingrese nro de asiento: ";
                    $nroAsiento = $verificar->soloInteg();

                    while ( $datosViajes->buscarAsiento($nroAsiento)){
                        echo "asiento ocupado, ingrese otro"."\n"; 
                        $nroAsiento = $verificar->soloInteg();
                    }

                    echo "ingrese nroTicket: ";
                    $nroTicket = $verificar->soloInteg();
                    echo "posee silla de ruedas?(si/no): ";
                    $poseeSillaDeRuedas = $verificar->esString();
                    echo "necesita asistencia de algun tipo?(si/no): ";
                    $asistencia = $verificar->esString();
                    echo "comidas especiales o es alergico algun alimento?(si/no): ";
                    $comidasEspeciales = $verificar->esString();

                    //instanciamos el objeto del nuevo pasajero con los datos ingresado por consola

                    $objPasajeroAgregarEspecial = new pasajeroEspecial ( $nombre,$apellido,$dni,$telefono,$nroAsiento,$nroTicket,$poseeSillaDeRuedas,$asistencia,$comidasEspeciales,0);
                    $objPasajeroAgregarEspecial->darPorcentajeIncremento();
                    
                    $agregarPasajero = $datosViajes->venderPasaje($objPasajeroAgregarEspecial);//metodo retorna un indice o -1 si no encontro indice en la coleccion de los pasajeros
                    
                    //con la instruccion if, verificamos si se pudo agregar al nuevo pasajero( el metodo agregarPasajero retorna -1 si el pasajero no se encuentra dentro de la coleccion)
                    //por lo tanto si no esta en la lista se agregara al pasajero, y se retorna un indice de pasajero entonce no se agregara
                    if ( $agregarPasajero > 0 ){
                        echo "se agrego correctamente."."\n";
                    }else{
                        echo "ya se encuentra registrado o no hay lugares disponibles"."\n";
                    }           

                break;
            }
            break;
        case 3:

            echo "\n"."Ingrese el numero de empleado del responsable a modificar: ";

            $numeroEmpleado = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

            echo "\n"."ingrese el nuevo nombre del responsable: ";
                   
            $nuevoNombre = $verificar->esString();//metodo verifica que el valor sea solo tipo string

            echo "\n"."ingrese el nuevo apellido del responsable: ";
                    
            $nuevoApellido = $verificar->esString();//metodo verifica que el valor sea solo tipo string

            echo "\n"."ingrese el nuevo numero de licencia del responsable: ";
            $nuevoNroLicencia = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

            echo  "\n"."ingrese nuevo numero de empleado del responsable:";
            $nuevoNroEmpleado = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

            $modificacion = $datosViajes->modificarResponsable($nuevoNroEmpleado,$nuevoNroLicencia,$nuevoNombre,$nuevoApellido,$numeroEmpleado); //retornara el indice donde se encuentra el pasajero dentro de la coleccion de pasajeros

            //usamos un una instruccion if para verificar si la modificacion se concreto o no

            if ( $modificacion >= 0 ){                         
                                                    
                echo "\n"."modificacion exitosa."."\n";
   
            }else{
                echo "no se encontro al responsable del viaje."."\n";
            }

            break;


        case 4:

            echo "\n" ."ingrese nombre del responsable: ";
            $nombre = $verificar->esString();
            echo "ingrese apellido del responsable: ";
            $apellido = $verificar->esString();
            echo "ingrese nro de empleado del responsable: ";
            $nroEmpleadoR = $verificar->soloInteg();
            echo "ingrese numero de licencia del responsable: ";
            $nroLicenciaR = $verificar->soloInteg();
            
            //instanciamos el objeto del nuevo pasajero con los datos ingresado por consola
            $objResponsableAgregar = new responsableV ( $nombre,$apellido,$nroEmpleadoR,$nroLicenciaR);
            
            $agregarResponsable = $datosViajes->agregarResponsable($objResponsableAgregar);//metodo retorna un indice o -1 si no encontro indice en la coleccion de los pasajeros

            $contador = $datosViajes->get_responsable_viaje ();
            
            //con la instruccion if, verificamos si se pudo agregar al nuevo pasajero( el metodo agregarPasajero retorna -1 si el pasajero no se encuentra dentro de la coleccion)
            //por lo tanto si no esta en la lista se agregara al pasajero, y se retorna un indice de pasajero entonce no se agregara
            if ( $agregarResponsable == -1 ){
                echo "se agrego correctamente."."\n";
            }else{
                echo "ya se encuentra registrado"."\n";
            }           

            break;

        case 5:

            echo "\n"."Ingrese el nuevo codigo de viaje: ";

            $nuevoCodViaje = $verificar->soloInteg();
           
            $datosViajes->set_codijo_viaje($nuevoCodViaje);//se usa el metodo set para actualizar los datos

            echo "\n"."Ingrese el nuevo destino del viaje: ";
                    
            $nuevoDestino =$verificar-> esString();

            $datosViajes->set_destino_viaje($nuevoDestino);//se usa el metodo set para actualizar los datos
                    

            echo "\n"."Ingrese una nueva cantidad maxima de pasajeros: ";
            $nuevaCantMaxPasaj = trim(fgets(STDIN));
            while(is_numeric($nuevaCantMaxPasaj) && !($nuevaCantMaxPasaj > $datosViajes->get_cant_pasajeros())){
                echo "ingrese  un numero mayor a ".$datosViajes->get_cant_pasajeros().": ";
                $nuevaCantMaxPasaj = trim(fgets(STDIN));     
            }

            $datosViajes->set_cantMax_pasajeros($nuevaCantMaxPasaj);//se usa el metodo set para actualizar los datos

            $nuevaCantPasaj = count($datosViajes->get_pasajeros_estandars ()) + count($datosViajes->get_pasajeros_vip())+ count($datosViajes->get_pasajeros_especiales());

            $datosViajes->set_cant_pasajeros ($nuevaCantPasaj);//se usa el metodo set para actualizar los datos

            echo "desea ingresar un nuevo precio de pasaje? si hace esto el precio de los pasajes se modificara."."\n";
            echo "(1) si."."\n";
            echo "(2) no."."\n";
            echo "INGRESE SU ELECCION: ";
            $modificarPrecio = trim(fgets(STDIN));

            while (!is_int( $modificarPrecio) && !( $modificarPrecio >= 1 && $modificarPrecio <= 2)) {
                echo "Debe ingresar un número entre 1 y 2: ";
                $modificarPrecio = trim(fgets(STDIN));
            }

            if ( $modificarPrecio == 1){

                echo "ingrese nuevo precio del viaje: ";
                $nuevoPrecioViaje = $verificar->soloInteg();
                $datosViajes->set_presio_viaje($nuevoPrecioViaje);
                $datosViajes->modificarMonto();

            } 
                    
            break;

        case 6: 

                echo $datosViajes;/*metodo __toString*/

        break;
    }


}while($opcion != 7);
