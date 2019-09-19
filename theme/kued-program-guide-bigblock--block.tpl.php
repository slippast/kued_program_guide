
<?php
dpm($content);
?>


<h1>PROGRAM GUIDE BIG BLOCK -here</h1>

<?php $tag = $block->subject ? 'section' : 'div'; ?>
<<?php print $tag; ?><?php print $attributes; ?>>
  <div class="block-inner clearfix">
    <?php print render($title_prefix); ?>
    <?php if ($block->subject): ?>
      <h2<?php print $title_attributes; ?>><?php print $block->subject; ?></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    
    <div<?php print $content_attributes; ?>>
      <?php print $content ?>
    </div>
  </div>
</<?php print $tag; ?>>




<?php
/*
<?php
$airdates = $content['#items']['airdates'];
$reminder_link =$content['#reminder'];

if(!empty($airdates)) {
  if(isset($block->subject)) {
    $tag = $block->subject ? 'section' : 'div';
  } else {
    $tag = 'div';
  }
?>
<<?php print $tag; ?><?php print $attributes; ?>>
  <div class="block-inner clearfix">
    <?php print render($title_prefix); ?>

<?php
  if(isset($block->subject)) {
?>
    <?php if ($block->subject): ?>
      <h2<?php print $title_attributes; ?>><?php print $block->subject; ?></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
<?php
  }
?>

    <div<?php print $content_attributes; ?>>
	<?php if(!empty($airdates)): ?>
  	<div class="airdates">
    <div class="upcoming">upcoming airdates</div>
		<?php $i = 1; $n = count($airdates); ?>
	  <?php	foreach($airdates as $key => $value) {
       $class = strtolower($value['class']); ?>

	<?php if($i==$n) { $position = '-last'; } else { $position = ''; } ?>
      <div class="airlist-channel-box<?php print $position; ?> airlist-channel-box-<?php print $class ?>">
        <h3 class="airdate-channel airdate-channel-<?php print $class ?>"><?php print $key ?></h3>
        <div class="airdate-list airdate-list-channel-<?php print $class ?>">
         <?php foreach($value as $key => $airdate) {
           if(is_numeric($key)) { ?>
            <?php print $airdate ?><br />
           <?php } ?>
         <?php } ?>
        </div>
      </div>
      <?php $i++; ?>
	<?php } ?>

      <?php if (!empty($reminder_link)): ?>
        <div class="field related-reminder-box"><?php print render($reminder_link); ?></div>
      <?php endif; ?>

      </div>
    <?php endif; ?>
    </div>
  </div>
</<?php print $tag; ?>>

<?php } else { ?>

<?php
  if(isset($block->subject)) {
    $tag = $block->subject ? 'section' : 'div';
  } else {
    $tag = 'div';
  }
?>
<<?php print $tag; ?><?php print $attributes; ?>>
  <div class="block-inner clearfix">
    <?php print render($title_prefix); ?>
    <?php if ($block->subject): ?>
      <h2<?php print $title_attributes; ?>><?php print $block->subject; ?></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    
    <div<?php print $content_attributes; ?>>
	<?php if(!empty($airdates)): ?>
  	<div class="airdates">
    	<div class="upcoming">no upcoming airdates</div>
    </div>
    <?php endif; ?>
    </div>
  </div>
</<?php print $tag; ?>>

<?php
}
?>
</div>
*/
?>