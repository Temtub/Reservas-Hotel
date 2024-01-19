<?php

class HotelesHabitacionesView {

    // Muestra la lista de tareas
    public function showHotelsRooms($hoteles, $habitaciones) {

        echo '<div>';

        foreach ($hoteles as $hotel) {
            //Transform the image to be capable of show it
            $imagenBase64 = $hotel->getFotoBase64();

            echo '  <div class="card" style="width: 18rem;">
                        <img src="data:image/jpeg;base64,' . $imagenBase64 . '" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">' . $hotel->getNombre() . '</h5>
                            <p class="card-text">' . $hotel->getDescripcion() . '</p>
                            ';
            foreach ($habitaciones as $habitacion) {
                if ($habitacion->getIdHotel() === $hotel->getId()) {
                    echo '<p>' . $habitacion->getNumHabitacion() . '</p>';
                }
            }
            echo ' 
                <form action="'.$_SERVER['PHP_SELF'].'?controller=HotelesHabitaciones&action=showHotelAndRooms" method="POST">
                    <input type="hidden" name="idHotel">
                    <input type="submit" name="sub">
                </form>
                        </div>
                    </div>';
        }

        echo '</div>';
    }
    
    public function showHotelAndRooms() {
        echo '<h1>asd</h1>';
    }

}

