<div class="block-inner clearfix">
<div<?php print $content_attributes; ?>>
  <div class="section-menu section-menu-schedule" id="section-menu-schedule">
    <div class="return return-button return-button-schedule" id="return-button-schedule">
      <div id="front-four-top" class="in-page-filled in-page-front">
        <ul class="in-page-links">
          <li><a href="#page" title="Return to the top of the page" ><img src="/sites/all/themes/kued-mobile/images/return-top-button.png" alt="Return to the top button" title="Return to the top of the page" /></a></li>
          <li><a href="#paragraphs-item-2287" class="front-in-page-up"><img src="/sites/all/themes/kued-mobile/images/in-page-up-button.png" alt="Previous Section" /></a></li>
          <li><a href="#paragraphs-item-2529" class="front-in-page-down"><img src="/sites/all/themes/kued-mobile/images/in-page-down-button.png" alt="Next Section" /></a></li>
        </ul>
      </div>
    </div>
    <div class="header-menu header-menu-schedule">
      <ul class="menu">
        <li class="menu-item first"><a title="KUED's Full Program Guide" href="/whatson">View Full TV Schedule »</a></li>
        <li class="menu-item"><a href="<?php print $content['path_kids'] ?>">Kids Schedule »</a></li>
        <li class="menu-item last">Primetime: <a href="<?php print $content['path_tonight']; ?>" title="Tonight at 7PM">Tonight</a> | <a href="<?php print $content['path_tomorrow']; ?>" title="This Saturday at 7PM">Tomorrow</a> | <a href="<?php print $content['path_sunday']; ?>" title="This Sunday at 7PM">Sunday</a></li>
      </ul>
    </div>
  </div>
  <div class="section-content section-content-schedule">
    <div id="section-title-schedule" class="section-title section-title-schedule">
      <div class="section-title-schedule-headline">
        <!--h3>Program Guide</h3-->
        <h2>Schedule</h2>
      </div>
      <div class="section-info-schedule">
        <div class="instant-info">
        <?php if(isset($content['now_path'])) { ?>
          <div class="instant-info-now"> <span class="instant-info-lead instant-info-lead-now">on now:</span> <span class="node-title episode-title" property="dc:title"><a href="<?php print $content['now_path']; ?>" class="instant-info-title instant-info-title-now" title="<?php print $content['now_episode_title']; ?>"><?php print $content['now_title']; ?></a></span> <span class="instant-info-extra instant-info-extra-now"><?php print $content['remaining']; ?></span></div>
        <?php } ?>
        <?php if(isset($content['next_path'])) { ?>
          <div class="instant-info-next"> <span class="instant-info-lead instant-info-lead-next">up next:</span> <span class="node-title episode-title" property="dc:title"><a href="<?php print $content['next_path']; ?>" class="instant-info-title instant-info-title-next" title="<?php print $content['next_episode_title']; ?>"><?php print $content['next_title']; ?></a></span> <span class="instant-info-extra instant-info-extra-next"><?php print $content['next_start']; ?></span></div>
        <?php } ?>
          <div class="instant-info-tonight"> <span class="instant-info-lead instant-info-lead-next">coming up tonight:</span></div>
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