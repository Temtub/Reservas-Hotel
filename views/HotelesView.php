<?php

class HotelesView{
    
    // Muestra la lista de tareas
    public function showHotels($hoteles) {
       
        echo '<div>';
        
        foreach ($hoteles as $hotel){
            
            echo '  <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">'.$hotel->getNombre().'</h5>
                            <p class="card-text">'.$hotel->getDescripcion().'</p>
                            <a href="'.$_SERVER['PHP_SELF'].'?controller=Hoteles&action=selectAllHotels'.'" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>';
        }
        
        echo '</div>';
    }
}
