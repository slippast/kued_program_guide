<?php
/**
 * @file
 * Template file for kued_program_guide_tabs
 */
?>

<ul class="tabs">
<?php
  foreach($items as $key => $value) {
?>
<li class="tab tab-<?php print $key ?>">
<a href="/whatson/list/<?php print $key ?><?php if($date) { print '/'.$date; } ?>" title="Find out what's on <?php print $value; ?>" class="<?php if ($key == $station) { print 'active'; } ?>"><?php print $value; ?></a>
</li>
<?php } ?>
</ul>