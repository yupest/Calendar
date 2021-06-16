<?php
  include ('app/session.php');
  include ("app/Calendar.php");
  include ("app/basetasks.php");
  
  $calendar = new Calendar;
  if ($_SERVER['REQUEST_METHOD'] === 'GET')
  {    
    if(!empty(Session::get('message')))
    {    
      Session::forget('message');
    }
    include ("views/form.php"); 
    include ("views/admin.php");

  }
  else if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    if(empty(Session::get('message')))
    {
      if($calendar->savedb())
      {
        Session::set('message',"повторное отправление");
        include ("views/header.php"); 
        echo "<form method='GET' action=''><input type='submit' value='Добавить еще задачу'/></form>";
      }    
      else
      {
        include ("views/form.php");
        include ("views/admin.php");  
      }
    }
  }
?>