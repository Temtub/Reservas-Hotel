<?php

/**
 * View to show info about the Reservas, Hotel and Habitacion
 */
class ReservasHabitacionesHotelesView {

    /**
     * Function to show a reserva
     * @param type $habitacion <p>Habitacion of the reserva</p>
     * @param type $hotel <p>Hotel of the reserva</p>
     * @param type $reserva <p>Reserva of the reserva</p>
     */
    public function showReserva($habitacion, $hotel, $reserva) {
        
        $img = $hotel->getFotoBase64();
        
        $checkImg = false;
        
        if($img === 'views/assets/images/noPhoto.jpg'){
            $checkImg = true;
        }
        echo '<div class="reserv">

             '.($checkImg ? '<img src="' . $img . '" class="card__img" alt="...">' : '<img src="data:image/jpeg;base64,' . $img . '" class="card__img" alt="...">').

            '<div class="reserv__body">
                <h2>'.$hotel->getNombre().'</h2>
                <p>'.$hotel->getDescripcion().'</p>
                <p>'.$habitacion->getDescripcion().' - '.$habitacion->getPrecio() .'€</p>
                <p> '.$reserva->getFechaEntrada().' - '.$reserva->getFechaSalida().'</p>
            </div>
        </div> ';
        
    }
    
    /**
     * Function to show an error
     * @param String $msg <p>Message you want to show</p>
     */
    public function showMessage($msg) {
        echo '<div>'.$msg.'</div>';
    }

}

        