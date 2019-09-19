<?php

/**
 * @file
 * Module file for kued_program_guide_module.
 */

function kued_program_guide_init() {
$GLOBALS['conf']['cache'] = FALSE;
}


/**
 * Implements hook_help().
 */
function kued_program_guide_help($path, $arg) {
  switch ($path) {
    case 'admin/help#simple':
      // Here is some help text for a custom page.
      return t('This sentence contains all the letters in the English alphabet.');
  }
}

/**
 * Implements hook_permission().
 *
 * Since the access to our new custom pages will be granted based on
 * special permissions, we need to define what those permissions are here.
 * This ensures that they are available to enable on the user role
 * administration pages.
 */
function kued_program_guide_permission() {
  return array(
    'access guide page' => array(
      'title' => t('Access guide page'),
      'description' => t('Allow users to access guide page'),
    ),
  );
}



/**
 * Implements hook_menu().
 */
function kued_program_guide_menu() {


//cache_clear_all('*', 'cache_menu', TRUE);
//cache_clear_all('*', 'cache_page', TRUE);
//cache_clear_all();

//drupal_flush_all_caches();

	//Get the usual defaults
/*
	$guide_form_defaults = kued_program_guide_default();
		$time = $guide_form_defaults['time'];
		$day = $guide_form_defaults['date'];
		$hours = $guide_form_defaults['duration'];
		$station = $guide_form_defaults['station'];
		$time_title_display = strtotime("$day " . "$time");
		$time_title_display = date('g:i a \o\n l F jS Y', $time_title_display);
*/

		$a = '';
		$b = '';
		$c = '';
		$d = '';

  // What's On guide menu items
	// First is a redirect
  $items['whatson'] = array(
    'title' => 'What\'s On',
    'page callback' => 'kued_program_guide_redirect',
    'access callback' => TRUE,
    'expanded' => TRUE,
    'type' => MENU_NORMAL_ITEM,
  );

	// Second is the default landing page
  $items['whatson/guide'] = array(
    'title' => 'KUED Program Guide',
    'page callback' => 'kued_program_guide_arguments',
    'page arguments' => array($a, $b, $c, $d),
    'access arguments' => array('access guide page'),
    'type' => MENU_NORMAL_ITEM,
  );

	// Third is the search results page
  $items['whatson/guide/%/%/%/%'] = array(
//    'title' => 'What\'s On Program Guide | ' . $time_title_display . ' | Showing ' . $hours . ' hours on ' . strtoupper($station) . '',
    'title' => 'KUED What\'s On Program Guide Search',
    'page callback' => 'kued_program_guide_arguments',
    'page arguments' => array(2, 3, 4, 5),
    'access arguments' => array('access guide page'),
    'type' => MENU_NORMAL_ITEM,
  );

  return $items;
}


/**
 * kued_program_guide_description function.
 */
function kued_program_guide_redirect() {
  drupal_goto("whatson/guide");
}




/**
 * Implements hook_form().
 */
