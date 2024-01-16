<?php

/**
 * Function to check if arguments are empty or not
 * @param string $args <p>Arguments to check if are empty</p>
 * @return bool Returns <p>true if the any argument is empty, otherwise false</p>
 * @throws \InvalidArgumentException
 * 
 */
function check_empty_data(...$args) {
    if (!empty($args) ){
        
        foreach ($args as $arg) {
            if (empty($arg)) {
                return true; // Return true if any argument is empty
            }
        }
        return false; // All arguments are non-empty
    } else {
        // Handle the case where no arguments are provided
        throw new \InvalidArgumentException('At least one argument is expected.');
    }
}





