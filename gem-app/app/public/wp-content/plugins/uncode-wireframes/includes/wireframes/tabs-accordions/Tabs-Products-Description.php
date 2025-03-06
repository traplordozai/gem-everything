<?php
/**
 * name             - Wireframe title
 * cat_name         - Comma separated list for multiple categories (cat display name)
 * custom_class     - Space separated list for multiple categories (cat ID)
 * dependency       - Array of dependencies
 * is_content_block - (optional) Best in a content block
 *
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$wireframe_categories = UNCDWF_Dynamic::get_wireframe_categories();
$data                 = array();

// Wireframe properties

$data[ 'name' ]             = esc_html__( 'Tabs Products Description', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Tabs-Products-Description.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="163106" back_color_type="uncode-palette"][vc_column column_width_use_pixel="yes" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="348789"][vc_tabs tab_scrolling="yes" typography="advanced" border_100="yes" titles_size="h6" titles_weight="600" product_from_builder="yes" uncode_shortcode_id="115915"][vc_tab gutter_size="2" column_padding="3" title="Description" tab_id="940716728532661661715766291651" product_from_builder="yes"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="602831" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="204259"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="392043"]Specifications[/vc_custom_heading][vc_column_text uncode_shortcode_id="114922"]Its compact design size makes it ideal for travel or the perfect body for everyday carry, the classic aluminum body gives it a tactile feel, proprietary low-velocity port design minimizes distortion.[/vc_column_text][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="196893"]Vestibility[/vc_custom_heading][vc_column_text uncode_shortcode_id="421441"]Proprietary low-velocity port design minimizes distortion and rounds out low-end frequencies. In assortment for decades and is still very popular. You can choose one of our combinations.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="149191"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="119197"]Materials[/vc_custom_heading][vc_column_text uncode_shortcode_id="659224"]Short sleeve crewneck in white in a professional context it often happens that private or corporate clients a publication to be made and presented with the actual content still not being ready.[/vc_column_text][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="186737"]Treatments[/vc_custom_heading][vc_column_text uncode_shortcode_id="153420"]Think of a news blog that’s filled with content hourly on the day of going live. Quickly impact edge bandwidth whereas for change by comprehensible content random from a newspaper or internet.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="298786"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="246165"]Maintenance[/vc_custom_heading][vc_column_text uncode_shortcode_id="120056"]Wash inside out 40°C for change short sleeve crewneck in white in a professional context it often happens presented that private or corporate clients a publication everyday to be made.[/vc_column_text][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="102528"]Sustainability[/vc_custom_heading][vc_column_text uncode_shortcode_id="136692"]This software measures the acoustics of the room then fine-tunes the soundbar. Supported iOS device required. Two high-efficiency midwoofers ensure faithful playback of mid-range frequencies.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_tab][vc_tab gutter_size="2" column_padding="3" title="Size Guide" tab_id="71940716728532661661715766291651" product_from_builder="yes"][vc_column_text uncode_shortcode_id="253530"]
<table class="table-wide">
<thead>
<tr>
<th>Size</th>
<th>Chest</th>
<th>Waist</th>
<th>Hip</th>
</tr>
</thead>
<tbody>
<tr>
<th>XS</th>
<td>34-36</td>
<td>27-29</td>
<td>34-36</td>
</tr>
<tr>
<th>S</th>
<td>36-38</td>
<td>29-31</td>
<td>36-38</td>
</tr>
<tr>
<th>M</th>
<td>38-40</td>
<td>31-33</td>
<td>38-40</td>
</tr>
<tr>
<th>L</th>
<td>40-42</td>
<td>33-36</td>
<td>40-43</td>
</tr>
<tr>
<th>XL</th>
<td>42-45</td>
<td>36-40</td>
<td>43-47</td>
</tr>
<tr>
<th>XXL</th>
<td>45-48</td>
<td>40-44</td>
<td>47-51</td>
</tr>
</tbody>
</table>
<p>[/vc_column_text][/vc_tab][vc_tab gutter_size="2" column_padding="3" title="Shipping &amp; Returns" tab_id="5571940716728532661661715766291651" product_from_builder="yes"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="111698"]Shipping &amp; Returns[/vc_custom_heading][vc_column_text uncode_shortcode_id="801963"]We offer a next working day delivery for orders placed before 6:30 p.m. Monday to Friday. Orders placed after this will be delivered within two working days. This excludes Saturday, Sunday and public holidays.[/vc_column_text][vc_column_text uncode_shortcode_id="114165"]The returned product(s) must be in the original packaging, safety wrapped, undamaged and unworn. This means that the item(s) must be safely packed in a carton box for protection during transport, possibly the same carton used to ship to you as a customer.[/vc_column_text][vc_column_text uncode_shortcode_id="702192"]
<table class="table-wide">
<thead>
<tr>
<th>Destination</th>
<th>Delivery</th>
<th>Above $50</th>
</tr>
</thead>
<tbody>
<tr>
<td>Denmark</td>
<td>1 - 2 days</td>
<td>Free</td>
</tr>
<tr>
<td>Belgium, Germany, Netherlands, Sweden</td>
<td>2 - 4 days</td>
<td>Free</td>
</tr>
<tr>
<td>Austria, Czech Republic, Finland, France, Italy, Spain, Hungary, Ireland, Poland, Portugal, Slovakia, Slovenia</td>
<td>3 - 5 days</td>
<td>Free</td>
</tr>
<tr>
<td>United States</td>
<td>1 - 2 days</td>
<td>Free</td>
</tr>
<tr>
<td>Japan</td>
<td>3 - 5 days</td>
<td>Free</td>
</tr>
<tr>
<td>Australia</td>
<td>2 - 4 days</td>
<td>Free</td>
</tr>
</tbody>
</table>
<p>[/vc_column_text][vc_empty_space empty_h="1"][/vc_tab][/vc_tabs][/vc_column][/vc_row]
';

// Check if this wireframe is for a content block
if ( $data[ 'is_content_block' ] && ! $is_content_block ) {
	$data[ 'custom_class' ] .= ' for-content-blocks';
}

// Check if this wireframe requires a plugin
foreach ( $data[ 'dependency' ]  as $dependency ) {
	if ( ! UNCDWF_Dynamic::has_dependency( $dependency ) ) {
		$data[ 'custom_class' ] .= ' has-dependency needs-' . $dependency;
	}
}

vc_add_default_templates( $data );
