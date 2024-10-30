<?php
/*
Plugin Name: Hash Converter
Plugin URI:  http://awplife.com
Description: Hashing Power Calculator. Use this shortcode to show Hash Converter On your page - '[AWL-HC]'
Version:     1.0.23
Author:      A WP Life
Author URI:  https://developer.wordpress.org/
Text Domain: hash-converter
Domain Path: /languages
License:     GPL2
 
Hash Converter is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Hash Converter is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Hash Converter. If not, see https://developer.wordpress.org/plugins/the-basics/including-a-software-license/.
*/

//Plugin Version
define( 'HC_PLUGIN_VER', '1.0.23' );

//Plugin Text Domain
define("HC_TXTDM","hash-converter");

//Plugin Name
define( 'HC_PLUGIN_NAME', __( 'Hash Converter', HC_TXTDM ) );

//Plugin Slug
define( 'HC_PLUGIN_SLUG', 'hash_converter');

//Plugin Directory Path
define( 'HC_PLUGIN_DIR', plugin_dir_path(__FILE__) );

//Plugin Directory URL
define( 'HC_PLUGIN_URL', plugin_dir_url(__FILE__) );

//Shortcode Compatibility in Text Widegts
add_filter( 'widget_text', 'do_shortcode');

add_shortcode( 'AWL-HC', 'hash_converter_shortcode' );
// hash converter shortcode
function hash_converter_shortcode( $atts ){
	ob_start();
	// plugin svn - https://plugins.svn.wordpress.org/hash-converter
	// https://bitcoin.stackexchange.com/questions/18629/what-is-the-algorithm-to-create-a-bitcoin-mining-calculator
	// https://bitcoin.stackexchange.com/questions/9219/what-is-the-difference-between-kh-s-mh-s-and-gh-s/9220
	
	wp_enqueue_script('jquery');
	wp_enqueue_style('hash-converter-styles', HC_PLUGIN_URL . 'hash-converter-bootstrap.css');
	?>
	<div class="row">
		<div class="col-md-12">
			<p>Hash Rate</p> 
			<p><input type="number" id="hash_rate" name="hash_rate" placeholder="Hash Rate In Numeric"></p>
		</div>
		<div class="col-md-12">
			<p>Convert into Hash Unit</p> 
			<p>
				<select id="hash_unit" name="hash_unit">
					<option value="kh">kH/s</option>
					<option value="mh">MH/s</option>
					<option value="gh">GH/s</option>
					<option value="th">TH/s</option>
					<option value="ph">PH/s</option>
					<option value="eh">EH/s</option>
					<option value="zh">ZH/s</option>
					<option value="yh">YH/s</option>
				</select>
			</p>
		</div>
		<div class="col-md-12">
			<p><button id="convert_hash" name="convert_hash" class="btn btn-primary" onclick="return calc_hash();">Calculate</button>
			<input type="reset" id="reset" name="reset" class="btn btn-default" onclick="return calc_hash_reset();" /></p>
		</div>
		<div class="col-md-12">
			<p>Converted Hash Rate</p> 
			<h3 id="converted_hash_rate" name="converted_hash_rate"></h3>
		</div>
	</div>
	
	<script>
	function calc_hash(){
		//units
		var $kh = 1000;
		var $mh = 1000000; //(one million) hashes per second
		var $gh = 1000000000; //(one billion) hashes per second
		var $th = 1000000000000;  //(one trillion) hashes per second
		var $ph = 1000000000000000; //(one quadrillion) hashes per second
		var $eh = 1000000000000000000; //(one quintillion) hashes per second
		var $zh = 1000000000000000000000; //(one sextillion) hashes per second
		var $yh = 1000000000000000000000000; //(one septillion) hashes per second
		var result = 0;
		
		var hash_rate = jQuery("#hash_rate").val();	// user input hash rate
		var hash_unit = jQuery("#hash_unit").val(); // user selected hash unit
		
		if(!hash_rate){
			jQuery("#hash_rate").focus();
			return false;
		}		
		
		//kh
		if(hash_unit == "kh"){
			result = hash_rate/$kh;
			result = result.toFixed(8);
			result = hash_rate + ' hash is equal to ' + result + 'kH';
		}
		
		//mh
		if(hash_unit == "mh"){
			result = hash_rate/$mh;
			result = result.toFixed(8);
			result = hash_rate + ' hash is equal to ' + result + 'MH';
		}
		
		//gh
		if(hash_unit == "gh"){
			result = hash_rate/$gh;
			result = result.toFixed(8);
			result = hash_rate + ' hash is equal to ' + result + 'GH';
		}
		
		//th
		if(hash_unit == "th"){
			result = hash_rate/$th;
			result = result.toFixed(8);
			result = hash_rate + ' hash is equal to ' + result + 'TH';
		}
		
		//ph
		if(hash_unit == "ph"){
			result = hash_rate/$ph;
			result = result.toFixed(8);
			result = hash_rate + ' hash is equal to ' + result + 'PH';
		}
		
		//eh
		if(hash_unit == "eh"){
			result = hash_rate/$eh;
			result = result.toFixed(8);
			result = hash_rate + ' hash is equal to ' + result + 'EH';
		}
		
		//zh
		if(hash_unit == "zh"){
			result = hash_rate/$zh;
			result = result.toFixed(8);
			result = hash_rate + ' hash is equal to ' + result + 'ZH';
		}
		
		//yh
		if(hash_unit == "yh"){
			result = hash_rate/$zh;
			result = result.toFixed(8);
			result = hash_rate + ' hash is equal to ' + result + 'YH';
		}
		
		if(result){
			//alert(result);
			jQuery("h3#converted_hash_rate").text(result);
		}
	}
	
	function calc_hash_reset(){		
		jQuery("#hash_rate").val("");
		jQuery("#hash_rate").focus();
	}	
	</script>
	<?php
	return ob_get_clean();
}

?>