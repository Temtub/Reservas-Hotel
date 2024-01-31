<?php

class ReservasHabitacionesView {

    
    /**
     * Function to show the form to make a Reserva
     * @param Integer $id <p>Id of the room you want to show, its necessary if it is not passed by post</p>
     * @param String $entrada <p>Variable that says if the entering date is wrong</p>
     * @param String $salida <p>Variable that says if the exiting date is wrong</p>
     * @param Bool $wrongDate <p>Variable that says if the date is wrong</p>
     */
    public function showFormReservas($habitacion, $entrada = false, $salida = false, $wrongDate = false) {
        echo '<h1 class="page__title">Quieres alquilar la habitacion ' . $habitacion->getNumHabitacion() . ':</h1>
               <div class="reservasFormCont">
        ';

        if ($entrada === "true") {
            $this->showMessage('Rellena la fecha de entrada.', 'error');
        }

        if ($salida === "true") {
            $this->showMessage('Rellena la fecha de salida.', 'error');
        }

        if ($wrongDate === "true") {
            $this->showMessage('La entrada no puede ser antes que la salida.', 'error');
        }

        echo '<form class="d-flex flex-column align-items-start form" method="POST" action="' . $_SERVER['PHP_SELF'] . '?controller=ReservasHabitaciones&action=submitReserva">
            
                <h1 class="form__title">Que fecha quieres la habitacion</h1>
                
                <div class="d-flex flex-column w-100 mt-3">
                    <label class="form__label">Habitación:</label>
                    <input name="habitacionId" type="text" class="input" value="' . $habitacion->getId() . '" readonly>
                </div>
                <div class="d-flex flex-column w-100 mt-3">
                    <label for="inputFechaEntrada" class="form__label">Fecha de entrada:</label>
                    <input type="date" class="input" id="inputFechaEntrada" name="fechaEntrada">
                </div>
                <div class="d-flex flex-column w-100 mt-3">
                    <label for="inputFechaSalida" class="form__label">Fecha de salida:</label>
                    <input type="date" class="input" id="inputFechaSalida" name="fechaSalida">
                </div>
                <div class="col-12">
                    <button class="button mt-4 " type="submit" >Hacer reserva</button>
                </div>
           
        </form> </div>';
    }

    /**
     * Function to show a message
     * 
     * @param String $errorMsg <p>Message you want to show</p>
     * @param String $type <p>Type of the message</p>
     * @param String $img <p>image you want to show</p>
     */
    public function showMessage($errorMsg, $type = "normal", $img = null) {

        echo '<div class="message ' . $type . '">' . $errorMsg . '</div>';
        if ($img !== null) {
            echo '<img src="/Reservas-Hotel/views/assets/images/' . $img . '"/>';
        }
    }
}
