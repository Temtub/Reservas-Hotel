<?php

class ErrorView{
    
    /**
     * Function to show a message
     * 
     * @param String $errorMsg <p>Message you want to show</p>
     * @param String $type <p>Type of the message</p>
     * @param String $img <p>image you want to show</p>
     */
    public function showMessage($errorMsg, $type="normal", $img=null) {
        
        echo '<div class="message '.$type.'">'.$errorMsg.'</div>';
        
        echo '<img class="messageImg" alt="image" src="views/assets/images/'. $img .'">';

    }
}
