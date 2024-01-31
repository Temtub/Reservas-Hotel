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
                <p class="reserv__subt">Habitacion:</p>
                <p>'.$habitacion->getDescripcion().' - '.$habitacion->getPrecio() .'€</p>
                <p class="reserv__subt">Fecha:</p>
                <p> '.$reserva->getFechaEntrada().'  <span class="reserv__subt">al</span>  '.$reserva->getFechaSalida().'</p>
            </div>
        </div> ';
        
    }
    
    /**
     * Function to show the title 
     */
    public function introPage() {
        echo '<h1 class="page__title">Estas son tus reservas:</h1>';
        
    }
    
    
    /**
     * Function to show a message
     * 
     * @param String $errorMsg <p>Message you want to show</p>
     * @param String $type <p>Type of the message</p>
     * @param String $img <p>image you want to show</p>
     */
    public function showMessage($errorMsg, $type="normal", $img=false) {
        
        echo '<div class="message '.$type.'">'.$errorMsg.'</div>';
        
        if(!$img){
            return;
        }
        echo ($img ? '<img src="/Reservas-Hotel/views/assets/images/' . $img . '"/>' : null);
    }

}

        