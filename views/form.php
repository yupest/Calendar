<?php 
  include ("header.php");
?>


<form method="POST" action="" >  
			<table class="form"><img src="views/task.png" width=10%>

      <tr>
      <td class="right">Тема:</td>
      <td>
        <input type="text" name="article" value="<?=$calendar->article;?>">

      </td>
      </tr>
      <tr>
        
      <tr>
      <td class="right">Тип:</td>
      <td >
        <select name="type">
        <?php foreach (Calendar::$types as $id => $type) {?>
          <option name="type" value="<?=$id?>"<?=$calendar->type == $id ? ' selected' : ''?>><?= $type?></option>
        <?php } ?>
        </select><label class="errors"><?=$calendar->get_error("type")?></label>
 
      </td>
      </tr>
      <tr>        
      <td class="right">Место:</td>
      <td class="long">
        <input type="text" name="place" value="<?=$calendar->place;?>">
        <label class="errors"><?=$calendar->get_error("place")?></label>
      </td>
      </tr>    
      <tr>
      <tr>
      <td class="right">
      <label >Дата и время:</label>
          <script type="text/javascript" src="../javascript/calendar.js"></script>
      </td>
      <td class="cal">
      
			<input type="text" name="date_task" value="<?=$calendar->date_task;?>" readonly="readonly" size="10" onclick="showcalendar(this)">
      <img  src="views/Calendar.png">
        <select name="hour">
				<?php foreach($calendar->get_hours() as $hour){?>
          <option name="hour" value="<?=$hour?>"<?=$calendar->hour == $hour ? ' selected' : ''?>><?= $hour?></option>
        <?php } ?>
        </select>
        :
       	<select name="minute">
				<?php foreach($calendar->get_minutes() as $minute){?>
          <option name="minute" value="<?=$minute?>"<?=$calendar->minute == $minute ? ' selected' : ''?>><?=$minute?></option>
        <?php } ?>
        </select><label class="errors"><?=$calendar->get_error("date_task")?></label>
      </td>
      </tr>
        
      <tr>
      <td class="right">
      <label>Длительность:</label>
      </td>
      <td > 
        <select name="duration">
        <?php foreach (Calendar::$duration_array as $id => $duration) {?>
          <option name="duration" value="<?=$id?>"<?=$calendar->duration == $id ? ' selected' : ''?>><?=$duration?></option>
        <?php } ?>
        </select>

      </td>
      </tr>
       
      <tr>
      <td class="right">
      <label class="right">Комментарий:</label>
      </td>
      <td > 
        <textarea rows="5" cols="35" name="comment" ><?=$calendar->comment;?></textarea>

      </td>
      </tr>
      
        <tr><td></td><td><button type="submit" name="but">Добавить</button></td></tr>
  		</table>
    </form>

  </body>
</html>