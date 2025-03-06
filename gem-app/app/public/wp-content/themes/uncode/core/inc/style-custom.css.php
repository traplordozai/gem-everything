<?php

global $front_background_colors, $menutype;

/****
/   Load theme options
*****/

if ( is_multisite() ) {
	$uncode_option = get_blog_option( get_current_blog_id(), ot_options_id() );
} else {
	$uncode_option = get_option(ot_options_id());
}

if (empty($uncode_option)) {
	echo 'exit';
	return;
}

$cs_logo_color_light = $uncode_option['_uncode_logo_color_light'];
$cs_menu_color_light = $uncode_option['_uncode_menu_color_light'];
$cs_menu_bg_color_light = $uncode_option['_uncode_menu_bg_color_light'];
$cs_submenu_bg_color_light = $uncode_option['_uncode_submenu_bg_color_light'];
$cs_menu_bg_alpha_light = $uncode_option['_uncode_menu_bg_alpha_light'];
$cs_menu_border_color_light = $uncode_option['_uncode_menu_border_color_light'];
$cs_menu_border_alpha_light = $uncode_option['_uncode_menu_border_alpha_light'];
$cs_heading_color_light = $uncode_option['_uncode_heading_color_light'];
$cs_text_color_light = $uncode_option['_uncode_text_color_light'];
$cs_bg_color_light = $uncode_option['_uncode_background_color_light'];

$cs_logo_color_dark = $uncode_option['_uncode_logo_color_dark'];
$cs_menu_color_dark = $uncode_option['_uncode_menu_color_dark'];
$cs_menu_bg_color_dark = $uncode_option['_uncode_menu_bg_color_dark'];
$cs_submenu_bg_color_dark = $uncode_option['_uncode_submenu_bg_color_dark'];
$cs_menu_bg_alpha_dark = $uncode_option['_uncode_menu_bg_alpha_dark'];
$cs_menu_border_color_dark = $uncode_option['_uncode_menu_border_color_dark'];
$cs_menu_border_alpha_dark = $uncode_option['_uncode_menu_border_alpha_dark'];
$cs_heading_color_dark = $uncode_option['_uncode_heading_color_dark'];
$cs_text_color_dark = $uncode_option['_uncode_text_color_dark'];
$cs_bg_color_dark = $uncode_option['_uncode_background_color_dark'];

$cs_accent_color = $uncode_option['_uncode_accent_color'];

$cs_body_font_family = $uncode_option['_uncode_body_font_family'];
$cs_body_font_weight = isset( $uncode_option['_uncode_body_font_weight'] ) ? $uncode_option['_uncode_body_font_weight'] : 400;
$cs_ui_font_family = $uncode_option['_uncode_ui_font_family'];
$cs_menu_font_family = $uncode_option['_uncode_menu_font_family'];
$cs_topbar_font_family = isset( $uncode_option['_uncode_topbar_font_family'] ) ? $uncode_option['_uncode_topbar_font_family'] : 'font-555555';
$cs_heading_font_family = $uncode_option['_uncode_heading_font_family'];
$cs_buttons_font_family = $uncode_option['_uncode_buttons_font_family'];
$cs_filter_menu_font_family = isset( $uncode_option['_uncode_menu_filter_font_family'] ) ? $uncode_option['_uncode_menu_filter_font_family'] : '';
$cs_font_fallback = isset($uncode_option['_uncode_fallback_font']) ? $uncode_option['_uncode_fallback_font'] : '';

$btn_outline = $front_background_colors[$cs_heading_color_light];

if ( !function_exists('uncode_loop_fontsizes') ) {
	function uncode_loop_fontsizes( $font_title, $font_selector, $font_size ) {
		$out = '';
		$out .= "\n\n" . '/*----------------------------------------------------------';
		$out .= "\n" . '# ' . $font_title;
		$out .= "\n" . '----------------------------------------------------------*/';
		if ( ( $font_size > 0 && is_numeric( $font_size ) ) || str_replace(floatval($font_size), '', $font_size) === 'px' ) {
			$font_size = floatval($font_size);
			$out .= "\n" . $font_selector . ' { font-size: ' . $font_size . 'px; }';
			$first_mquery = $font_size / 1.5;
			if ($font_size > 35) {
				$out .= "\n" . '@media (max-width: 959px) { ' . $font_selector . ' { font-size: ' . $first_mquery . 'px; }}';
				if ($first_mquery > 35) {
					$out .= "\n" . '@media (max-width: 569px) { ' . $font_selector . ' { font-size: 35px; }}';
				}
			}
		} else {
			$out .= "\n" . $font_selector . ' { font-size: ' . $font_size . '; }';
		}
		return $out;
	}
}