function kued_program_guide_search_form($form, &$form_state) {

	// Get the defaults or current arguements with this function
	$guide_form_defaults = kued_program_guide_default();

	// Build the form
  $form['details'] = array(
    '#type' => 'fieldset',
    '#title' => t('Search For Specific Date'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
		'#prefix' => '<div class="whatson-guide-search-box">',
		'#suffix' => '</div>',
  );

  $form['details']['station'] = array(
		'#type' => 'select',
		//'#title' => t('Station'),
		'#default_value' => $guide_form_defaults['station'],
		'#options' => array(
			'all-stations' => 'All Stations',
			'kued' => 'KUED',
			'world' => 'The World',
			'v-me' => 'V-Me',
		),
  );

  $form['details']['date'] = array(
		'#type' => 'select',
		//'#title' => t('Date'),
		'#default_value' => $guide_form_defaults['date'],
		'#options' => kued_program_guide_select_date(),
  );

  $form['details']['time'] = array(
		'#type' => 'select',
		//'#title' => t('Start Time'),
		'#default_value' => $guide_form_defaults['time'],
		'#options' => kued_program_guide_select_time(),
  );

  $form['details']['duration'] = array(
		'#type' => 'select',
		//'#title' => t('Duration'),
		'#default_value' => $guide_form_defaults['duration'],
		'#options' => kued_program_guide_select_duration(),
  );

	$form['details']['submit'] = array(
		'#type' => 'submit',
		'#value' => t('Submit'),
	);

  return $form;
}

/**
 * Implements form_submit().
 */
function kued_program_guide_search_form_submit($form, &$form_state) {
	$station = $form_state['values']['station'];
	$day = $form_state['values']['date'];
	$time = $form_state['values']['time'];
	$duration = $form_state['values']['duration'];

	// Clean URL Argument style redirect here
	drupal_goto("whatson/guide/".$station."/".$day."/".$time."/".$duration);
}




///////////////////////////////


/**
 * Implements hook_block_info().
 */
function kued_program_guide_block_info() {
  $blocks['kued_program_guide_search'] = array(
    'info' => t('KUED Program Schedule Search'), //The name that will appear in the block list.
    'cache' => FALSE, //Default
  );
  return $blocks;
}

/**
 * Implements hook_block_view().
 */
function kued_program_guide_block_view($delta='')
{
  switch($delta) {
    case 'kued_program_guide_search':
      $block['subject'] = null; // Most forms don't have a subject 
//			$block['content']['form'] = drupal_get_form('kued_program_guide_search_form');
//      $block['content']['links'] = kued_program_guide_items();
      break;
   }
   return $block;
 }


/**
 * Implements hook_theme().
 */
/*
function kued_program_guide_theme() {
  return array(
    'kued_program_guide_navigation_form' => array(
      'template' => 'kued_program_guide_navigation_form',
'render element' => 'form',
    ),
//...
  );
}
*/


/**
 * Implements hook_theme().
 *
 * Defines the theming capabilities provided by this module.
 */
function kued_program_guide_theme() {
  $items = array(
/*
    'theming_example_content_array' => array(
      // We use 'render element' when the item to be passed is a self-describing
      // render array (it will have #theme_wrappers)
      'render element' => 'element',
    ),
    'theming_example_list' => array(
      // We use 'variables' when the item to be passed is an array whose
      // structure must be described here.
      'variables' => array(
        'title' => NULL,
        'items' => NULL,
      ),
    ),
*/

    'kued_program_guide_title'  => array(
			'render element' => 'element',
      'template' => 'kued_program_guide_title',
    ),

    'kued_program_guide_hours'  => array(
			'render element' => 'element',
      'template' => 'kued_program_guide_hours',
    ),

    'kued_program_guide_nodes'  => array(
			'render element' => 'element',
      // In this one the rendering will be done by a tpl.php file instead of
      // being rendered by a function, so we specify a template.
      'template' => 'kued_program_guide_nodes',
    ),
/*
    'theme_kued_program_guide'  => array(
      'variables' => array(
        'title' => NULL,
        'items' => NULL,
        'output' => NULL,
      ),
      // In this one the rendering will be done by a tpl.php file instead of
      // being rendered by a function, so we specify a template.
      'template' => 'theme_kued_program_guide',
    ),
*/
  );
  return $items;
}


/*
function template_preprocess_kued_program_guide_nodes(&$vars) {
$vars['title'] = "node_list";

}

function template_preprocess_theme_kued_program_guide(&$vars) {
//$variables['title'] = "full_guide";
//$variables['items'] = "some items";

//kpr($vars);


$vars['station'] = $vars['kued'];
$vars['version_id'] = $vars['kued']['1']['field_version_id']['und']['0']['value'];

$vars['output'] = $vars;

//$output = $vars['items'];

//$vars['items'] = $vars['items'];

//drupal_set_message('<pre>pre'.print_r($output, TRUE).'</pre>');

  //$node = $variables['node'];
  //$build = node_view($node);
  //$output = drupal_render($output);
  //return $output;

}
*/



/**
 *
 */
function kued_program_guide_items() {
//Get defaults if needed
$guide_form_defaults = kued_program_guide_default();
	$time = $guide_form_defaults['time'];
	$day = $guide_form_defaults['date'];
	$hours = $guide_form_defaults['duration'];
	$station = $guide_form_defaults['station'];

	//Format the start and end times
	$start_time = strtotime("$day " . "$time");
	$duration = $hours * 3600;
	$end_time = $start_time + $duration;

	// Build navigation buttons
	$current_time = strtotime("$day " . "$time"); // Time to unix

	$earlier = $current_time - $duration;
	$earlier_time = date('g.ia', $earlier);
	$earlier_date = date('Y-m-d', $earlier);
	$earlier_link = "whatson/guide/" . $station . "/" . $earlier_date . "/" . $earlier_time . "/" . $hours;

	$later = $current_time + $duration;
	$later_time = date('g.ia', $later);
	$later_date = date('Y-m-d', $later);
	$later_link = "whatson/guide/" . $station . "/" . $later_date . "/" . $later_time . "/" . $hours;

	$yesterday = $current_time - 86400;
	$yesterday_time = date('g.ia', $yesterday);
	$yesterday_date = date('Y-m-d', $yesterday);
	$yesterday_link = "whatson/guide/" . $station . "/" . $yesterday_date . "/" . $yesterday_time . "/" . $hours;

	$tomorrow = $current_time + 86400;
	$tomorrow_time = date('g.ia', $tomorrow);
	$tomorrow_date = date('Y-m-d', $tomorrow);
	$tomorrow_link = "whatson/guide/" . $station . "/" . $tomorrow_date . "/" . $tomorrow_time . "/" . $hours;

	// Current settings display string
	$start_time_display = date('g:i\a', $start_time);
	$end_time_display = date('g:i\a', $end_time);
	$current_display = date('l, F jS \f\r\o\m ' . $start_time_display .' \t\o ' .  $end_time_display, $current_time);

	// The navigation links
	$list[] = l(t('&laquo;&laquo; Yesterday'), "$yesterday_link", array('attributes' => array('class' => 'whats-on-guide-navigation-link'), 'html' => 'TRUE'));
	$list[] = l(t('&laquo; Earlier'), "$earlier_link", array('attributes' => array('class' => 'whats-on-guide-navigation-link'), 'html' => 'TRUE'));
	$list[] = l(t('Later  &raquo;'), "$later_link", array('attributes' => array('class' => 'whats-on-guide-navigation-link'), 'html' => 'TRUE'));
	$list[] = l(t('Tomorrow  &raquo;&raquo;'), "$tomorrow_link", array('attributes' => array('class' => 'whats-on-guide-navigation-link'), 'html' => 'TRUE'));

	// Prepare the array to show the date results
  $items = array(
		'#cache' => strtotime('now - 100000'),
    '#theme' => 'item_list',  // The theme function to apply to the #items
    '#items' => $list,  // The list itself.
    '#title' => t('<span class="whatson-guide-search-box-showing"><span>Currently Showing</span>: @v on @s | <span>Time Span</span>: @h hours</span>', array('@v' => $current_display, '@h' => $hours, '@s' => kued_program_guide_station_format($station))),
    '#prefix' => '<div class="whatson-guide-search-box-legend">',
    '#suffix' => '</div>',
  );

	// Put the pieces together
	$block_content['items'] = $items;

	return $block_content;
}


/**
 * This is the page display for the program guide.
 */
function kued_program_guide_arguments($station, $day, $time, $hours) {

	if($station == 'all-stations' || !strlen($station)) {
	$show_all = 1;
	//$station = 'All Stations';
	} else {
	$show_all = 0;
	}

	// Get the defaults or URL arguments
	if(!strlen($station)) {
		$guide_form_defaults = kued_program_guide_default();
			$time = $guide_form_defaults['time'];
			$day = $guide_form_defaults['date'];
			$hours = $guide_form_defaults['duration'];
			$station = $guide_form_defaults['station'];
			$extra_time = $guide_form_defaults['extra_time'];
			/*
			drupal_set_message(t('station: %v', array('%v' => $station)));
			drupal_set_message(t('day: %v', array('%v' => $day)));
			drupal_set_message(t('time: %v', array('%v' => $time)));
			drupal_set_message(t('hours: %v', array('%v' => $hours)));
			*/
		} else {
				$guide_form_defaults = kued_program_guide_default();
			$extra_time = $guide_form_defaults['extra_time'];	
		}

	$time_title_display = strtotime("$day " . "$time");
	$time_title_display = date('g:ia \o\n l F jS', $time_title_display);

	//Now that we have the info we can set the page title
	if(strlen(arg(2)) && !strlen(arg(3)) && !strlen(arg(4)) && !strlen(arg(5))) {
	drupal_set_title(t('What\'s On Program Guide on ' . kued_program_guide_station_format($station)));
	} elseif(strlen(arg(2)) && strlen(arg(3))) {
	drupal_set_title(t('What\'s On Program Guide | ' . $time_title_display. ' on ' . kued_program_guide_station_format($station)));
	}

	//Format the start and end times
	$start_time = strtotime("$day " . "$time");
	$duration = $hours * 3600;
	$end_time = $start_time + $duration;
/*
	$extra_time = 7200;*/
	$start_time_extra = $start_time - $extra_time;
	$end_time_extra = $end_time + $extra_time;

  $items = array();
	$items['form'] = drupal_get_form('kued_program_guide_search_form');
  $items['links'] = kued_program_guide_items();
  $items['hours'] = kued_program_guide_show_hours($station, $start_time, $end_time);

	$items['#prefix'] = '<div id="whatson-guide-display" class="whatson-guide-shows-display">';
	$items['#suffix'] = '</div>';
	//$items['#theme'] = 'theme_kued_program_guide';



	if($show_all == 0) {
		$items['station-'.$station] = kued_program_guide_show_station($station, $start_time, $end_time);
		$items[$station] = kued_program_guide_display($station, $start_time, $end_time, $start_time_extra, $end_time_extra);
		} elseif($show_all == 1) {
		$items['station-kued'] = kued_program_guide_show_station('kued', $start_time, $end_time);
		$items['kued'] = kued_program_guide_display('kued', $start_time, $end_time, $start_time_extra, $end_time_extra);
		
		$items['station-world'] = kued_program_guide_show_station('world', $start_time, $end_time);
		$items['world'] = kued_program_guide_display('world', $start_time, $end_time, $start_time_extra, $end_time_extra);
		
		$items['station-vme'] = kued_program_guide_show_station('v-me', $start_time, $end_time);
		$items['v-me'] = kued_program_guide_display('v-me', $start_time, $end_time, $start_time_extra, $end_time_extra);
		}

	//drupal_set_message('<pre>'.print_r($items, TRUE).'</pre>');

 return $items;
}

function kued_program_guide_show_station($station, $start_time, $end_time) {
$station = "$station";
	// Build the render array and send it to the template
  $list = array(
    'title' => t($station),
		'#theme' => 'kued_program_guide_title',
    '#prefix' => '<div id="whatson-guide-title-box">',
    '#suffix' => '</div>',
  );
return $list;
}
function template_preprocess_kued_program_guide_title(&$vars) {
	// Move items to the template
	$vars['title_display'] = kued_program_guide_station_format($vars['element']['title']);
	$vars['title'] = $vars['element']['title'];
}



/**
 * Build the hours display div
 */
function kued_program_guide_show_hours($station, $start_time, $end_time) {
	// Get the defaults
	$guide_form_defaults = kued_program_guide_default();
		$time = $guide_form_defaults['time'];
		$day = $guide_form_defaults['date'];
		$hours = $guide_form_defaults['duration'];
		$station = $guide_form_defaults['station'];
		$full_width = $guide_form_defaults['full_width'];
		$table_width = $guide_form_defaults['table_width'];

/*
			drupal_set_message(t('station: %v', array('%v' => $station)));
			drupal_set_message(t('day: %v', array('%v' => $day)));
			drupal_set_message(t('time: %v', array('%v' => $time)));
			drupal_set_message(t('hours: %v', array('%v' => $hours)));
*/

	// Build hours block	
	$start_time = strtotime($day . " " . $time);
	$hours_blocks = $hours * 2;
	$duration = $end_time - $start_time;
	$program_start_time = $start_time;
	$start_seconds = '';
	
	// Display the blocks using the same math as the programs
	$i = 0;
	while($i < $hours_blocks) {
		$start_seconds = $program_start_time - $start_time;
		$start_percent = $start_seconds / $duration;
		$start_position[] = round($start_percent * $table_width);
		$items[] = t(date('g:i A', $program_start_time));
		$program_start_time = $program_start_time + 1800;
		$i++;
		}

	// Build the render array and send it to the template
  $list = array(
    '#items' => $items,
    'station' => $station,
    'full_width' => $full_width,
		'start_position' => $start_position,
		'#theme' => 'kued_program_guide_hours',
    '#prefix' => '<div id="whatson-guide-hours-box">',
    '#suffix' => '</div>',
  );
return $list;
}



/**
 * Impliments hook_preprocess();
 */
function template_preprocess_kued_program_guide_hours(&$vars) {
	// Move the times into an array	
	$vars['hour_block'] = array();
	$time_block = $vars['element']['#items'];
		foreach($time_block as $value) {
		$vars['time_block'] = $vars['element']['#items'];
		}
	// Do the math on the cell width
	$full_width = $vars['element']['full_width'];
	$cells = count($time_block); // Count the number of cells
	// Get the cell width - becomes a hard-coded CSS width
	$vars['cell_width'] = round($full_width / $cells);
	$vars['start_position'] = $vars['element']['start_position'];
}



/*
function template_preprocess_kued_program_guide_nodes(&$variables) {

  //$title = $variables['title'];
  $items = $var['items'];

//drupal_set_message('<pre>'.print_r($var, TRUE).'</pre>');

  $var = array(
    'items' => $items,
    //'title' => $title,
    'type' => 'ol',
    'attributes' => array('class' => 'theming-example-list'),
  );
  $output = theme('item_list', $var);
  return $output;

}
*/




/**
 * Function to select and display the Program Guide Content
 */
function kued_program_guide_display($station, $start_time, $end_time, $start_time_extra, $end_time_extra) {

/*
//drupal_set_message(t('url: %v', array('%v' => url($_GET['q'], array('alias' => 'false', 'absolute' => 'true')))));
$url_check = url($_GET['q'], array('alias' => 'false', 'absolute' => 'true'));
$needle = 'whatson/guide';
$url_check_validate = strpos($url_check, $needle);
if ($url_check_validate === false) {
	drupal_set_message(t('disabled!'));
	} else {
	drupal_set_message(t('url: %v', array('%v' => $url_check)));
	}
*/

			//drupal_set_message(t('programs start time: %v', array('%v' => $start_time)));
			//drupal_set_message(t('programs end time: %v', array('%v' => $end_time)));

	$station_search = kued_program_guide_station_filter($station);

	$items = array();
	$items['#prefix'] = '<div id="whatson-guide-shows-' . $station . '" class="whatson-guide-shows-' . $station . '">';
	$items['#suffix'] = '</div>';
	//$items['#theme'] = 'kued_program_guide_nodes';


	// This is the big query to select all the items we'll show here.
	$query_print = "SELECT DISTINCT unix_timestamp(a.fulldate) AS fulldate, a.series_id, a.program_id, a.version_id, a.rebroadcast, a.channel, s.entity_id AS series_nid, p.entity_id AS program_nid
FROM protrack_airlist AS a
LEFT JOIN field_data_field_series_id AS s ON a.series_id = s.field_series_id_value
LEFT JOIN field_data_field_version_id AS p ON a.version_id = p.field_version_id_value
WHERE (unix_timestamp(fulldate) BETWEEN $start_time AND $end_time) AND channel = '$station_search' ORDER BY fulldate ASC";

//drupal_set_message('<pre>'.print_r($query_print, TRUE).'</pre>');

	// This is the big query to select all the items we'll show here.
	$query = "SELECT DISTINCT unix_timestamp(a.fulldate) AS fulldate, a.series_id, a.program_id, a.version_id, a.rebroadcast, a.channel, s.entity_id AS series_nid, p.entity_id AS program_nid
		FROM {protrack_airlist} AS a
		LEFT JOIN field_data_field_series_id AS s ON a.series_id = s.field_series_id_value
		LEFT JOIN field_data_field_version_id AS p ON a.version_id = p.field_version_id_value
		WHERE (unix_timestamp(fulldate) BETWEEN :start_time AND :end_time) AND channel = :station ORDER BY fulldate ASC";
	// Limiting items that we're looking for.
	$query_array = array(':start_time' => $start_time_extra, ':end_time' => $end_time_extra, ':station' => $station_search);
	
	$i = 1;
	// Execute the query and build the search loop
	$airlist_result = db_query($query, $query_array);
	while($row = $airlist_result->fetchAssoc()) {

		// Get the length to filter results
		$query = "SELECT field_episode_length_value FROM {field_data_field_episode_length} WHERE entity_id = :nid";
		$query_array = array(':nid' => $row['program_nid']);
		// Get length
		$length = db_query($query, $query_array)->fetchField();
		$length = kued_program_guide_length_seconds($length);
		$show_start = $row['fulldate'];
		$show_end = $show_start + $length;
		//drupal_set_message('<pre>length: '.print_r($length, TRUE).'</pre>');
		//drupal_set_message('<pre>start '.print_r($show_start, TRUE).'</pre>');
		//drupal_set_message('<pre>end '.print_r($show_end, TRUE).'</pre>');

		// Filter the results
		if($show_end > $start_time && $show_start < $end_time) {
			// Open the node
			$node = node_load($nid = $row['program_nid'], $vid = NULL, $reset = TRUE);
			//drupal_set_message('<pre>start '.print_r($show_start, TRUE).'</pre>');
			$move_fulldate['value'] = $show_start;
			$node->move_fulldate = $move_fulldate;
			//drupal_set_message('<pre>end '.print_r($node->move_fulldate, TRUE).'</pre>');
			//drupal_set_message('<pre>'.print_r($node, TRUE).'</pre>');
			$items[] = node_view($node, 'kued_program_guide_list'); // This is where we show the custom content view for program guide items
			$i++;
		}
	}

	if(isset($items)) {
		return $items;
	}
}

/**
 * Implements hook_entity_info_alter().
 *
 * This enables a custom display just for the program guide
 *
 */
function kued_program_guide_entity_info_alter(&$entity_info) {
  $entity_info['node']['view modes']['kued_program_guide_list'] = array(
    'label' => t('Program Guide List Display'),
    'custom settings' => TRUE,
  );
}


/**
* Implements hook_preprocess_node()
*/
//function kued_program_guide_preprocess_node(&$vars, $node, $station, $day, $time, $hours) {
function kued_program_guide_preprocess_node(&$vars) {
$vars['theme_hook_suggestions'][] = 'node__' . $vars['type'] . '__' . $vars['view_mode'];

	// Get the defaults or URL arguments
	$guide_form_defaults = kued_program_guide_default();
		$time = $guide_form_defaults['time'];
		$day = $guide_form_defaults['date'];
		$hours = $guide_form_defaults['duration'];
		$station = $guide_form_defaults['station'];
		$table_width = $guide_form_defaults['table_width'];
		$border_width = $guide_form_defaults['border_width'];
		$full_width = $guide_form_defaults['full_width'];
		$extra_time = $guide_form_defaults['extra_time'];

	if(isset($vars['node']->move_fulldate['value'])) {
		$move_fulldate = $vars['node']->move_fulldate['value'];
		$vars['fdarray'] = $vars['node']->move_fulldate['value'];
		$vars['move_fulldate'] = $move_fulldate;
		} else {
		$vars['move_fulldate'] = strtotime("$day" . " " . "$time");
		}

	// Prepare times
	$vars['start_time'] = strtotime("$day" . " " . "$time");
	$vars['duration'] = $hours * 3600;
	$vars['end_time'] = $vars['start_time'] + $vars['duration'];

	$vars['start_time_extra'] = $vars['start_time'] - $extra_time;
	$vars['end_time_extra'] = $vars['end_time'] + $extra_time;

	// Prepare Series Link:
	$vars['series_nid'] = $vars['node']->field_series_link['und']['0']['nid'];
	$vars['series_location'] = drupal_lookup_path('alias',"node/" . $vars['series_nid']);
	$vars['series_title'] = $vars['node']->field_series_link['und']['0']['node']->title;
	$vars['series_link'] = '<a href="/' . $vars['series_location'] . '" title="' . $vars['series_title'] . '">' . $vars['series_title'] . '</a>';
	
	// Prepare Episode link:
	$vars['episode_nid'] = $vars['nid'];
	$vars['episode_title'] = $vars['title'];
	$vars['episode_location'] = drupal_lookup_path('alias',"node/" . $vars['episode_nid']);
	$vars['episode_link'] = '<a href="/' . $vars['episode_location'] . '" title="' . $vars['episode_title'] . '">' . $vars['episode_title'] . '</a>';
	
	// Prepare other variables
	if(isset($vars['node']->field_version_id['und']['0']['value'])) {
		$vars['version_id'] = $vars['node']->field_version_id['und']['0']['value'];
	}
	if(isset($vars['node']->field_program_id['und']['0']['value'])) {
		$vars['program_id'] = $vars['node']->field_program_id['und']['0']['value'];
	}
	if(isset($vars['node']->field_episode_length['und']['0']['value'])) {
		$vars['length'] = $vars['node']->field_episode_length['und']['0']['value'];
		$vars['length_seconds'] = kued_program_guide_length_seconds($vars['length']);
	}
	if(isset($vars['node']->field_episode_guide['und']['0']['value'])) {
		$vars['guide'] = $vars['node']->field_episode_guide['und']['0']['value'];
	}
	if(isset($vars['node']->field_episode_rating['und']['0']['taxonomy_term']->name)) {
		$vars['rating'] = $vars['node']->field_episode_rating['und']['0']['taxonomy_term']->name;
	}
	if(isset($vars['node']->field_episode_caption['und']['0']['value'])) {
		$vars['closed_caption'] = $vars['node']->field_episode_caption['und']['0']['value'];
			if($vars['closed_caption'] == 1) {
			$vars['closed_caption'] = 'Yes';
			} else {
			$vars['closed_caption'] = '';
			}
	}
	if(isset($vars['node']->field_channel['und']['0']['taxonomy_term']->name)) {
		$vars['station'] = $vars['node']->field_channel['und']['0']['taxonomy_term']->name;
	}

	// Get the record from the Airlist
	//$query = "SELECT * FROM {protrack_airlist} WHERE (unix_timestamp(fulldate) BETWEEN :start_time_extra AND :end_time_extra) AND program_id = :program_id";
	//$query_array = array(':program_id' => $vars['program_id'],':start_time_extra' => $vars['start_time_extra'],'end_time_extra' => $vars['end_time_extra']);
	$query = "SELECT * FROM {protrack_airlist} WHERE unix_timestamp(fulldate) = :fulldate AND program_id = :program_id";
	$query_array = array(':program_id' => $vars['program_id'],':fulldate' => $vars['move_fulldate']);

	//Check to see if this series_id already exists, get the entity_id
	$result = db_query($query, $query_array);
	$record = $result->fetchAssoc();
	//while($record = $result->fetchAssoc()) { $vars['record'] = $record; }
	$vars['record'] = $record;
	$vars['fulldate'] = $record['fulldate'];
	$vars['rebroadcast'] = $record['rebroadcast'];
	$vars['fulldate_timestamp'] = strtotime($vars['fulldate']);

	// Format the timestamp display
	if($vars['start_time'] > $vars['fulldate_timestamp']) {
		$vars['fulldate_display'] = 'Began at ' . date('g:i A', $vars['fulldate_timestamp']);
	} else {
		$vars['fulldate_display'] = date('g:i A', $vars['fulldate_timestamp']);
	}
	
	if($vars['rebroadcast'] != 'Repeat') {
		$vars['rebroadcast'] = 'New';
		}

	$vars['show_start_time'] = strtotime($vars['fulldate']);
	$vars['show_length'] = $vars['length_seconds'];
	$vars['show_end_time'] = $vars['fulldate_timestamp'] + $vars['length_seconds'];
	$vars['show_percent'] = round($vars['show_length'] / $vars['duration'], 2);

	$vars['table_width'] = $table_width;
	$vars['show_width'] = floor($vars['table_width'] * $vars['show_percent']) - 15; // Get the table width.  Give it a few px of padding

	// Show the correct widths of the tables
  if(($vars['show_start_time'] - $vars['start_time']) > 0) {
    $vars['show_start_position'] =  round($vars['table_width'] * (($vars['show_start_time'] - $vars['start_time']) / $vars['duration']));
    } else {
		// Show the correct width of the table and content for the very first item shown.
    $vars['show_start_position'] =  round($vars['table_width'] * (($vars['show_start_time'] - $vars['start_time']) / $vars['duration']));
    $vars['show_width'] = $vars['show_start_position'] + $vars['show_width'];
    $vars['show_start_position'] = 0;
  }

  // Make sure the final item doesn't overflow
  if($vars['show_width'] + $vars['show_start_position'] > $vars['table_width']) {
    $vars['show_width'] = ($vars['table_width'] - 20) - $vars['show_start_position'];
  }
}



/**
* Implements hook_preprocess_page().
*/
function kued_program_guide_preprocess_block(&$vars) {
//$vars['theme_hook_suggestions'][] = 'block__' . $vars['block']->region;
//$vars['theme_hook_suggestions'][] = 'block__' . $vars['block']->module;

$vars['theme_hook_suggestions'][] = 'block__kued_program_guide__display';

//$vars['title'] = 'new junk';

//$vars['something'][] = "STOLEN";

//drupal_set_message('preprocess');

//drupal_set_message('<pre>'.print_r($vars['page']['content']['content']['content']['system_main']['0']['node_list']['0'], TRUE).'</pre>');

//drupal_set_message('<pre>'.print_r($node, TRUE).'</pre>');

//$vars['my_var'] = '<span>this is my var</span>';
}


/**
* Implements hook_preprocess_page().
*/
function kued_program_guide_preprocess_page(&$vars) {
//$vars['theme_hook_suggestions'][] = 'page__' . $vars['type'] . '__' . $vars['view_mode'];
}






/**
* Convert time to half-hour spans of time
*/
function kued_program_guide_format_time() {
	//Get half-hour interval
	$half_hour_check  = date('i');
	if($half_hour_check >= 30) {
		$time  = date(mktime(date('H'), 0 + 30, 0, date('m'), date('d'), date('Y')));
		} else {
		$time  = date(mktime(date('H'), 0, 0, date('m'), date('d'), date('Y')));
	}
	$time = date('g.ia', $time);
	return $time;
}


/**
 * Build array for program guide duration - 8 hour span
 */
function kued_program_guide_select_duration() {
	$duration = array();
	$hours = "";
	for($i = 1; $i <6; $i++) {
		$hours = $hours + 1;
		$hours_title = "Now showing " . $hours . " hours";
		$duration[$hours] = $hours_title;
	}
	return $duration;
}

/**
 * Build array for program guide date range list - 7 days past, 30 days future
 */
function kued_program_guide_select_date() {
	//build array of times.
	$select_days = array();
	$select_day = strtotime("-10 days");

		for($i = 1; $i < 47; $i++) {
			$select_day = strtotime("+ 1 day", $select_day);
			$key = date("Y-m-d", $select_day);
			$select_days[$key] = t(date("l, F jS", $select_day));
		}
	return $select_days;
}

/**
* Build array of 1/2 hour blocks for time select
*/
function kued_program_guide_select_time() {
	//Format the time data 
	//build array of times.
	$select_times = array();
	$select_time = strtotime("00:00");

	for($i = 1; $i < 48; $i++) {
		$select_time = strtotime("+ 30 minutes", $select_time);
		$key = date("g.ia", $select_time);
		$select_times[$key] = t(date("g:i a", $select_time));
	}
	return $select_times;
}




/**
* Get form/display defaults if the URL is not built yet
*/
function kued_program_guide_default() {

//	if(!strlen(arg(2)) || arg(2) == 'menu' || arg(2) == 'list' || arg(2) == 'status') { // if arg(2) == menu defeats the drupal argument that sneaks in.
	if(!strlen(arg(2))) { // if arg(2) == menu defeats the drupal argument that sneaks in.
		$guide_form_defaults['station'] = 'all-stations';
		} else {
		$guide_form_defaults['station'] = arg(2);
		}
	
	if(!strlen(arg(3))) {
		$guide_form_defaults['date'] = date('Y-m-d', strtotime('now'));
		} else {
		$guide_form_defaults['date'] = arg(3);
		}

	if(!strlen(arg(4))) {
		$guide_form_defaults['time'] = kued_program_guide_format_time();
		} else {
		$guide_form_defaults['time'] = arg(4);
		}
	
	if(!strlen(arg(5))) {
		$guide_form_defaults['duration'] = '3';
		} else {
		$guide_form_defaults['duration'] = arg(5);
		}

	// Set the table width then remove space for the CSS added border widths...sort of cheezy but it works
	$guide_form_defaults['extra_time'] = 7200;
	$guide_form_defaults['table_width'] = 680;
	$guide_form_defaults['border_width'] = $guide_form_defaults['duration'] * 1;
	$guide_form_defaults['full_width'] = $guide_form_defaults['table_width'] - $guide_form_defaults['border_width'];

	//drupal_set_message(t('station: %v', array('%v' => $guide_form_defaults['station'])));

	return $guide_form_defaults;
}


/**
 * Converts program length into seconds
 */
function kued_program_guide_length_seconds($time) {
    $hours = substr($time, 0, -6);
    $minutes = substr($time, -5, 2);
    $seconds = substr($time, -2);
    return $hours * 3600 + $minutes * 60 + $seconds;
}


/**
 * Always make sure we inject the correct channel variable into the search
 */
function kued_program_guide_station_filter($station) {
switch ($station) {
	case 'kued':
	case 'KUED':
		$station = 'KUED-HD';
		break;
	case 'world':
	case 'World':
	case 'WORLD':
	case 'the world':
	case 'The World':
		$station = 'WORLD';
		break;
	case 'v-me':
	case 'V-me':
	case 'V-Me':
	case 'V-ME':
		$station = 'V-ME';
		break;
	default:
		$station = 'KUED-HD';
	break;
	}
return $station;
}

/**
 * Format the station name display
 */
function kued_program_guide_station_format($station) {
switch ($station) {
	case 'kued':
	case 'KUED':
		$station = 'KUED';
		break;
	case 'world':
	case 'World':
	case 'WORLD':
	case 'the world':
	case 'The World':
		$station = 'The World';
		break;
	case 'v-me':
	case 'V-me':
	case 'V-Me':
	case 'V-ME':
		$station = 'V-Me';
		break;
	case 'All-Stations':
	case 'all-stations':
	case 'All Stations':
	case 'all stations':
		$station = 'All Stations';
		break;
	default:
		$station = 'KUED';
	break;
	}
return $station;
}

/**
 * @} End of "defgroup kued_program_guide".
 */

?>