
<div class="block-inner clearfix">
<div<?php print $content_attributes; ?>>
  <div class="up-next-tease">
    <div class="up-next-tease-first"> Up Next </div>
    <div class="up-next-tease-second"> <a href="<?php print $content[0]['path']; ?>" class="up-next-title up-next-title-now" title="<?php print $content[0]['episode_title']; ?>"><?php print $content[0]['start']; ?><br />
      <?php print $content[0]['series_title']; ?></a> </div>
    <div class="up-next-tease-third"> <a href="<?php print $content[1]['path']; ?>" class="up-next-title up-next-title-now" title="<?php print $content[1]['episode_title']; ?>"><?php print $content[1]['start']; ?><br />
      <?php print $content[1]['series_title']; ?></a> </div>
    <div class="up-next-tease-fourth"> <a href="<?php print $content[2]['path']; ?>" class="up-next-title up-next-title-now" title="<?php print $content[2]['episode_title']; ?>"><?php print $content[2]['start']; ?><br />
      <?php print $content[2]['series_title']; ?></a> </div>
    <div class="up-next-tease-fifth"> <a href="/whatson" title="PBS Utah's Full Program Guide">Full Schedule</a> </div>
  </div>
</div>