echo "/*";
echo "\n" . "----------------------------------------------------------";
echo "\n" . "[Table of contents]";
echo "\n\n";
echo "\n" . "#Skins-Colors";
echo "\n" . "#Skins-Typography";
echo "\n" . "#Skins-General";
echo "\n" . "#Skins-Buttons";
echo "\n" . "#Skins-Alerts";
echo "\n" . "#Skins-Menus";
echo "\n" . "#Skins-Thumbs";
echo "\n\n";
echo "\n" . "----------------------------------------------------------";
echo "\n" . "*/";

echo "\n" . "/*";
echo "\n" . "----------------------------------------------------------";
echo "\n\n";
echo "\n" . "#Skins-Color";
echo "\n\n";
echo "\n" . "----------------------------------------------------------";
echo "\n" . "*/";

/** Loop colors **/
foreach ($front_background_colors as $key => $value) {
	if (!isset($value) || $value === '') {
		continue;
	}
	$value = str_replace(';nb',';b',$value);
	$value = str_replace(';n}',';}',$value);
	$value_rgb = sscanf($value, "#%02x%02x%02x");
	echo "\n\n" . '/*----------------------------------------------------------';
	echo "\n" . '#'.$key;
	echo "\n" . '----------------------------------------------------------*/';
	if ( function_exists('uncode_print_style_custom_colors_css') ) {
		uncode_print_style_custom_colors_css( $key, $value, $value_rgb, $btn_outline );
	}

	if ($key === $cs_logo_color_light) {
		$cs_logo_color_light = $value;
	}
	if ($key === $cs_menu_color_light) {
		if (strpos($value, 'background') !== false) {
			preg_match_all("/rgb\s*\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\)/i", $value, $matches);
			if (isset($matches[0][0])) {
				$cs_menu_color_light = $matches[0][0];
			}
			echo "\n" . '.menu-light .menu-smart a, .menu-light .menu-smart a i:before { -webkit-text-fill-color: transparent !important; -webkit-background-clip: text !important; ' . $value . '}';
		} else {
			$cs_menu_color_light = $value;
		}
	}
	if ($key === $cs_menu_bg_color_light) {
		$cs_menu_bg_color_light = $value;
	}
	if ($key === $cs_submenu_bg_color_light) {
		$cs_submenu_bg_color_light = $value;
	}
	if ($key === $cs_menu_border_color_light) {
		$cs_menu_border_color_light = $value;
	}
	if ($key === $cs_menu_border_alpha_light) {
		$cs_menu_border_alpha_light = $value;
	}
	if ($key === $cs_heading_color_light) {
		$cs_heading_color_light = $value;
	}
	if ($key === $cs_text_color_light) {
		$cs_text_color_light = $value;
	}
	if ($key === $cs_bg_color_light) {
		$cs_bg_color_light = $value;
	}

	if ($key === $cs_logo_color_dark) {
		$cs_logo_color_dark = $value;
	}
	if ($key === $cs_menu_color_dark) {
		$cs_menu_color_dark = $value;
	}
	if ($key === $cs_menu_bg_color_dark) {
		$cs_menu_bg_color_dark = $value;
	}
	if ($key === $cs_submenu_bg_color_dark) {
		$cs_submenu_bg_color_dark = $value;
	}
	if ($key === $cs_menu_border_color_dark) {
		$cs_menu_border_color_dark = $value;
	}
	if ($key === $cs_menu_border_color_dark) {
		$cs_menu_border_color_dark = $value;
	}
	if ($key === $cs_heading_color_dark) {
		$cs_heading_color_dark = $value;
	}
	if ($key === $cs_text_color_dark) {
		$cs_text_color_dark = $value;
	}
	if ($key === $cs_bg_color_dark) {
		$cs_bg_color_dark = $value;
	}

	if ($key === $cs_accent_color) {
		$cs_accent_color = $value;
	}
}

if ($cs_bg_color_light !== '') {
	echo "\n\n" . '/*----------------------------------------------------------';
	echo "\n" . '#Style light';
	echo "\n" . '----------------------------------------------------------*/';
	if (strpos($cs_bg_color_light, 'background') !== false) {
		echo "\n" . '.style-light-bg { ' . $cs_bg_color_light . ' }';
	} else {
		echo "\n" . '.style-light-bg { background-color: ' . $cs_bg_color_light . '; }';
		echo "\n" . '.border-light-bg { border-color: ' . $cs_bg_color_light . '; }';
	}
}
if ($cs_bg_color_dark !== '') {
	echo "\n\n" . '/*----------------------------------------------------------';
	echo "\n" . '#Style dark';
	echo "\n" . '----------------------------------------------------------*/';
	if (strpos($cs_bg_color_dark, 'background') !== false) {
		echo "\n" . '.style-dark-bg { ' . $cs_bg_color_dark . ' }';
	} else {
		echo "\n" . '.style-dark-bg { background-color: ' . $cs_bg_color_dark . '; }';
		echo "\n" . '.border-dark-bg { border-color: ' . $cs_bg_color_dark . '; }';
	}
}

