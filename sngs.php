<?php

/**
 * @package Site_Name_For_Google_Search
 */
/*
Plugin Name: Site Name for Google Search 
Plugin URI: http://gtmanagement.com
Description: Adds the Site Name structured data for Googles Search.
Version: 1.0.0
Author: Glenn Tate
Author URI: http://www.gtmanagement.com
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

add_action( 'admin_menu', 'sngs_add_admin_menu' );
add_action( 'admin_init', 'sngs_settings_init' );


function sngs_add_admin_menu(  ) { 

	add_options_page( 'Site Name for Google Search', 'Site Name for Google Search', 'manage_options', 'site_name_for_google_search', 'sngs_options_page' );

}


function sngs_settings_init(  ) { 

	register_setting( 'pluginPage', 'sngs_settings' );

	add_settings_section(
		'sngs_pluginPage_section', 
		__( 'Site name requirements', 'wordpress' ), 
		'sngs_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'sngs_text_field_0', 
		__( 'WebSite Name', 'wordpress' ), 
		'sngs_text_field_0_render', 
		'pluginPage', 
		'sngs_pluginPage_section' 
	);

	add_settings_field( 
		'sngs_text_field_1', 
		__( 'Alternate WebSite Name', 'wordpress' ), 
		'sngs_text_field_1_render', 
		'pluginPage', 
		'sngs_pluginPage_section' 
	);

add_settings_field( 
		'sngs_text_field_2', 
		__( 'WebSite Full URL (http://) ', 'wordpress' ), 
		'sngs_text_field_2_render', 
		'pluginPage', 
		'sngs_pluginPage_section' 
	);

}


function sngs_text_field_0_render(  ) { 

	$options = get_option( 'sngs_settings' );
	?>
	<input type='text' size ='40' name='sngs_settings[sngs_text_field_0]' value='<?php echo $options['sngs_text_field_0']; ?>'>
	<?php

}


function sngs_text_field_1_render(  ) { 

	$options = get_option( 'sngs_settings' );
	?>
	<input type='text' size ='40' name='sngs_settings[sngs_text_field_1]' value='<?php echo $options['sngs_text_field_1']; ?>'>
	<?php

}

function sngs_text_field_2_render(  ) { 

	$options = get_option( 'sngs_settings' );
	?>
	<input type='text' size ='40' name='sngs_settings[sngs_text_field_2]' value='<?php echo $options['sngs_text_field_2']; ?>'>
	<?php

}


function sngs_settings_section_callback(  ) { ?>

	<p>First, the website names you supply in your markup should meet the following criteria: </br>
</br>
Be reasonbly similar to your domain name</br>
Be a natural name used to refer to the site, such as "Google," rather than "Google, Inc."</br>
Be unique to your site ie: not used by some other site</br>
Not be a misleading description of your site</p>



<?php
}


function sngs_options_page(  ) { 

	?>
	<form action='options.php' class="form-table" method='post'>
		
		<h2>Include Your Site Name in Search Results</h2>
		
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		
	</form>


	<?php

}

add_action('wp_head', 'sngs_script');

function sngs_script() {
$options = get_option( 'sngs_settings' );



?>

<script type="application/ld+json">
    {  "@context" : "http://schema.org",
       "@type" : "WebSite",
       "name" : "<?php echo $options['sngs_text_field_0']; ?>",
       "alternateName" : "<?php echo $options['sngs_text_field_1']; ?>",
       "url" : "<?php echo $options['sngs_text_field_2']; ?>",
    }
    </script>
<?php



}
 


?>