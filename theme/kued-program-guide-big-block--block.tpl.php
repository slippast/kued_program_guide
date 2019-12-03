<div class="block-inner clearfix">
<div<?php print $content_attributes; ?>>


  <div class="section-content-header section-content-header-community">
    <div class="section-content-title section-content-title-community">
      <h2><a href="/whatson" title="PBS Utah Program Guide and TV Schedule">TV Schedule</a></h2>
    </div>
    <div class="section-content-menu section-content-menu-community">
      <ul class="menu">
        <li class="menu-item first"><a title="KUED's Full Program Guide" href="/whatson">View Full TV Schedule »</a></li>
        <li class="menu-item"><a href="<?php print $content['path_kids'] ?>">Kids Schedule »</a></li>
        <li class="menu-item last">Primetime: <a href="<?php print $content['path_tonight']; ?>" title="Tonight at 7PM">Tonight</a> | <a href="<?php print $content['path_tomorrow']; ?>" title="This Saturday at 7PM">Tomorrow</a> | <a href="<?php print $content['path_sunday']; ?>" title="This Sunday at 7PM">Sunday</a></li>
      </ul>
    </div>
  </div>

  

  <div class="section-content section-content-schedule">
    <div id="section-title-schedule" class="section-title section-title-schedule">
      <div class="section-info-schedule">
        <div class="instant-info">
        <?php if(isset($content['now_path'])) { ?>
          <div class="instant-info-now"> <span class="instant-info-lead instant-info-lead-now">on now:</span> <span class="node-title episode-title" property="dc:title"><a href="<?php print $content['now_path']; ?>" class="instant-info-title instant-info-title-now" title="<?php print $content['now_episode_title']; ?>"><?php print $content['now_title']; ?></a></span> <span class="instant-info-extra instant-info-extra-now"><?php print $content['remaining']; ?></span></div>
        <?php } ?>
        <?php if(isset($content['next_path'])) { ?>
          <div class="instant-info-next"> <span class="instant-info-lead instant-info-lead-next">up next:</span> <span class="node-title episode-title" property="dc:title"><a href="<?php print $content['next_path']; ?>" class="instant-info-title instant-info-title-next" title="<?php print $content['next_episode_title']; ?>"><?php print $content['next_title']; ?></a></span> <span class="instant-info-extra instant-info-extra-next"><?php print $content['next_start']; ?></span></div>
        <?php } ?>
          <!--div class="instant-info-tonight"> <span class="instant-info-lead instant-info-lead-next">coming up tonight:</span></div-->
        </div>
<?php
/*
        <div class="instant-info-links">
          <div class="instant-info-links-list">
            <ul class="menu instant-info-menu">
              <li class="instant-info-menu-item instant-info-menu-item-tonight instant-info-lead instant-info-lead-links"><span class="instant-info-lead instant-info-lead-links">quick links:</span></li>
              <li class="instant-info-menu-item instant-info-menu-item-tonight"><a href="<?php print $content['path_tonight']; ?>" title="Tonight at 7PM">Tonight in Primetime</a></li>
              <li class="instant-info-menu-item instant-info-menu-item-schedule"><a href="/whatson" title="KUED's Full Program Guide">Full Schedule</a></li>
            </ul>
          </div>
        </div>
*/
?>
      </div>
    </div>

<?php if(isset($content['kued'][0])) { ?>
    <div class="container-12 section-schedule-upcoming">

<?php
  $count = count($content['kued']) - 2;

  if($count == 3) {
    $grid = 'grid-4';
  } elseif($count == 2) {
    $grid = 'grid-6';
  } elseif($count == 1) {
    $grid = 'grid-12';
  }
?>
  
<?php if($count >= 1) { ?>  
    <div class="<?php print $grid ?> alpha section-schedule section-schedule-0">
    <?php print render($content['kued'][0]); ?>
    </div>
<?php } ?>


<?php if($count >= 2) { ?>
    <div class="<?php print $grid ?> <?php if($count == 2) { print 'omega'; } ?> section-schedule section-schedule-1">
    <?php print render($content['kued'][1]); ?>
    </div>
<?php } ?>

<?php if($count >= 3) { ?>
    <div class="<?php print $grid ?> <?php if($count == 3) { print 'omega'; } ?> section-schedule section-schedule-2">
    <?php print render($content['kued'][2]); ?>
    </div>    
<?php } ?>

    </div>
<?php } ?>

  </div>
</div>