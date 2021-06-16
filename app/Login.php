<?php
	include_once 'session.php';
  class Login  
  {
    public static $login;
    public static $password;
    public static $exit;
    public static $error='';
    public static function get_login()
    {
    		return 'calendar';
    }
    protected function get_password()
    {
    		return 'q';
    }    
    public function set_values()
    {
     	static::$login=isset($_POST['login'])? $_POST['login']: '';
      static::$password=isset($_POST['password'])? $_POST['password'] : '' ;      
    }
		protected static $start_time;
		public function validate()
    {
      $this->set_values();
      if ((static::$login===static::get_login()) && (static::$password===$this->get_password()))
      {
       	Session::set("time", time());
        // static::$error=Session::get('time');
        return header("Location: Tasks.php");
      }
      else if (!empty(static::$login) or !empty(static::$password))
      {
       static::$error="Неверные логин или пароль :(";
      }
    }
    public function forget()
    {
       	Session::forget('time');
        return header("Location: Enter.php");   
    }
    public function get_time()
    {
    		return (time()-Session::get("time"));
    }
    public static function delete()
    {
			if (static::get_time() > 300)
      {
				static::forget();
      }
    }
    

    public static function admin_exit($method)
    {
      if ($_SERVER['REQUEST_METHOD']==="POST")
      {
    		static::forget();
      }
    }
  }