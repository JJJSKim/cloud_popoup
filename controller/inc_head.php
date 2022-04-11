<?php
    session_start();
    function get_session_state(): bool
    {
        if( isset( $_SESSION[ 'username' ])){
            return TRUE;
        }else
        {
            return FALSE;
        }
    }
    ?>