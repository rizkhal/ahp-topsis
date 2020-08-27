<?php

if (!function_exists('notice')) {
    /**
     * Notice message
     *
     * @param  string $type
     * @param  string $message
     * @return void
     */
    function notice(string $type, string $message): void
    {
        $notices = session()->get('notice');
        if (!is_array($notices)) {
            $notices = [];
        }

        array_push($notices, [
            'type'    => $type,
            'message' => $message,
        ]);

        session()->put('notice', $notices);
    }
}

if (!function_exists('active')) {
    /**
     * Active url
     *
     * @param  array|string $path
     * @param  string $class
     * @return string
     */
    function active($path, $class = "active"): string
    {
        return call_user_func_array('Request::is', (array) $path) ? $class : "";
    }
}
