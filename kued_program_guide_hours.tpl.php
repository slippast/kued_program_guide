<?php
/**
 * @file
 * Template file for kued_program_guide_hours
 */
?>
<?php
foreach ($time_block as $key => $value) {
$key_display = $key + 1;
?>
<div class="half-hour cell<?php print $key_display ?>" style="left:<?php print $start_position[$key] ?>%; width:<?php print $cell_width ?>%;"><?php print $value ?>
</div>
<?php } ?>