echo "\n\n" . '/*----------------------------------------------------------';
echo "\n" . '#Color fix';
echo "\n" . '----------------------------------------------------------*/';
echo "\n" . '.btn-white.btn-outline:hover, .btn-white.btn-outline:focus, .btn-white.btn-outline:active { color: #333333 !important; }';

echo "\n" . "/*";
echo "\n" . "----------------------------------------------------------";
echo "\n\n";
echo "\n" . "#Skins-Typography";
echo "\n\n";
echo "\n" . "----------------------------------------------------------";
echo "\n" . "*/";

/** Loop fonts **/
if (isset($uncode_option['_uncode_font_groups'])) {
	$fonts = $uncode_option['_uncode_font_groups'];
	if (!empty($fonts) && is_array($fonts)) {
		foreach ($fonts as $key => $value) {
			$font_class = $value['_uncode_font_group_unique_id'];
			$font_name = urldecode($value['_uncode_font_group']);
			if ($font_name === 'manual') {
				$font_name = $value['_uncode_font_manual'];
			}
			$font_name = str_replace( ', ', ',', $font_name );
			$font_name_arr = explode( ',', $font_name );
			$font_name = '';
			foreach ( $font_name_arr as $key => $font_name_value ) {
				if (strpos($font_name_value, ' ') > 0 && strpos($font_name_value, "'") === false && strpos($font_name_value, "\"") === false) {
					$font_name_value = "'" . $font_name_value . "'";
				}
				$font_name .= $font_name_value;
				if ( ( $key+1 ) < count($font_name_arr) ) {
				    $font_name .= ',';
				}
			}
			if ($font_name !== '') {
				echo "\n\n" . '/*----------------------------------------------------------';
				echo "\n" . '#'.$font_name;
				echo "\n" . '----------------------------------------------------------*/';
				echo "\n" . '.' . $font_class . ' { font-family: ' . $font_name . ' !important; }';
				echo "\n" . '.btn-custom-typo.' . $font_class . ' { font-family: ' . $font_name . ' !important; }';
			}

			if ($font_class === $cs_body_font_family) {
				$cs_body_font_family = $font_name;
			}
			if ($font_class === $cs_ui_font_family) {
				$cs_ui_font_family = $font_name;
			}
			if ($font_class === $cs_menu_font_family) {
				$cs_menu_font_family = $font_name;
			}
			if ($font_class === $cs_topbar_font_family) {
				$cs_topbar_font_family = $font_name;
			}
			if ($font_class === $cs_heading_font_family) {
				$cs_heading_font_family = $font_name;
			}
			if ($font_class === $cs_buttons_font_family) {
				$cs_buttons_font_family = $font_name;
			}
			if ($font_class === $cs_font_fallback) {
				$cs_font_fallback = $font_name;
			}
			if ($font_class === $cs_filter_menu_font_family) {
				$cs_filter_menu_font_family = $font_name;
			}
		}
	}
}

/** Loop font sizes **/
if (isset($uncode_option['_uncode_heading_font_sizes'])) {
	$font_sizes = $uncode_option['_uncode_heading_font_sizes'];
	if (!empty($font_sizes) && is_array($font_sizes)) {
		foreach ($font_sizes as $key => $value) {
			$_heading_font_size = isset( $value['_uncode_heading_font_size'] ) ? $value['_uncode_heading_font_size'] : 0;
			if ( $_heading_font_size ) {
				echo uncode_loop_fontsizes($value['_uncode_heading_font_size_unique_id'], '.' . $value['_uncode_heading_font_size_unique_id'], $_heading_font_size);
			}
		}
	}
}

/** Loop font height **/
if (isset($uncode_option['_uncode_heading_font_heights'])) {
	$font_heights = $uncode_option['_uncode_heading_font_heights'];
	if (!empty($font_heights) && is_array($font_heights)) {
		foreach ($font_heights as $key => $value) {
			echo "\n\n" . '/*----------------------------------------------------------';
			echo "\n" . '#Line-height: '.$value['_uncode_heading_font_height'];
			echo "\n" . '----------------------------------------------------------*/';
			echo "\n" . '.' . $value['_uncode_heading_font_height_unique_id'] . ' { line-height: ' . $value['_uncode_heading_font_height'] . '; }';
		}
	}
}

