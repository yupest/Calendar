<tr >
 <?php 

    if (!empty($calendar->get_period($calendar->period)))
    {
    foreach($calendar->make_header() as $h)
    {?>
  <td><b>
    <?php echo $h; ?>
    </b></td>
  <?php }}?>
</tr>
<?php $calendar->make_admin($calendar->period);?><label class="errors"><?= $calendar->get_error("task");?></label>