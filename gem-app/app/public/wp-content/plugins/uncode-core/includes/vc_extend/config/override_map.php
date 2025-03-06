<?php

require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/config/params.php';

global $uncode_colors, $uncode_colors_flat, $uncode_colors_w_transp, $uncode_colors_flat_array;

$flat_uncode_colors_w_accent   = uncode_core_vc_params_get_flat_colors_w_accent( $uncode_colors_flat );
$flat_uncode_colors            = uncode_core_vc_params_get_flat_colors( $uncode_colors );
$flat_uncode_colors_w_transp   = uncode_core_vc_params_get_flat_colors_w_transparent( $uncode_colors_flat );
$units                         = uncode_core_vc_params_get_units();
$size_arr                      = uncode_core_vc_params_get_button_sizes();
$icon_sizes                    = uncode_core_vc_params_get_icon_sizes();
$heading_semantic              = uncode_core_vc_params_get_heading_semantic_values();
$heading_size                  = uncode_core_vc_params_get_heading_font_sizes();
$heading_height                = uncode_core_vc_params_get_heading_font_heights();
$font_spacings                 = uncode_core_vc_params_get_font_spacings();
$fonts                         = uncode_core_vc_params_get_fonts();
$heading_space                 = uncode_core_vc_params_get_heading_spacings( $font_spacings );
$btn_letter_spacing            = uncode_core_vc_params_get_button_spacings( $font_spacings );
$heading_font                  = uncode_core_vc_params_get_heading_fonts( $fonts );
$button_font                   = uncode_core_vc_params_get_button_fonts( $fonts );
$heading_weight                = uncode_core_vc_params_get_heading_font_weights();
$button_weight                 = uncode_core_vc_params_get_button_font_weights();
$font_heights                  = uncode_core_vc_params_get_font_heights();
$heading_height                = uncode_core_vc_params_get_font_heading_heights( $font_heights );
$target_arr                    = uncode_core_vc_params_get_target_styles();
$border_style                  = uncode_core_vc_params_get_border_styles();
$add_css_animation             = uncode_core_vc_params_get_css_animation();
$add_css_animation_w_parallax  = uncode_core_vc_params_get_css_animation( true );
$add_animation_delay           = uncode_core_vc_params_get_css_animation_delay();
$add_animation_speed           = uncode_core_vc_params_get_css_animation_speed();
$add_background_repeat         = uncode_core_vc_params_get_css_background_repeat();
$add_background_attachment     = uncode_core_vc_params_get_css_background_attachment();
$add_background_position       = uncode_core_vc_params_get_css_background_position();
$add_background_size           = uncode_core_vc_params_get_css_background_size();
$gdpr                          = uncode_core_vc_params_get_gdpr_options();
$uncode_post_types             = uncode_core_vc_params_get_cpts();
$uncode_post_types_with_labels = uncode_core_vc_params_get_cpts_label();
$button_options                = uncode_core_vc_params_get_button_options( $uncode_colors, $size_arr, $heading_size, $button_font, $button_weight, $btn_letter_spacing );

$heading_size_custom = array (esc_html__('Custom', 'uncode-core') => 'custom');
$heading_size_h = array_merge($heading_size, $heading_size_custom);
$tab_label_typo_params         = uncode_core_vc_params_get_wc_heading_options( $heading_font, $heading_size_h, $heading_weight, $heading_height, $heading_space, array('typography', 'advanced') );
$wc_heading_options            = uncode_core_vc_params_get_wc_heading_options( $heading_font, $heading_size_h, $heading_weight, $heading_height, $heading_space );

