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

$data[ 'name' ]             = esc_html__( 'Product Grid Wide', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'products' ];
$data[ 'custom_class' ]     = 'products';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'products/Product-Grid-Wide.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="186344" back_color_type="uncode-palette" el_class="normalise-top-padding-mobile"][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/3"][uncode_single_product_gallery layout="grid" gutter_thumb_grid="3" zoom_mobile="yes" product_badges=""][/vc_column][vc_column column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="334485"][uncode_single_product_rating][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="0" width="1/1" uncode_shortcode_id="839507"][vc_custom_heading auto_text="yes" heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="644777"]This is a custom heading element.[/vc_custom_heading][vc_custom_heading auto_text="price" heading_semantic="h6" text_height="'. uncode_wf_print_font_height( 'fontheight-578034' ) .'" uncode_shortcode_id="132910"]This is a custom heading element.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_column_text auto_text="excerpt" uncode_shortcode_id="147315"]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][uncode_single_product_meta inline="yes"][vc_separator sep_color=",Default"][vc_button dynamic="add-to-cart" quantity="variation" wide="yes" custom_typo="yes" font_weight="500" border_width="0" scale_mobile="no" uncode_shortcode_id="431858"]Text on the button[/vc_button][vc_separator sep_color=",Default"][uncode_list icon="fa fa-circle-check" uncode_shortcode_id="180288"]
<ul>
<li>Free shipping on all orders over $50</li>
<li>30 days easy returns</li>
<li>All taxes and customs duties included</li>
</ul>
<p>[/uncode_list][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="177367" back_color_type="uncode-palette"][vc_column column_width_use_pixel="yes" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="348789"][vc_tabs typography="yes" border_100="yes" tab_scrolling="yes" product_from_builder="yes"][vc_tab gutter_size="2" column_padding="3" title="Description" tab_id="018016" product_from_builder="yes"][vc_column_text auto_text="content"]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_tab][vc_tab gutter_size="2" column_padding="3" title="Product Information" tab_id="7018016" product_from_builder="yes"][vc_row_inner limit_content=""][vc_column_inner column_width_use_pixel="yes" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="106164" column_width_pixel="800"][uncode_single_product_additional_info][/vc_column_inner][/vc_row_inner][/vc_tab][vc_tab gutter_size="2" column_padding="3" title="Size Guide" tab_id="57018016" product_from_builder="yes"][vc_column_text uncode_shortcode_id="253530"]
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
<p>[/vc_column_text][/vc_tab][vc_tab gutter_size="2" column_padding="3" title="Reviews" tab_id="557018016" product_from_builder="yes"][vc_row_inner limit_content=""][vc_column_inner column_width_use_pixel="yes" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="577688" column_width_pixel="800"][uncode_single_product_reviews][/vc_column_inner][/vc_row_inner][/vc_tab][vc_tab gutter_size="2" column_padding="3" title="Shipping & Returns" tab_id="3557018016" product_from_builder="yes"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="202989"]Shipping[/vc_custom_heading][vc_column_text uncode_shortcode_id="801963"]We offer a next working day delivery for orders placed before 6:30 p.m. Monday to Friday. Orders placed after this will be delivered within two working days. This excludes Saturday, Sunday and public holidays.[/vc_column_text][vc_column_text uncode_shortcode_id="702192"]
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
<p>[/vc_column_text][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="148574"]Returns[/vc_custom_heading][vc_column_text uncode_shortcode_id="296709"]Returns will be accepted for up to 14 days of Customer’s receipt or tracking number on unworn items. You, as a Customer, are obliged to inform us via email before you return the item, only in the case of:[/vc_column_text][uncode_list icon="fa fa-check2" uncode_shortcode_id="104983"]
<ul>
<li>Received the wrong item</li>
<li>Item arrived not as expected (ie. damaged packaging)</li>
<li>Item had defects</li>
</ul>
<p>[/uncode_list][vc_column_text uncode_shortcode_id="114165"]The returned product(s) must be in the original packaging, safety wrapped, undamaged and unworn. This means that the item(s) must be safely packed in a carton box for protection during transport, possibly the same carton used to ship to you as a customer.[/vc_column_text][/vc_tab][/vc_tabs][/vc_column][/vc_row]
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
