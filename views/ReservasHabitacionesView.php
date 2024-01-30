<?php

class ReservasHabitacionesView {

    public function showFormReservas($habitacion, $entrada=false, $salida=false, $wrongDate=false) {
        echo '<h1>Quieres alquilar la habitacion ' . $habitacion->getNumHabitacion() . '</h1>';

        
        if($entrada === "true"){
            $this->showMessage('Rellena la fecha de entrada.', 'error');
        }
        
        if($salida === "true"){
            $this->showMessage('Rellena la fecha de salida.', 'error');
        }
        
        if($wrongDate === "true" ){
            $this->showMessage('La entrada no puede ser antes que la salida.', 'error');
        }

        echo '<form class="row g-3 formulario" method="POST" action="' . $_SERVER['PHP_SELF'] . '?controller=ReservasHabitaciones&action=submitReserva">
            <div class="col-md-6">
                <label class="form-label">Habitación:</label>
                <input name="habitacionId" type="text" class="form-control" value="' . $habitacion->getId() . '" readonly>

                <label for="inputFechaEntrada" class="form-label">Fecha de entrada:</label>
                <input type="date" class="form-control" id="inputFechaEntrada" name="fechaEntrada">

                <label for="inputFechaSalida" class="form-label">Fecha de salida:</label>
                <input type="date" class="form-control" id="inputFechaSalida" name="fechaSalida">

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </form>';
    }
    
    public function showReserva() {
        
    }

    public function showMessage($errorMsg, $type="normal", $img=null) {
        
        echo '<div class="message '.$type.'">'.$errorMsg.'</div>';
        if($img !== null){
            echo '<img src="/Reservas-Hotel/views/assets/images/'.$img.'"/>';
        }

    }
    
}
