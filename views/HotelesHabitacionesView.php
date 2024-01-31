<?php

class HotelesHabitacionesView {

    // Muestra la lista de tareas
    public function showHotelsRooms($hoteles, $habitaciones) {

        echo '<h1 class="page__title">Todos los hoteles encontrados:</h1>';
        echo '<div class="hotelContainer">';

        foreach ($hoteles as $hotel) {
            //Transform the image to be capable of show it
            $img = $hotel->getFotoBase64();

            $checkImg = false;
        
            if($img === 'views/assets/images/noPhoto.jpg'){
                $checkImg = true;
            }
        
            echo '  <div class="cardCont ">
             '.($checkImg ? '<img src="' . $img . '" class="card__img" alt="...">' : '<img src="data:image/jpeg;base64,' . $img . '" class="card__img" alt="...">').
                        '<div class="card__body">
                            <h2 class="card-title">' . $hotel->getNombre() . '</h2>
                            <h3 class="direction">'. $hotel->getDireccion().' - '. $hotel->getCiudad().' - '. $hotel->getPais().'</h3>
                            <p class="card-text">' . $hotel->getDescripcion() . '</p>
                            <p class="reserv__subt">Habitaciones:</p>
';
            foreach ($habitaciones as $habitacion) {
                if ($habitacion->getIdHotel() === $hotel->getId()) {
                    echo '<p>' . $habitacion->getNumHabitacion().' - '. $habitacion->getDescripcion() . '</p>';
                }
            }
            echo ' 
                <form action="'.$_SERVER['PHP_SELF'].'?controller=HotelesHabitaciones&action=showHotelAndRooms" method="POST">
                    <input type="hidden" name="idHotel" value="'.$hotel->getId().'">
                    <input class="button smallButton" type="submit" name="sub" value="Ver habitaciones.">
                </form>
                        </div>
                    </div>';
        }

        echo '</div>';
    }
    
    public function noDataShowHotelRooms($hotel, $habitaciones) {
        $this->showMessage('Has de escoger una habitación para hacer una reserva.');
        $this->showHotelsRooms($hotel, $habitaciones);
    }
    
    public function showHotelAndRooms($hotel, $habitaciones) {
        echo '<h1 class="page__title">Que habitación quieres reservar.</h1>';
        echo '<div class="hotelContainer">';
            
        //Transform the image to be capable of showing it
        $img = $hotel->getFotoBase64();
        
        $checkImg = false;
        
        if($img === 'views/assets/images/noPhoto.jpg'){
            $checkImg = true;
        }
        
        echo '<div class="cardCont ">
             '.($checkImg ? '<img src="' . $img . '" class="card__img" alt="...">' : '<img src="data:image/jpeg;base64,' . $img . '" class="card__img" alt="...">').
                    '<div class="card__body">
                        <h2 class="card-title">' . $hotel->getNombre() . '</h2>
                        <h3 class="direction">'. $hotel->getDireccion().' - '. $hotel->getCiudad().' - '. $hotel->getPais().'</h3>
                        <p class="card-text">' . $hotel->getDescripcion() . '</p>
                        <p class="reserv__subt">Habitaciones:</p>
                ';

                        foreach ($habitaciones as $habitacion) {
                            if ($habitacion->getIdHotel() === $hotel->getId()) {
                                echo '<form class="formulario mt-5" method="POST" action="'. $_SERVER['PHP_SELF'] .'?controller=ReservasHabitaciones&action=formReservas">  
                                    '. $habitacion->getTypeIcon($habitacion->getTipo() ) .'
                                    <p>' . $habitacion->getNumHabitacion().' - '. $habitacion->getDescripcion(). '</p>
                                    <p>'. $habitacion->getPrecio().'€</p>
                                    <input type="hidden" value="'.$habitacion->getId().'" name="habitacionId">
                                    <input class="button smallButton " type="submit" value="Reservar">
                                </form>';
                            }
                        }
        echo '</div></div></div>'; // Cierre de los divs
    }
    
    /**
     * Function to show a message
     * 
     * @param String $errorMsg <p>Message you want to show</p>
     * @param String $type <p>Type of the message</p>
     * @param String $img <p>image you want to show</p>
     */
    public function showMessage($errorMsg, $type="normal", $img=null) {
        
        echo '<div class="message '.$type.'">'.$errorMsg.'</div>';

    }
}

