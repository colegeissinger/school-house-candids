<?php
	/*
		Plugin Name: SHC Extensions
		Plugin URI: http://www.schoolhousecandids.com/
		Description: Companion plugin for School House Candids' WordPress theme. THis provides the custom homepage interface and provides the testimonial functionality/shortcode
		Version: 0.1
		Author: Cole Geissinger
		Author URI: http://www.colegeissinger.com
		Text Domain: shc_ext
		License: GPLv2 or later

		Copyright 2013 Cole Geissinger (cole@colegeissinger.com)

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

	// Load our testimonial CPT
	require_once( 'post-types/testimonial.php' );

	// Load up our custom page template
	require_once( 'home-page/template-loader.php' );