$wc_extra_options              = uncode_core_vc_params_get_wc_extra_options();
$wc_thumb_size_options         = uncode_core_vc_params_get_wc_thumb_size_options();
$add_widget_collapse_desktop   = uncode_core_vc_params_get_widget_collapse_desktop();
$add_widget_collapse_tablet    = uncode_core_vc_params_get_widget_collapse_tablet();
$add_widget_collapse           = uncode_core_vc_params_get_widget_collapse();
$add_widget_icon               = uncode_core_vc_params_get_widget_collapse_icon();
$add_widget_style              = uncode_core_vc_params_get_widget_style();
$add_widget_style_no_arrows    = uncode_core_vc_params_get_widget_style_no_arrows();
$add_widget_style_no_separator = uncode_core_vc_params_get_widget_style_no_separator();
$add_widget_style_title_typo   = uncode_core_vc_params_get_widget_style_title_typography();
$add_widget_style_no_stars     = uncode_core_vc_params_get_widget_style_no_stars();
$add_widget_style_no_thumbs    = uncode_core_vc_params_get_widget_style_no_thumbs();
$all_taxonomies                = uncode_core_get_taxonomies_for_ajax_filter();
$all_product_atts              = uncode_core_get_product_attributes_for_ajax_filter();

// Overrides
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/section/section.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/row/row.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/row-inner/row-inner.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/column/column.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/column-inner/column-inner.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/media-gallery/media-gallery.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/text-column/text-column.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/divider/divider.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/message-box/message-box.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/single-media/single-media.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/tabs/tabs.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/accordion/accordion.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widgetised-sidebar/widgetised-sidebar.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/button/button.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/gmaps/gmaps.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/raw-html/raw-html.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/raw-js/raw-js.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/flickr/flickr.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/pie-chart/pie-chart.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/progress-bar/progress-bar.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/pricing-list/pricing-list.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/star-rating/star-rating.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/cf7/cf7.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-search/widget-search.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-meta/widget-meta.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-recent-comments/widget-recent-comments.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-calendar/widget-calendar.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-pages/widget-pages.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-tag-cloud/widget-tag-cloud.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-menu/widget-menu.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-text/widget-text.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-recent-posts/widget-recent-posts.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-links/widget-links.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-categories/widget-categories.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-archives/widget-archives.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-rss/widget-rss.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/empty-space/empty-space.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/heading/heading.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/icon-box/icon-box.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/gutenberg/gutenberg.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/breadcrumbs/breadcrumbs.php';

// Custom modules

require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/uncode-index/uncode-index.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/slider/slider.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/counter/counter.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/countdown/countdown.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/custom-fields/custom-fields.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/list/list.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/pricing/pricing.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/share/share.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/twentytwenty/twentytwenty.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/author-profile/author-profile.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/consent-notice/consent-notice.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/socials/socials.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/copyright/copyright.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/content-block/content-block.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/info-box/info-box.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/portfolio-details/portfolio-details.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/uncode-do-action/uncode-do-action.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-recommended-posts/widget-recommended-posts.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/vertical-text/vertical-text.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/module-placeholder/module-placeholder.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/navigation/navigation.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/comments/comments.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/ajax-filter/ajax-filter.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/ajax-active-filters/ajax-active-filters.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/lottie/lottie.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/carousel-nav/carousel-nav.php';

// WC modules

require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/wc-cart/wc-cart.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/wc-checkout/wc-checkout.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/wc-my-account/wc-my-account.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/wc-account-forms/wc-account-forms.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/wc-additional-info/wc-additional-info.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/wc-rating/wc-rating.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/wc-product-meta/wc-product-meta.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/wc-product-gallery/wc-product-gallery.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/wc-product-reviews/wc-product-reviews.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/wc-wishlist/wc-wishlist.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/wc-checkout-steps/wc-checkout-steps.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/wc-attribute-image/wc-attribute-image.php';


// WC widgets
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-wc-cart/widget-wc-cart.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-wc-layered-nav-filters/widget-wc-layered-nav-filters.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-wc-layered-nav/widget-wc-layered-nav.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-wc-price-filter/widget-wc-price-filter.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-wc-product-categories/widget-wc-product-categories.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-wc-product-search/widget-wc-product-search.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-wc-product-tag-cloud/widget-wc-product-tag-cloud.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-wc-products/widget-wc-products.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-wc-recently-viewed/widget-wc-recently-viewed.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-wc-top-rated-products/widget-wc-top-rated-products.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-wc-top-recent-reviews/widget-wc-top-recent-reviews.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-wc-top-rating-filter/widget-wc-top-rating-filter.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/widget-wc-sorting/widget-wc-sorting.php';
