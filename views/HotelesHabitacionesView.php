<?php

class HotelesHabitacionesView {

    // Muestra la lista de tareas
    public function showHotelsRooms($hoteles, $habitaciones) {

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
                            ';
            foreach ($habitaciones as $habitacion) {
                if ($habitacion->getIdHotel() === $hotel->getId()) {
                    echo '<p>' . $habitacion->getNumHabitacion().' - '. $habitacion->getDescripcion() . '</p>';
                }
            }
            echo ' 
                <form action="'.$_SERVER['PHP_SELF'].'?controller=HotelesHabitaciones&action=showHotelAndRooms" method="POST">
                    <input type="hidden" name="idHotel" value="'.$hotel->getId().'">
                    <input class="button smallButton" type="submit" name="sub" value="Ver habitaciones">
                </form>
                        </div>
                    </div>';
        }

        echo '</div>';
    }
    
    public function noDataShowHotelRooms($hotel, $habitaciones) {
        
        echo '<div>Has de escoger una habitación para hacer una reserva.</div>';
        $this->showHotelsRooms($hotel, $habitaciones);
    }
    
    public function showHotelAndRooms($hotel, $habitaciones) {
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
                        <p class="card-text">' . $hotel->getDescripcion() . '</p>';

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
    
    
    
    public function showErrorPage($param) {
        echo '<h1>Error: '.$param.'</h1>';
    }
    
    public function showMessage($msg) {
        echo '<div>'.$msg.'</div>';
    }
}

