<?php
class Session 
{
    protected static $_session_started = false;

    protected static function start_session()
    {
        if ( ! static::$_session_started)
        {
            session_start();
            static::$_session_started = true;
        }
    }

    public static function set($key, $value)
    {
        static::start_session();
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        // static::start_session();

        // $value = null;

        if ( ! empty($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }

        
    }

    public static function forget($key)
    {
        // static::start_session();

        if ( ! empty($_SESSION[$key]))
        {
            unset($_SESSION[$key]);
        }
        static::$_session_started = false;
    }

}