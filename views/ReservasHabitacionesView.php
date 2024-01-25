<?php

class ReservasHabitacionesView {

    public function showFormReservas($habitacion, $entrada="false", $salida="false") {
        echo '<h1>Quieres alquilar la habitacion ' . $habitacion->getNumHabitacion() . '</h1>';

        if($entrada === "true"){
            echo '<div>Rellena la fecha de entrada.</div>';
        }
        
        if($salida === "true"){
            echo '<div>Rellena la fecha de salida.</div>';
        }
        
        echo '<form method="POST" action="' . $_SERVER['PHP_SELF'] . '?controller=ReservasHabitaciones&action=submitReserva" class="row g-3">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Habitación:</label>
                <input name="habitacionId" type="text" class="form-control" value="' . $habitacion->getNumHabitacion() . '" readonly>

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
    
}