/** Loop letter spacings **/
if (isset($uncode_option['_uncode_heading_font_spacings'])) {
	$font_spacings = $uncode_option['_uncode_heading_font_spacings'];
	if (!empty($font_spacings) && is_array($font_spacings)) {
		foreach ($font_spacings as $key => $value) {
			echo "\n\n" . '/*----------------------------------------------------------';
			echo "\n" . '#Letter-spacing: '.$value['_uncode_heading_font_spacing'];
			echo "\n" . '----------------------------------------------------------*/';
			echo "\n" . '.' . $value['_uncode_heading_font_spacing_unique_id'] . ':not(.bigtext) { letter-spacing: ' . $value['_uncode_heading_font_spacing'] . ' !important; }';
			echo "\n" . '.' . $value['_uncode_heading_font_spacing_unique_id'] . '.bigtext > span { letter-spacing: ' . $value['_uncode_heading_font_spacing'] . ' !important; }';
		}
	}
}

/** Collect style for admin **/
$admin_css = ob_get_contents();

echo "\n\n" . '/*----------------------------------------------------------';
echo "\n" . '#Standard font size';
echo "\n" . '----------------------------------------------------------*/';
$default_font_size = isset($uncode_option['_uncode_font_size']) ? $uncode_option['_uncode_font_size'] : '';
$large_text_font_size = isset($uncode_option['_uncode_large_text_size']) ? $uncode_option['_uncode_large_text_size'] : '';
$small_text_font_size = isset($uncode_option['_uncode_small_text_size']) ? $uncode_option['_uncode_small_text_size'] : '';
$h1 = isset($uncode_option['_uncode_heading_h1']) ? $uncode_option['_uncode_heading_h1'] : '';
$h2 = isset($uncode_option['_uncode_heading_h2']) ? $uncode_option['_uncode_heading_h2'] : '';
$h3 = isset($uncode_option['_uncode_heading_h3']) ? $uncode_option['_uncode_heading_h3'] : '';
$h4 = isset($uncode_option['_uncode_heading_h4']) ? $uncode_option['_uncode_heading_h4'] : '';
$h5 = isset($uncode_option['_uncode_heading_h5']) ? $uncode_option['_uncode_heading_h5'] : '';
$h6 = isset($uncode_option['_uncode_heading_h6']) ? $uncode_option['_uncode_heading_h6'] : '';
if ($default_font_size !== '') {
	if ( ( $default_font_size > 0 && is_numeric( $default_font_size ) ) || str_replace(floatval($default_font_size), '', $default_font_size) === 'px' ) {
		echo "\n" . 'body,p,li,dt,dd,dl,address,label,pre,code,.nav-tabs .tab-excerpt { font-size: ' . $default_font_size . 'px; }';
	} else {
		echo "\n" . 'body,p,li,dt,dd,dl,address,label,pre,code,.nav-tabs .tab-excerpt { font-size: ' . $default_font_size . '; }';
	}
}
if ($large_text_font_size !== '') {
	if ( ( $large_text_font_size > 0 && is_numeric( $large_text_font_size ) ) || str_replace(floatval($large_text_font_size), '', $large_text_font_size) === 'px' ) {
		echo "\n.text-lead, .text-lead > *, .nav-tabs .tab-excerpt.text-lead { font-size: " . intval($large_text_font_size) . "px; }".
	"\n.module-text-lead,.module-text-lead > *,.module-text-lead p,.module-text-lead li,.module-text-lead dt,.module-text-lead dd,.module-text-lead dl,.module-text-lead address,.module-text-lead label,.module-text-lead small,.uncode-wc-module.text-lead pre,.module-text-lead code { font-size: " . intval($large_text_font_size) . "px; }";
	} else {
		echo "\n.text-lead, .text-lead > *, .nav-tabs .tab-excerpt.text-lead { font-size: " . $large_text_font_size . "; }".
	"\n.module-text-lead,.module-text-lead > *,.module-text-lead p,.module-text-lead li,.module-text-lead dt,.module-text-lead dd,.module-text-lead dl,.module-text-lead address,.module-text-lead label,.module-text-lead small,.uncode-wc-module.text-lead pre,.module-text-lead code { font-size: " . $large_text_font_size . "; }";
	}
}
if ($small_text_font_size !== '') {
	if ( ( $small_text_font_size > 0 && is_numeric( $small_text_font_size ) ) || str_replace(floatval($small_text_font_size), '', $small_text_font_size) === 'px' ) {
		echo "\n.text-small, .text-small > *, .nav-tabs .tab-excerpt.text-small { font-size: " . intval($small_text_font_size) . "px; }".
	"\n.module-text-small,.module-text-small > *,.module-text-small p,.module-text-small li,.module-text-small dt,.module-text-small dd,.module-text-small dl,.module-text-small address,.module-text-small label,.module-text-small small,.uncode-wc-module.text-small pre,.module-text-small code { font-size: " . intval($small_text_font_size) . "px; }";
	} else {
		echo "\n.text-small, .text-small > *, .nav-tabs .tab-excerpt.text-small { font-size: " . $small_text_font_size . "; }".
	"\n.module-text-small,.module-text-small > *,.module-text-small p,.module-text-small li,.module-text-small dt,.module-text-small dd,.module-text-small dl,.module-text-small address,.module-text-small label,.module-text-small small,.uncode-wc-module.text-small pre,.module-text-small code { font-size: " . $small_text_font_size . "; }";
	}
}
if ($h1 !== '') {
	echo uncode_loop_fontsizes('h1', 'h1:not([class*="fontsize-"]),.h1:not([class*="fontsize-"])', $h1);
}
if ($h2 !== '') {
	echo uncode_loop_fontsizes('h2', 'h2:not([class*="fontsize-"]),.h2:not([class*="fontsize-"])', $h2);
}
if ($h3 !== '') {
	echo uncode_loop_fontsizes('h3', 'h3:not([class*="fontsize-"]),.h3:not([class*="fontsize-"])', $h3);
}
if ($h4 !== '') {
	echo uncode_loop_fontsizes('h4', 'h4:not([class*="fontsize-"]),.h4:not([class*="fontsize-"])', $h4);
}
if ($h5 !== '') {
	echo uncode_loop_fontsizes('h5', 'h5:not([class*="fontsize-"]),.h5:not([class*="fontsize-"])', $h5);
}
if ($h6 !== '') {
	echo uncode_loop_fontsizes('h6', 'h6:not([class*="fontsize-"]),.h6:not([class*="fontsize-"])', $h6);
}

