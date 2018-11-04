<?php
 /* -------------------------------------------------- */
  /* -- code-snippets aus dem plugin "Codeschnipsel" -- */
  /* -------------------------------------------------- */

/* -------------------------------------------------------------------------------------------------------- */

  /* Länge der Kurzbeschreibung verändern - S. 274, wordpress-Buch */
  function new_excerpt_length($length) {
  return 40;
  }
  add_filter('excerpt_length', 'new_excerpt_length');

/* -------------------------------------------------------------------------------------------------------- */

  /* google_maps - Code-Snippet aus Wordpress-Buch, S.276 */
  function googlemapshortcode($atts, $content = null) {
  extract(shortcode_atts(array(
        "width" => '300',
        "height" => '400',
        "src" => ''
  ), $atts));
  return '<div><iframe src="'.$src.'&output=embed" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="'.$width.'" height="'.$height.'"></iframe></div> ';
  }
  add_shortcode("googlemap", "googlemapshortcode");

/* -------------------------------------------------------------------------------------------------------- */

  /* Funktion für pronamic google maps - pronamic */
  if ( function_exists( 'pronamic_google_maps' ) ) {
    pronamic_google_maps( array(
        'width'  => 290,
        'height' => 200
    ) );
  }


/* -------------------------------------------------------------------------------------------------------- */



/* -------------------------------------------------------------------------------------------------------- */

  /* die letzten sticky posts zeigen - Aus http://www.wpbeginner.com/wp-tutorials/how-to-display-the-latest-sticky-posts-in-wordpress/ */
  function wpb_latest_sticky() {
  /* Get all sticky posts */
  $sticky = get_option( 'sticky_posts' );
  /* Sort the stickies with the newest ones at the top */
  rsort( $sticky );
  /* Get the 5 newest stickies (change 5 for a different number) */
  $sticky = array_slice( $sticky, 0, 3 );
  /* Query sticky posts */
  $the_query = new WP_Query( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ) );
  // The Loop
  if ( $the_query->have_posts() ) {
  	$return .= '<ul>';
  	while ( $the_query->have_posts() ) {
  		$the_query->the_post();
  		$return .= '<li><h5><a href="' .get_permalink(). '" title="'  . get_the_title() . '">' . get_the_title() . '</a></h5><br />' . get_the_excerpt(). '</li>';
  	}
  	$return .= '</ul>';
  } else {
  	// no posts found
  }
  return $return;
}



/* -------------------------------------------------------------------------------------------------------- */


/* -------------------------------------------------------------------------------------------------------- */

  /* Sprachdateien für the events calendar sichern - http://www.perun.net/2015/07/31/sprachdateien-von-wordpress-plugins-anpassen-und-vor-dem-ueberschreiben-schuetzen/ */
  add_action('load_textdomain', 'load_custom_language_files_for_my_plugin', 10, 2);
  function load_custom_language_files_for_my_plugin($domain, $mofile)
  {
    // Note: the plugin directory check is needed to prevent endless function nesting
    // since the new load_textdomain() call will apply the same hooks again.
  	/*
    if ('tribe-events-calendar' === $domain && plugin_dir_path($mofile) === WP_PLUGIN_DIR.'/the-events-calendar/lang/')
    {
		load_textdomain('tribe-events-calendar', WP_LANG_DIR.'/the-events-calendar/'.$domain.'-'.get_locale().'.mo');
    }
	*/
  	// Dabei gilt Ordnername = the-events-calendar und Textdomain = tribe-events-calendar!
    if ('tribe-events-community' === $domain && plugin_dir_path($mofile) === WP_PLUGIN_DIR.'/the-events-calendar-community-events/lang/')
    {
		load_textdomain('tribe-events-community', WP_LANG_DIR.'/the-events-calendar-community-events/'.$domain.'-'.get_locale().'.mo');
    }

  }


/* -------------------------------------------------------------------------------------------------------- */

  /* Zusätzliche Felder im Kalender nicht zeigen - https://theeventscalendar.com/knowledgebase/hide-all-custom-fields/ */
  add_action('tribe_get_custom_fields','tribe_hide_custom_meta', 100);
  function tribe_hide_custom_meta() {
      //If viewing a single event, then return no data
      if( tribe_is_event() && !is_admin() ) {
          return '';
      }
  }

/* -------------------------------------------------------------------------------------------------------- */
/* Funktion aus Wordpress Praixs, S. 271
/* -------------------------------------------------------------------------------------------------------- */
add_filter('widget_text', 'jetztgibmirphp', 99); 
function jetztgibmirphp($text) {
if (strpos($text, '<'. '?') !== false) { ob_start();
eval('?'. '>'. $text);
$text = ob_get_contents(); ob_end_clean();
}
return $text; }