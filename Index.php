<?php
  include("app/Login.php"); 
  if (empty(Session::get('time')))
  {
    include ("Enter.php");
  }
  else
  {
    include ("Tasks.php");
  }
  