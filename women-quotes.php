<?php

/*
 *
 *	Plugin Name: Women Quotes
 *	Plugin URI: http://www.joeswebtools.com/wordpress-plugins/women-quotes/
 *	Description: Adds a sidebar widget that displays randomly women's quotes about womanhood and "being women".
 *	Version: 2.0.2
 *	Author: Joe's Web Tools
 *	Author URI: http://www.joeswebtools.com/
 *
 *	Copyright (c) 2008-2014 Joe's Web Tools. All Rights Reserved.
 *
 *	This program is free software; you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License as published by
 *	the Free Software Foundation; either version 2 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program; if not, write to the Free Software
 *	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 *	If you are unable to comply with the terms of this license,
 *	contact the copyright holder for a commercial license.
 *
 *	We kindly ask that you keep the link to Da Vinci's Muse as
 *	they did all the hard work gathering and sorting the quotes.
 *
 */





/*
 *
 *	women_quotes_shortcode_handler
 *
 */

function women_quotes_shortcode_handler($atts, $content = nul) {

	// Get the raw quote
	$quote_array = file(dirname(__FILE__) . '/women-quotes.dat');
	$quote_random = rand(0, sizeof($quote_array) - 5) + 4;
	$quote = explode('<separator>', $quote_array[$quote_random]);

	// Create the quote
	$content = '<div style="text-align: justify;">' . $quote[0] . '</div>';
	$content .= '<div style="text-align: right;"><i>' . $quote[1] . '</i></div>';

	return $content;
}





/*
 *
 *	WP_Widget_Women_Quotes
 *
 */

class WP_Widget_Women_Quotes extends WP_Widget {

	function WP_Widget_Women_Quotes() {

		parent::WP_Widget(false, $name = 'Women Quotes');
	}

	function widget($args, $instance) {

		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? 'Women Quotes' : $instance['title']);

		echo $before_widget;
		echo $before_title . $title . $after_title;

		// Get the raw quote
		$quote_array = file(dirname(__FILE__) . '/women-quotes.dat');
		$quote_random = rand(0, sizeof($quote_array) - 5) + 4;
		$quote = explode('<separator>', $quote_array[$quote_random]);

		// Create the quote
		echo '<div style="text-align: justify;">' . $quote[0] . '</div>';
		echo '<div style="text-align: right;"><i>' . $quote[1] . '</i></div>';
		echo '<div style="text-align: center;"><font face="arial" size="-3"><a href="http://www.joeswebtools.com/wordpress-plugins/women-quotes/" title="Women Quotes widget plugin for WordPress">Joe\'s</a></font></div>';

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {

		return $new_instance;
	}

	function form($instance) {

		$title = esc_attr($instance['title']);

		echo '<p>';
		echo 	'<label for="' . $this->get_field_id('title') . '">Title: </label>';
		echo 	'<input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" />';
		echo '</p>';
	}
}





/*
 *
 *	Installation code
 *
 */

add_shortcode('women-quotes', 'women_quotes_shortcode_handler');
add_action('widgets_init', create_function('', 'return register_widget("WP_Widget_Women_Quotes");'));

?>