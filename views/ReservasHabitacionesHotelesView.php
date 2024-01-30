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
        echo '<div class="hotelContainer">

            <img class="'.$img.'" src="asd" alt="">

            <div class="reserv__body">
                <h2>'.$hotel->getNombre().'</h2>
                <p>'.$hotel->getDescripcion().'</p>
                <p>'.$habitacion->getDescripcion().' - '.$habitacion->getPrecio() .'</p>
                <p> '.$reserva->getFechaEntrada().' - '.$reserva->getFechaSalida().'</p>
            </div>
        </div>';
        
    }
    
    /**
     * Function to show an error
     * @param String $msg <p>Message you want to show</p>
     */
    public function showMessage($msg) {
        echo '<div>'.$msg.'</div>';
    }

}

        