<?php

function __method()
{
    $ci = & get_instance();
    return $ci->router->fetch_method();
}

function __class()
{
    $ci = & get_instance();
    return $ci->router->fetch_class();
}

function __pm($v)
{
    if(empty($v)) {
        return $v;
    }
    return ucwords(mb_strtolower($v));
}

function __fecha($fecha = "", $formato = "Y-m-d" , $horas = false)
{
    if (empty($fecha)) {
        $fecha = date("Y-m-d");
        $formato = "Y-m-d";
    }
    $fecha_r = DateTime::createFromFormat($formato, $fecha);

    if ($horas) {
        return $fecha_r->format('d/m/Y H:i:s');
    } else {
        return $fecha_r->format('d/m/Y');
    }
}
if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
        case 'empty':
        case '(empty)':
            return '';
        case 'null':
        case '(null)':
            return;
        }

        if (($valueLength = strlen($value)) > 1 && $value[0] === '"' && $value[$valueLength - 1] === '"') {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

function validarAccesso()
{
    $ci = &get_instance();
    $c  = $ci->session->userdata('credential');

    if (($c == null) || (!isset($c['id'])) || (!isset($c['username'])) || (!isset($c['password']))) {
        return false;
    }

    $user = $ci->login_model->getUser($c['id']);

    if ((!is_object($user)) || ($user === null) || ($user === false)) {
        return false;
    }

    $name   = $user->username;
    $pass   = $user->password;
    $activo = $user->activo;

    if (($name === $c['username']) && ($pass === $c['password']) && ($activo == 1)) {
        return true;
    }

    return false;
}
