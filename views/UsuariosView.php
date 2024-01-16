<?php

class UsuariosView{
    // Muestra la lista de tareas
    public function comprobarLogin($usu, $pass, $errorBd, $empty) {
       
        //If errorBd is true that means that there was an error selecting the data
        if($errorBd){
            echo '<div>Ha habido un error, intentelo de nuevo más tarde.</div>';
        }
        
        elseif ($empty) {
            echo '<div>Rellene todos los datos.</div>';
        }
        
        //If usu, pass and errorBd are true that means that the login was correct and it redirectionates
        elseif($usu && $pass && !$errorBd){
            echo '<div>Correcto.</div>';
        }

        //If none of that ocurss then it means that the login was incorrect
        else{
            echo '<div>El usuario o la contraseña son incorrectos.</div>';
        }
        
        $this->mostrarFormularioLogin();
        
    }
    
    public function mostrarFormularioLogin() {
        
        echo ' 
        <form action="'.$_SERVER['PHP_SELF'].'?controller=usuarios&action=checkUserPass" class="d-flex flex-column align-items-center" method="POST">
                
                <label>Nombre</label>
                <input type="text" name="user">
                
                <label>Contraseña</label>
                <input type="password" name="pass">
                
                
                <input type="submit" name="sub" value="Iniciar sesión">
                
            </form>
        ';
        
    }
    
}

