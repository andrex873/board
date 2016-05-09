<?php

if (! function_exists('generate_secure_id')) {

    /**
     * Generates the secure id for the models.
     *
     * @return array
     */
    function generate_secure_id() {
        return hash('sha256', microtime(true));
    }
}