echo "\n\n";

$color_primary = $cs_accent_color;
$_color_primary_alpha = function_exists('uncode_hex2rgb') ? uncode_hex2rgb($color_primary) : array(0,0,0);
$color_primary_alpha = 'rgba('.$_color_primary_alpha[0].','.$_color_primary_alpha[1].','.$_color_primary_alpha[2].',0.75)';
$color_primary_alpha_01 = 'rgba('.$_color_primary_alpha[0].','.$_color_primary_alpha[1].','.$_color_primary_alpha[2].',0.1)';


/** Light skin **/
$color_logo = $cs_logo_color_light;
$color_menu_text = $cs_menu_color_light;
$color_menu_background_alpha_light = function_exists('uncode_hex2rgb') ? uncode_hex2rgb($cs_menu_bg_color_light) : array(0,0,0);
$color_menu_background_alpha_light = 'rgba('.$color_menu_background_alpha_light[0].','.$color_menu_background_alpha_light[1].','.$color_menu_background_alpha_light[2].','.($cs_menu_bg_alpha_light / 100).')';
$color_menu_background_light = $cs_menu_bg_color_light;
$color_submenu_background_light = $cs_submenu_bg_color_light;
$color_menu_border_light_transparent = function_exists('uncode_hex2rgb') ? uncode_hex2rgb($cs_menu_border_color_light) : array(0,0,0);
$color_menu_border_light = $color_submenu_border_light = $color_menu_border_light_transparent = 'rgba('.$color_menu_border_light_transparent[0].','.$color_menu_border_light_transparent[1].','.$color_menu_border_light_transparent[2].','.($cs_menu_border_alpha_light / 100).')';
$get_menu_hover_color = $uncode_option['_uncode_menu_color_hover'];
$color_menu_text_rgba = function_exists('uncode_hex2rgb') ? uncode_hex2rgb($cs_menu_color_light) : array(0,0,0);
$color_submenu_enhanced = 'rgba('.$color_menu_text_rgba[0].','.$color_menu_text_rgba[1].','.$color_menu_text_rgba[2].',.65)';
if ($get_menu_hover_color === '') {
	$color_menu_text_hover = 'rgba('.$color_menu_text_rgba[0].','.$color_menu_text_rgba[1].','.$color_menu_text_rgba[2].',.5)';
	$color_submenu_hover_enhanced = $color_menu_text;
} else {
	$color_menu_text_hover = $color_submenu_hover_enhanced = $front_background_colors[$get_menu_hover_color];
}
$color_menu_text_hover_static = function_exists('uncode_hex2rgb') ? uncode_hex2rgb($cs_menu_color_light) : array(0,0,0);
$color_menu_text_hover_static = 'rgba('.$color_menu_text_hover_static[0].','.$color_menu_text_hover_static[1].','.$color_menu_text_hover_static[2].',.5)';

