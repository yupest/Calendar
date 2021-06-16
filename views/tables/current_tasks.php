<tr >
 <?php 

    if (!empty(Calendar::get_tasks($calendar->status)))
    {
      if($calendar->status!=='completed')
      {
        echo ' <td><b>Пометить как выполненное</b></td>';
      }
      foreach($calendar->make_header() as $h)
      {?>
  <td><b>
    <?php echo $h; ?>
    </b></td>
  <?php }}?>
</tr>

<?php $calendar->make_admin($calendar->status);?><label class="errors"><?= $calendar->get_error("task");?></label>