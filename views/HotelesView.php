<?php

class HotelesView{
    
    // Muestra la lista de tareas
    public function showHotels($hoteles) {
       
        echo '<div>';
        
        foreach ($hoteles as $hotel){
            
            echo '  <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">'.$hotel['nombre'].'</h5>
                            <p class="card-text">'.$hotel['descripcion'].'</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>';
        }
        
        echo '</div>';
    }
}
