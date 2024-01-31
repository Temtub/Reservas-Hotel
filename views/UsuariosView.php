<?php

class UsuariosView{
    // Muestra la lista de tareas
    public function comprobarLogin($userCheck, $pass, $errorBd, $empty, $user) {
       
        //If errorBd is true that means that there was an error selecting the data
        if($errorBd){
            $this->showMessage('Ha habido un error, intentelo de nuevo más tarde.');
            $this->mostrarFormularioLogin();
        }
        
        //If $empty is true means that the data was sent empty
        elseif ($empty) {
            $this->showMessage('Rellene todos los datos');
            $this->mostrarFormularioLogin();
        }
        
        //If usu, pass and errorBd are true that means that the login was correct and it redirectionates
        elseif($userCheck && $pass && !$errorBd){

            // Save the object of the user in the session
            session_start();
            $_SESSION['user'] = $user;
            
            header('Location: '.$_SERVER['PHP_SELF'].'?controller=HotelesHabitaciones&action=selectAllHotelesAndHabitaciones');
        }

        //If none of that ocurss then it means that the login was incorrect
        else{
            $this->showMessage('El usuario o la contraseña son incorrectos.');

            $this->mostrarFormularioLogin();
        }
        
    }
    
    /**
     * Function to show the form of login to the page
     */
    public function mostrarFormularioLogin() {
        
        //Form to the page
        echo ' 
        <form action="'.$_SERVER['PHP_SELF'].'?controller=Usuarios&action=checkUserPass" class="d-flex flex-column align-items-start form" method="POST">

            <h1 class="form__title">Inicia sesión para acceder</h1>

            <div class="d-flex flex-column w-100 mt-3">

                <label class="form__label" for="user">Tu nombre de usuario</label>
                <input id="user" focused class="input" type="text" name="user"/>
            </div>

            <div class="d-flex flex-column w-100 mt-3">

                <label class="form__label" for="user">Tu contraseña</label>
                <input class="input" type="password" name="pass" />

            </div>

            <input class="button mt-4 " type="submit" name="sub" value="Iniciar sesión" />
        </form>
        ';
        
    }
    
    
    /**
     * Function to show a message
     * 
     * @param String $errorMsg <p>Message you want to show</p>
     * @param String $type <p>Type of the message</p>
     * @param String $img <p>image you want to show</p>
     */
    public function showMessage($errorMsg, $type="normal", $img=null) {
        
        echo '<div class="message '.$type.'">'.$errorMsg.'</div>';
        
        echo '<img class="messageImg" src="views/assets/images/'. $img .'">';

    }
    
}