/** Dark skin **/
$color_logo_inverted = $cs_logo_color_dark;
$color_menu_text_inverted = $cs_menu_color_dark;
$color_menu_background_alpha_dark = function_exists('uncode_hex2rgb') ? uncode_hex2rgb($cs_menu_bg_color_dark) : array(0,0,0);
$color_menu_background_alpha_dark = 'rgba('.$color_menu_background_alpha_dark[0].','.$color_menu_background_alpha_dark[1].','.$color_menu_background_alpha_dark[2].','.($cs_menu_bg_alpha_dark / 100).')';
$color_menu_background_dark = $cs_menu_bg_color_dark;
$color_submenu_background_dark = $cs_submenu_bg_color_dark;
$color_menu_border_dark_transparent = function_exists('uncode_hex2rgb') ? uncode_hex2rgb($cs_menu_border_color_dark) : array(0,0,0);
$color_menu_border_dark = $color_submenu_border_dark = $color_menu_border_dark_transparent = 'rgba('.$color_menu_border_dark_transparent[0].','.$color_menu_border_dark_transparent[1].','.$color_menu_border_dark_transparent[2].','.($cs_menu_border_alpha_dark / 100).')';
$color_menu_text_inverted_rgba = function_exists('uncode_hex2rgb') ? uncode_hex2rgb($cs_menu_color_dark) : array(0,0,0);
$color_submenu_enhanced_inverted = 'rgba('.$color_menu_text_inverted_rgba[0].','.$color_menu_text_inverted_rgba[1].','.$color_menu_text_inverted_rgba[2].',.65)';
if ($get_menu_hover_color === '') {
	$color_menu_text_inverted_hover = 'rgba('.$color_menu_text_inverted_rgba[0].','.$color_menu_text_inverted_rgba[1].','.$color_menu_text_inverted_rgba[2].',.5)';
	$color_submenu_enhanced_hover_inverted = $color_menu_text_inverted;
} else {
	$color_menu_text_inverted_hover = $color_submenu_enhanced_hover_inverted = $front_background_colors[$get_menu_hover_color];
}
$color_menu_text_inverted_hover_static = function_exists('uncode_hex2rgb') ? uncode_hex2rgb($cs_menu_color_dark) : array(0,0,0);
$color_menu_text_inverted_hover_static = 'rgba('.$color_menu_text_inverted_hover_static[0].','.$color_menu_text_inverted_hover_static[1].','.$color_menu_text_inverted_hover_static[2].',.5)';

$color_heading = $cs_heading_color_light;
$_color_heading_alpha = function_exists('uncode_hex2rgb') ? uncode_hex2rgb($color_heading) : array(0,0,0);
$color_heading_alpha = 'rgba('.$_color_heading_alpha[0].','.$_color_heading_alpha[1].','.$_color_heading_alpha[2].',0.75)';
$color_heading_alpha_01 = 'rgba('.$_color_heading_alpha[0].','.$_color_heading_alpha[1].','.$_color_heading_alpha[2].',0.1)';

$color_heading_inverted = $cs_heading_color_dark;
$color_text = $cs_text_color_light;
$color_text_inverted = $cs_text_color_dark;

$color_ui_text_alpha_light = function_exists('uncode_hex2rgb') ? uncode_hex2rgb($color_text) : array(0,0,0);
$color_ui_text_alpha_light = 'rgba('.$color_ui_text_alpha_light[0].','.$color_ui_text_alpha_light[1].','.$color_ui_text_alpha_light[2].',0.65)';

$color_ui_text_alpha_dark = function_exists('uncode_hex2rgb') ? uncode_hex2rgb($color_text_inverted) : array(0,0,0);
$color_ui_text_alpha_dark = 'rgba('.$color_ui_text_alpha_dark[0].','.$color_ui_text_alpha_dark[1].','.$color_ui_text_alpha_dark[2].',0.65)';

$font_family_fallback = $cs_font_fallback != '' ? ', ' . $cs_font_fallback : '';
$font_family_menu = $cs_menu_font_family . $font_family_fallback;
$font_family_topbar = $cs_topbar_font_family . $font_family_fallback;
$font_family_base = $cs_body_font_family . $font_family_fallback;
$font_family_headings = $cs_heading_font_family . $font_family_fallback;
$font_family_btn = $cs_buttons_font_family . $font_family_fallback;
$font_family_ui = $cs_ui_font_family . $font_family_fallback;

if ( ! $cs_filter_menu_font_family ) {
	$filter_menu_font_family = $font_family_ui; // default from Font UI
} else {
	$filter_menu_font_family = $cs_filter_menu_font_family . $font_family_fallback;
}

$menu_font_weight = $uncode_option['_uncode_menu_font_weight'];
$menu_letter_spacing = $uncode_option['_uncode_menu_letter_spacing'];
$menu_font_size = $uncode_option['_uncode_menu_font_size'];
if ($menu_font_size === '') {
	$menu_font_size = 12;
}
$submenu_font_size = $uncode_option['_uncode_submenu_font_size'];
if ($submenu_font_size === '') {
	$submenu_font_size = 12;
}

if ( isset( $uncode_option['_uncode_menu_overlay_font_size'] ) ) {
	$menu_overlay_font_size = $uncode_option['_uncode_menu_overlay_font_size'];
} else {
	$menu_overlay_font_size = '';
}
if ($menu_overlay_font_size === '') {
	$menu_overlay_font_size = '3.5vh';
} elseif ( is_numeric($menu_overlay_font_size) ) {
	$menu_overlay_font_size = $menu_overlay_font_size . 'px';
}

