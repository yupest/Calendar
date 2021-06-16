<?php 
	$calendar->message="Список задач";
  include ("header.php");
	$calendar->set_admin_values($_GET);
?>
		<form action="" method="GET">  
			<table align="center" class="list">
      	<tr>
					<td>
        		<select name="status">
        			<?php foreach (Basetasks::$array_status as $id => $status) {?>
          		<option name="status" value="<?=$id?>"<?=$calendar->status == $id ? ' selected' : ''?>><?=$status?></option>
        			<?php } ?>
        		</select>
            <button type="submit" name="but0">►</button>
          </td>
          <td class="cal">
            <script type="text/javascript" src="../javascript/calendar.js"></script>
      			<input type="text" name="date1" value="<?=$calendar->date1?>" readonly="readonly" size="10" onclick="showcalendar(this)">

              <img  src="views/Calendar.png">
					<button type="submit" name="but1">►</button>
          </td>
          <td>
            <select name="period">
        			<?php foreach (Basetasks::$array_datetime as $d=>$period) {?>
          		<option name="period" value="<?=$d?>"<?=$calendar->period === $d ? ' selected' : ''?>><?= $period?></option>
        			<?php } ?>
        		</select><button type="submit" name="but2">►</button>
          </td>
          <td>
        	
          </td>
      	</tr>
  		</table>
      <table id='status' class='form'>
        <?php 
              if(isset($_GET['but0']) or isset($_GET['add']) or !empty($calendar->status))
              {
                include('tables/current_tasks.php');
              }
              else if (isset($_GET['but1']) or !empty($calendar->date1))
              {
                include('tables/date_picker.php');
              }
              else if (isset($_GET['but2']) or !empty($calendar->period))
              {
                include('tables/date_tasks.php'); 
                
              }
           
        ?>
      </table>
              <?php
              	if(($calendar->status!=='completed' or  isset($_GET['add']) ) and !empty($calendar->status))
              {?>
              <button type='submit' name="add">
                Изменить
              </button>
              <?php }?>
    </form>
  </body>
</html>