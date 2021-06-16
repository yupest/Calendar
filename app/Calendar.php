<?php
include_once "basecalendar.php";
class Calendar extends BaseCalendar
{
  public function make_attrributes()
    {
      	return
      	[
          ":id"	=>	NULL,
          ":name" => $this->article,
          ":type_id" => $this->type,
          ":place" => $this->place,          
          ":date" => $this->dateDB,
          ":time" => $this->time_task,
					":duration" => static::$duration_array[$this->duration],
      		":comment" => $this->comment,
       		":status" => $this->get_status($this->dateDB),
          ":deleted_at" => NULL,
        ];
    }
		protected static function get_pdo()
    {
        return Database::get_pdo();
    }
		protected static $table="tasks";
  	public $message="Мой календарь";
		public function savedb()
    {
        if ($this->validate())
        {
          $array=$this->make_attrributes();       
          foreach ($array as $key=>$attribute)
            {
            		$str[]=$key;
                $vals[]=$attribute;
            }
          	$sql = static::get_pdo()->prepare('INSERT INTO `' . static::$table . '` VALUES (' . implode(',', $str).');');
          	$sql->execute($array);
            
            if ($sql->rowCount() === 1)
            {
              $this->message="Новая задача успешно создана!";
            }
            else
            {
              $this->message=implode(',', $vals);
            }
            return $sql->rowCount() === 1;
        }
        return false;
    }
  	public static function get_tasks($status)
    {
        $sql = static::get_pdo()->prepare('SELECT 
        																		`ts`.`id`,
                                            `t`.`name` AS `type`, 
                                            `ts`.`name`, 
                                            `place`, 
                                            CONCAT(`date`,"  ", `time`) AS `time`
                                            FROM `tasks` AS `ts`
                                            JOIN `types` AS `t` ON `t`.`id`=`ts`.`type_id`
                                            WHERE `status`=:status '.' AND `deleted_at` IS NULL
                                            ORDER BY `time`;');
        $sql->execute(
          [
            ':status'=>$status,
          ]);

        $objects = [];

        while ($object = $sql->fetchAll())
        {	
            		$objects[] = $object;
        }
    		if (!empty($objects))
        	return $objects[0];
    }
  public function get_period($period)
    {
    		$str='';
    		switch ($period)
        {
        	case 'today':
          	$str=' `date`= CURDATE()';
            break;
					case 'tomorrow':
          	$str='`date`=CURDATE()+INTERVAL 1 DAY';
          	break;
					case 'week':
          	$str="WEEK(`date`)=WEEK(CURDATE())";
          	break;
					case 'nextweek':
          	$str='WEEK(`date`)=WEEK(CURDATE())+1 AND YEAR(`date`)=YEAR(CURDATE())';
          	break;
					case 'early':
          	$str='`date`<CURDATE()';
          	break;
 					default:
          	$str='`date`="'.$this->date2.'"';
          	break;
        }
        $sql = static::get_pdo()->prepare('SELECT 
        																		`ts`.`id`,
                                            `t`.`name` AS `type`, 
                                            `ts`.`name`, 
                                            `place`, 
                                            CONCAT(`date`,"  ", `time`) AS `time`
                                            FROM `tasks` AS `ts`
                                            JOIN `types` AS `t` ON `t`.`id`=`ts`.`type_id`
                                            WHERE '.$str.' AND `deleted_at` IS NULL
                                            ORDER BY `time`;');
        $sql->execute();

        $objects = [];

        while ($object = $sql->fetchAll())
        {	
            		$objects[] = $object;
        }
    		if (!empty($objects))
        	return $objects[0];
    }
    public function get_all()
    {
        $sql = static::get_pdo()->prepare('SELECT * FROM `' . static::$table . '`;');
        $sql->execute();

        $objects = [];

        while ($object = $sql->fetchAll())
        {	
            		$objects[] = $object;
        }
        return $objects[0];
    }
    public function update_status($id)
    {
            $set1=
             [
              ":status"=>'completed',
              ':id'=> $id,
              ];
            $sql = static::get_pdo()->prepare('UPDATE `' . static::$table . '` SET `status` = :status  WHERE id = :id LIMIT 1;');
            $sql->execute($set1);
      return true;
    }
    public function update_del($id)
    {
            $set1=
             [
              ":deleted_at"=> date('Y-m-d H:i:s'),
              ':id'=> $id,
              ];
            $sql = static::get_pdo()->prepare('UPDATE `' . static::$table . '` SET `deleted_at` = :deleted_at WHERE id = :id LIMIT 1;');
            $sql->execute($set1);
    }
    public function make_header()
    {

        return
        [
        "Тип",
        "Задача",
        "Место",
        "Дата и время",
        "Удалить",
        ];

    }
    public function make_admin($method)
    {
      $array=[];
      $update=[];
      switch ($method)
      {        
        case $this->status:
      		$array=$this->get_tasks($method);
      		break;
        default:       	
      		$array=$this->get_period($method);
      		break;
      }
      if (empty($array))
      {
        $this->errors['task']="Таких задач пока нет :( Добавьте новую!";
      }
      else
      {
        for($i=0;isset($array[$i]);$i++)
        {
          $update[$i]=false;
          for ($j=0; $j<5;$j++)
          {
						
            if($j%5==0)
            {
             
            		if ($method !=='completed' and $method!==$this->period and $method!==$this->date2)
            		{	            
                  if (isset($_GET[$i]) and isset($_GET['add']))
                  {
                    $update[$i]=$this->update_status($array[$i]['id']);
                  }

                  if(empty($this->get_all()[$array[$i]['id']-1]['deleted_at']) and !$update[$i])
                  {
              			echo "<tr><td width=10%><input type='checkbox' name='$i' >";
                  }
            		}
              	else
                {
                  
                	echo "<tr>";
                }

            }              
					  if (empty($this->get_all()[$array[$i]['id']-1]['deleted_at']) and !$update[$i])
          	{
							if ($j!==0)
              {
                 echo "<td>".$array[$i][$j]."</td>";
              }
              
            }
          } 					  
          if (isset($_GET["$method$i"]))
          {
           $this->update_del($array[$i]['id']);
            
          }	
					if (empty($this->get_all()[$array[$i]['id']-1]['deleted_at']) and !$update[$i])
          {          
          	echo "<td><button type='submit' name='$method$i'>Удалить</button></td></tr>";
          }
         
        }
      }
    }
}