if ( isset( $uncode_option['_uncode_submenu_overlay_font_size'] ) ) {
	$submenu_overlay_font_size = $uncode_option['_uncode_submenu_overlay_font_size'];
} else {
	$submenu_overlay_font_size = '';
}
if ($submenu_overlay_font_size === '') {
	$submenu_overlay_font_size = '3.5vh';
} elseif ( is_numeric($submenu_overlay_font_size) ) {
	$submenu_overlay_font_size = $submenu_overlay_font_size . 'px';
}

if ( isset( $uncode_option['_uncode_menu_mobile_centered_font_size'] ) ) {
	$menu_mobile_centered_font_size = $uncode_option['_uncode_menu_mobile_centered_font_size'];
} else {
	$menu_mobile_centered_font_size = '';
}
if ($menu_mobile_centered_font_size === '') {
	$menu_mobile_centered_font_size = '5.5vw';
} elseif ( is_numeric($menu_mobile_centered_font_size) ) {
	$menu_mobile_centered_font_size = $menu_mobile_centered_font_size . 'px';
}

if ( isset( $uncode_option['_uncode_submenu_mobile_centered_font_size'] ) ) {
	$submenu_mobile_centered_font_size = $uncode_option['_uncode_submenu_mobile_centered_font_size'];
} else {
	$submenu_mobile_centered_font_size = '';
}
if ($submenu_mobile_centered_font_size === '') {
	$submenu_mobile_centered_font_size = '5.5vw';
} elseif ( is_numeric($submenu_mobile_centered_font_size) ) {
	$submenu_mobile_centered_font_size = $submenu_mobile_centered_font_size . 'px';
}

if ( isset( $uncode_option['_uncode_secondary_menu_font_size'] ) ) {
	$secondary_menu_font_size = $uncode_option['_uncode_secondary_menu_font_size'];
} else {
	$secondary_menu_font_size = 12;
}
if ( isset( $uncode_option['_uncode_secondary_menu_mobile_font_size'] ) ) {
	$secondary_menu_mobile_font_size = $uncode_option['_uncode_secondary_menu_mobile_font_size'];
} else {
	$secondary_menu_mobile_font_size = 10;
}
$topbar_font_weight = isset( $uncode_option['_uncode_topbar_font_weight'] ) ? $uncode_option['_uncode_topbar_font_weight'] : 400;
$menu_mobile_font_size = isset( $uncode_option['_uncode_menu_mobile_font_size'] ) ? $uncode_option['_uncode_menu_mobile_font_size'] : 12;
if ($menu_mobile_font_size === '') {
	$menu_mobile_font_size = 12;
}
$heading_font_weight = $uncode_option['_uncode_heading_font_weight'];
if ( isset( $uncode_option['_uncode_heading_letter_spacing'] ) ) {
	$heading_letter_spacing = $uncode_option['_uncode_heading_letter_spacing'];
} else {
	$heading_letter_spacing = '0.00';
}
$shadow_type = isset( $uncode_option['_uncode_shadow_type'] ) ? $uncode_option['_uncode_shadow_type'] : '';
$btn_font_weight = $uncode_option['_uncode_buttons_font_weight'];
$btn_font_size = isset( $uncode_option['_uncode_buttons_font_size'] ) ? absint( $uncode_option['_uncode_buttons_font_size'] ) : 12;
$btn_font_size = $btn_font_size ? $btn_font_size : 12;
$btn_font_size_sm = absint( $btn_font_size / 1.2 );
$btn_font_size_lg = absint( $btn_font_size * 1.25 );
$btn_font_size_xl = absint( $btn_font_size * 1.5 );
$btn_proportions = function_exists('uncode_get_button_proportions') ? uncode_get_button_proportions($btn_font_size) : array(0,1);
$btn_padding_top_bottom_modifier = $btn_proportions[0];
$btn_padding_lateral_modifier = $btn_proportions[1];
$btn_padding_top_bottom = absint( $btn_font_size * $btn_padding_top_bottom_modifier );
$btn_padding_lateral = absint( $btn_font_size * $btn_padding_lateral_modifier );
$btn_padding_sm_top_bottom = absint( $btn_font_size_sm * $btn_padding_top_bottom_modifier );
$btn_padding_sm_lateral = absint( $btn_font_size_sm * $btn_padding_lateral_modifier );
$btn_padding_lg_top_bottom = absint( $btn_font_size_lg * $btn_padding_top_bottom_modifier );
$btn_padding_lg_lateral = absint( $btn_font_size_lg * $btn_padding_lateral_modifier );
$btn_padding_xl_top_bottom = absint( $btn_font_size_xl * $btn_padding_top_bottom_modifier );
$btn_padding_xl_lateral = absint( $btn_font_size_xl * $btn_padding_lateral_modifier );
$btn_wgt_padding_top_bottom = absint( $btn_font_size / 2.4 );
$btn_wgt_padding_lateral = absint( $btn_font_size * 1.25 );
$btn_text_transform = $uncode_option['_uncode_buttons_text_transform'];
$btn_letter_spacing = !isset($uncode_option['_uncode_buttons_letter_spacing']) || $uncode_option['_uncode_buttons_letter_spacing'] == '' ? '0.1em' : $uncode_option['_uncode_buttons_letter_spacing'];
$btn_letter_spacing = $btn_letter_spacing == 'uncode-fontspace-zero' ? '0em' : $btn_letter_spacing;
$btn_border_width = !isset($uncode_option['_uncode_buttons_border_width']) || $uncode_option['_uncode_buttons_border_width'] == '' ? '1' : $uncode_option['_uncode_buttons_border_width'];
$ui_font_weight = $uncode_option['_uncode_ui_font_weight'];
$ui_font_size = isset( $uncode_option['_uncode_ui_font_size'] ) ? absint( $uncode_option['_uncode_ui_font_size'] ) : 12;
$ui_font_size = $ui_font_size ? $ui_font_size : 12;
$ui_text_transform = isset( $uncode_option['_uncode_ui_text_transform'] ) ? $uncode_option['_uncode_ui_text_transform'] : 'uppercase';
$ui_text_transform = $ui_text_transform ? $ui_text_transform : 'uppercase';
$ui_letter_spacing = isset( $uncode_option['_uncode_ui_letter_spacing'] ) ? $uncode_option['_uncode_ui_letter_spacing'] : '.05em';
$ui_letter_spacing = $ui_letter_spacing ? $ui_letter_spacing : '.05em';
$filter_menu_font_size = isset( $uncode_option['_uncode_menu_filter_font_size'] ) ? absint( $uncode_option['_uncode_menu_filter_font_size'] ) : 11;

