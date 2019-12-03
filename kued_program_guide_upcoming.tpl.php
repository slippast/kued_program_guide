<?php foreach($content['nodes'] as $nid => $content) {
  if(is_numeric($nid)) { ?>
<article class="node node-episode kued-program-guide-upcoming">
      <?php
      print $content['#reminder'];
      print render($content['title']);

           $i = 1;
           $item = '';
           $count = '';
           $count = count($content['airdates']);
           foreach($content['airdates'] as $key => $airdate) {
             if(is_numeric($key)) {
               if($count != 1) {
                if($i == 1) { $item = ' first'; } elseif($i == $count) { $item = ' last'; } else { $item = ''; }
               } else {
                $item = ' first';
               }
              foreach($airdate as $channel => $airdate) {
                switch($channel) {
                  case 'KUED-HD':
                    $channel_title = 'PBS Utah';
                    $class = 'kued';
                  break;
                  case 'WORLD':
                    $channel_title = 'World Channel';
                    $class = 'world';
                  break;
                  case 'KIDS CH':
                    $channel_title = 'Kids 24/7';
                    $class = 'kids-247';
                  break;
                  case 'CREATE':
                    $channel_title = 'Create';
                    $class = 'create';
                  break;
                }

                print '<div class="airlist-upcoming airlist-upcoming-' . $class . ' item-num-' . $i . '' . $item . '"><span class="channel channel-' . $class . '">' . $channel_title . '</span> ' . $airdate . '</div>';
                $i++;
              }
            ?>
  
        <?php } ?>
      <?php } ?>
    </article>
  <?php } ?>

<?php } ?>
