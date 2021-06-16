<tr >
 <?php 

    if (!empty($calendar->get_period($calendar->date2)))
    {
    foreach($calendar->make_header() as $h)
    {?>
  <td><b>
    <?php echo $h; ?>
    </b></td>
  <?php }}?>
</tr>
<?php $calendar->make_admin($calendar->date2);?><label class="errors"><?=$calendar->get_error("task");?></label>