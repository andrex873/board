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

if (! function_exists('get_note_types')) {

    /**
     * Generates the secure id for the models.
     *
     * @return array
     */
    function get_note_types() {
        return [
            'WELL' => '',
            'WRON' => '',
            'AITEM' => '',
        ];
    }
}