$filter_menu_font_size = $filter_menu_font_size ? $filter_menu_font_size : 12;
$filter_menu_font_weight = isset( $uncode_option['_uncode_menu_filter_font_weight'] ) ? $uncode_option['_uncode_menu_filter_font_weight'] : '';
$filter_menu_font_weight = $filter_menu_font_weight ? $filter_menu_font_weight : $ui_font_weight; // default from Font UI
$filter_menu_letter_spacing = isset( $uncode_option['_uncode_menu_filter_letter_spacing'] ) && $uncode_option['_uncode_menu_filter_letter_spacing'] ? $uncode_option['_uncode_menu_filter_letter_spacing'] : '.05em';
$filter_menu_letter_spacing = $filter_menu_letter_spacing && $filter_menu_letter_spacing !== 'uncode-fontspace-zero' ? $filter_menu_letter_spacing : '0';

if ( isset( $uncode_option['_uncode_overlay_menu_bg_opacity'] ) ) {
	$overlay_bg_opacity = $uncode_option['_uncode_overlay_menu_bg_opacity'];
} else {
	$overlay_bg_opacity = '95';
}

/** Loop letter spacings (again) **/
if (isset($uncode_option['_uncode_heading_font_spacings'])) {
	$font_spacings = $uncode_option['_uncode_heading_font_spacings'];
	if (!empty($font_spacings) && is_array($font_spacings)) {
		foreach ($font_spacings as $key => $value) {
			if ( $value['_uncode_heading_font_spacing_unique_id'] === $btn_letter_spacing ) {
				$btn_letter_spacing = $value['_uncode_heading_font_spacing'];
			}
		}
		foreach ($font_spacings as $key => $value) {
			if ( $value['_uncode_heading_font_spacing_unique_id'] === $ui_letter_spacing ) {
				$ui_letter_spacing = $value['_uncode_heading_font_spacing'];
			}
		}
		foreach ($font_spacings as $key => $value) {
			if ( $value['_uncode_heading_font_spacing_unique_id'] === $filter_menu_letter_spacing ) {
				$filter_menu_letter_spacing = $value['_uncode_heading_font_spacing'];
			}
		}
	}
}

include get_template_directory() . '/core/inc/style-skins.css.php';

// WooCommerce dynamic styles
if ( class_exists( 'WooCommerce' ) ) {
	update_option( 'uncode_has_wc_dynamic_css', true, false );
	include get_template_directory() . '/core/inc/style-skins-woocommerce.css.php';
} else {
	delete_option( 'uncode_has_wc_dynamic_css' );
}

// Yith Wishlist dynamic styles
if ( class_exists( 'YITH_WCWL' ) ) {
	include get_template_directory() . '/core/inc/style-skins-wishlist.css.php';
}

// Tab switch
