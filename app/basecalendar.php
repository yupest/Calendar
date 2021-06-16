<?php
include_once "database.php"; 
class BaseCalendar
{
  public $article;
  public $type;
  public static $types=
  [
      	1=>"встреча",
        2=>"звонок",
        3=>"совещание",
      	4=>"дело",
  ];
  public $place;
  public $duration;
  public static $duration_array=
  [
        1=>"меньше часа",
        2=>"1-2 часа",
        3=>"2-3 часа",
        4=>"3-4 часа",
        5=>"4-6 часов",
        6=>"6-9 часов",
        7=>"9-12 часов",
        8=>"более 12 часов",
  ];  
  public $comment;
  public $date_task;
  public $dateDB;  
  public $minute;
  public function get_minutes()
  {
  	for($i=0;$i<60;$i++)
    {
			if(strlen($i)===1) 
        $array[$i]='0'.$i;
      else
        $array[$i]=$i;
    }
    return $array;
  }
  public $hour;
    public function get_hours()
  {
  	for($i=0;$i<24;$i++)
    {
			if(strlen($i)===1) 
        $array[$i]='0'.$i;
      else
        $array[$i]=$i;
    }
    return $array;
  }
  public $time_task;  
  public $date1;
  public $date2;  
  public $status;
  public $period;
  public function set_values($method)
  {
        $this->article= isset($method['article']) ? $method['article'] : '';
        $this->type=isset($method['type']) ? $method['type'] : '';
        $this->place=isset($method['place']) ? $method['place'] : '';
        $this->duration=isset($method['duration']) ? $method['duration'] : '';
        $this->comment=isset($method['comment']) ? $method['comment'] : '';
  			$this->date_task=isset($method['date_task']) ? $method['date_task'] : '';
        $this->hour=isset($method['hour']) ? $method['hour'] : '';
  			$this->minute=isset($method['minute']) ? $method['minute'] : '';  
  }


  public function set_admin_values($method)
  {
        $this->status= ((isset($method['but0'])) or (!isset($method['but2']) and  !isset($method['but1']) and isset($method['status']))) ? $method['status'] : '';
       	$this->period= ((isset($method['but2'])) or (!isset($method['but0']) and  !isset($method['but1']) and isset($method['period']))) ? $method['period'] : '';
    		$this->date1 = ((isset($method['but1'])) or (!isset($method['but2']) and  !isset($method['but0']) and isset($method['date1']))) ? $method['date1'] : '';    
    		if (!empty($this->date1))
    		{
        	$arr=explode(".", $this->date1);
      		$this->date2=$arr[2].'-'.$arr[1].'-'.$arr[0];
    		}
  }
  public function get_status($time)
  {
  	if($this->validate())
    {
    	if($time>=date('Y-m-d'))
      {
        return 'current';
      }
      else
        return 'failed';        
    }
  }
  public $errors=[];
  public function validate()
  {
    $this->set_values($_POST);
    if (empty($this->type))
    {
        $this->errors["type"]=' Укажите, пожалуйста, какого рода встреча предстоит :)';
    }
    if (empty($this->article))
    {  
      	$this->article="Без названия";
    }     
    if (empty($this->date_task))
    {
        $this->errors["date_task"]=' Нужно заполнить дату';      
    }
    else if (empty($this->date_task) && (empty($this->hour) or empty($this->minute)))
    {
    	$this->errors["date_task"]=' Нужно заполнить дату и время';  
    }
    else if (empty($this->hour) or empty($this->minute))
    {
    	$this->errors["date_task"]=' Вы не указали время :(';     
    }
    else	
    {
      $this->time_task=$this->hour.":".$this->minute;
      $arr=explode(".", $this->date_task);
      $this->dateDB=$arr[2].'-'.$arr[1].'-'.$arr[0];
    }
    return empty($this->errors);

      
  }
  public function get_error($value)
  {
      return isset($this->errors[$value]) ? $this->errors[$value] : '';
  }
}