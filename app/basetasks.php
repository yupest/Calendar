<?php
include_once ("Calendar.php");
class BaseTasks extends Calendar
{
	public static $array_status=
  [
  	"current"=>"Текущие задачи",
    "failed"=>"Невыполненные задачи",
    "completed"=>"Выполненные задачи",
  ];
 	public static $array_datetime=
  [
  	"today"=>"Сегодня",
    "tomorrow"=>"Завтра",
    "week"=>"Эта неделя",
    "nextweek"=>"Следующая неделя",
  	"early"=>"Прошедшее",     
  ]; 

}