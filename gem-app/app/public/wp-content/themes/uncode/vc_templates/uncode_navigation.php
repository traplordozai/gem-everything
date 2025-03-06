<?php

extract(shortcode_atts(array(
	'hide_parent' => '',
	'hide_title' => '',
	'hide_label' => '',
	'hide_thumbnails' => '',
	'no_loop' => '',
	'stacked_layout' => '',
	'stacked_layout_desktop' => '',
	'stacked_layout_tablet' => '',
	'stacked_layout_mobile' => '',
	'navigation_gap' => 'standard',
	'vertical_space' => 'small',
	'prev_icon' => '',
	'next_icon' => '',
	'icon_size' => '',
	'icon_responsive' => '',
	'icon_desktop_visibility' => '',
	'icon_medium_visibility' => '',
	'icon_mobile_visibility' => '',
	'title_custom_typo' => '',
	'title_font' => '',
	'title_size' => '',
	'title_weight' => '',
	'title_transform' => '',
	'title_height' => '',
	'title_space' => '',
	'title_responsive' => '',
	'title_desktop_visibility' => '',
	'title_medium_visibility' => '',
	'title_mobile_visibility' => '',
	'previous_label' => '',
	'next_label' => '',
	'label_position' => '',
	'label_custom_typo' => '',
	'label_font' => '',
	'label_size' => '',
	'label_weight' => '',
	'label_transform' => '',
	'label_height' => '',
	'label_space' => '',
	'label_responsive' => '',
	'label_desktop_visibility' => '',
	'label_medium_visibility' => '',
	'label_mobile_visibility' => '',
	'parent_type' => '',
	'parent_label' => '',
	'parent_custom_typo' => '',
	'parent_font' => '',
	'parent_size' => '',
	'parent_weight' => '',
	'parent_transform' => '',
	'parent_height' => '',
	'parent_space' => '',
	'parent_icon' => '',
	'parent_icon_size' => '',
	'parent_responsive' => '',
	'parent_desktop_visibility' => '',
	'parent_medium_visibility' => '',
	'parent_mobile_visibility' => '',
	'thumbnails_shape' => '',
	'thumbnails_size' => '',
	'thumbnails_responsive' => '',
	'thumbnails_desktop_visibility' => '',
	'thumbnails_medium_visibility' => '',
	'thumbnails_mobile_visibility' => '',
	'el_id' => '',
	'el_class' => '',
) , $atts));

if ( $el_id !== '' ) {
	$unique_id = $el_id;
	$el_id     = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$unique_id = rand();
	$el_id     = '';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode-navigation-module', $this->settings['base'], $atts );

$classes = array( $css_class );
$classes[] = trim( $this->getExtraClass( $el_class ) );

$current_post_id   = ( is_single() || is_page() ) && ! is_front_page() ? get_the_ID() : '';
$current_post_id   = $current_post_id ? $current_post_id : 0;
$original_post_id  = $current_post_id;
$current_post_id   = apply_filters( 'uncode_navigation_current_post_id', $current_post_id, $unique_id );

// Populate post object if we have a custom post id via filter
if ( has_filter( 'uncode_navigation_current_post_id' ) ) {
	$original_post_object = get_post( $original_post_id );
	$current_post_object  = get_post( $current_post_id );
	$GLOBALS['post']      = $current_post_object;
}

$current_post_type = get_post_type( $current_post_id );

if ( ! $current_post_type ) {
	$output = '';
} else {
	// Get parent index
	$generic_index  = true;
	$specific_index = get_post_meta( $current_post_id, '_uncode_specific_navigation_index', true );
	if ( $specific_index !== '' ) {
		$navigation_index = $specific_index;
		$generic_navigation_index = ot_get_option('_uncode_' . $current_post_type . '_navigation_index');

		if ( absint( $navigation_index ) === absint( $generic_navigation_index ) ) {
			$navigation_index = $generic_navigation_index;
		}

		$generic_index = false;
	} else {
		$navigation_index = ot_get_option( '_uncode_' . $current_post_type . '_navigation_index' );
	}

	// Hide index link?
	if ( $hide_parent === 'yes' ) {
		$navigation_index_link = false;
	} else {
		if ( $current_post_type === 'uncodeblock' ) {
			$navigation_index_link = '#';
		} else {
			$navigation_index_link = $navigation_index ? get_permalink( $navigation_index ) : '';
		}
	}

	// Labels text
	$previous_label = $previous_label ? $previous_label : __( 'Previous', 'uncode' );
	$next_label     = $next_label ? $next_label : __( 'Next', 'uncode' );
	$parent_label   = $parent_label ? $parent_label : __( 'Main', 'uncode' );

	// Show prev element
	$show_prev_el = true;
	if ( ! $prev_icon && $hide_thumbnails === 'yes' && $hide_label === 'yes' && $hide_title === 'yes' ) {
		$show_prev_el = false;
	}

	// Show next element
	$show_next_el = true;
	if ( ! $next_icon && $hide_thumbnails === 'yes' && $hide_label === 'yes' && $hide_title === 'yes' ) {
		$show_next_el = false;
	}

	// Show navigation index
	$show_nav_index = $navigation_index_link ? true : false;

	// Show whole navigation
	$show_nav = ! $show_prev_el && ! $show_next_el && ! $show_nav_index ? false : true;

	// Title classes
	$title_classes = array();
	if ( $hide_title !== 'yes' ) {
		if ( $title_custom_typo === 'yes' ) {
			if ( $title_font ) {
				$title_classes[] = $title_font;
			}
			if ( $title_weight ) {
				$title_classes[] = 'font-weight-' . $title_weight;
			}
			if ( $title_transform ) {
				$title_classes[] = 'text-' . $title_transform;
			}
			if ( $title_height ) {
				$title_classes[] = $title_height;
			}
			if ( $title_space ) {
				$title_classes[] = $title_space;
			}
		}

		if ( $title_size ) {
			$title_classes[] = $title_size;
		} else {
			$title_classes[] = 'h6';
		}
	}
	if ( $title_responsive === 'yes' ) {
		if ( $title_desktop_visibility === 'yes' ) {
			$title_classes[] = 'desktop-hidden';
		}
		if ( $title_medium_visibility === 'yes' ) {
			$title_classes[] = 'tablet-hidden';
		}
		if ( $title_mobile_visibility === 'yes' ) {
			$title_classes[] = 'mobile-hidden';
		}
	}

	// Label classes
	$label_classes = array();
	if ( $hide_label !== 'yes' ) {
		if ( $label_custom_typo === 'yes' ) {
			if ( $label_font ) {
				$label_classes[] = $label_font;
			}
			if ( $label_size ) {
				$label_classes[] = $label_size;
			}
			if ( $label_weight ) {
				$label_classes[] = 'font-weight-' . $label_weight;
			}
			if ( $label_transform ) {
				$label_classes[] = 'text-' . $label_transform;
			}
			if ( $label_height ) {
				$label_classes[] = $label_height;
			}
			if ( $label_space ) {
				$label_classes[] = $label_space;
			}
		}
	}
	if ( $label_responsive === 'yes' ) {
		if ( $label_desktop_visibility === 'yes' ) {
			$label_classes[] = 'desktop-hidden';
		}
		if ( $label_medium_visibility === 'yes' ) {
			$label_classes[] = 'tablet-hidden';
		}
		if ( $label_mobile_visibility === 'yes' ) {
			$label_classes[] = 'mobile-hidden';
		}
	}

	// Parent classes
	$parent_classes = array();
	if ( $hide_parent !== 'yes' ) {
		if ( $parent_type !== 'icon' && $parent_custom_typo === 'yes' ) {
			if ( $parent_font ) {
				$parent_classes[] = $parent_font;
			}
			if ( $parent_size ) {
				$parent_classes[] = $parent_size;
			}
			if ( $parent_weight ) {
				$parent_classes[] = 'font-weight-' . $parent_weight;
			}
			if ( $parent_transform ) {
				$parent_classes[] = 'text-' . $parent_transform;
			}
			if ( $parent_height ) {
				$parent_classes[] = $parent_height;
			}
			if ( $parent_space ) {
				$parent_classes[] = $parent_space;
			}
		}
	}
	$parent_responsive_classes = array();
	if ( $parent_responsive === 'yes' ) {
		if ( $parent_desktop_visibility === 'yes' ) {
			$parent_responsive_classes[] = 'desktop-hidden';
		}
		if ( $parent_medium_visibility === 'yes' ) {
			$parent_responsive_classes[] = 'tablet-hidden';
		}
		if ( $parent_mobile_visibility === 'yes' ) {
			$parent_responsive_classes[] = 'mobile-hidden';
		}
	}

	// Icon classes
	$icon_classes = array();
	if ( $icon_size ) {
		$icon_classes[] = $icon_size;
	}
	if ( $icon_responsive === 'yes' ) {
		if ( $icon_desktop_visibility === 'yes' ) {
			$icon_classes[] = 'desktop-hidden';
		}
		if ( $icon_medium_visibility === 'yes' ) {
			$icon_classes[] = 'tablet-hidden';
		}
		if ( $icon_mobile_visibility === 'yes' ) {
			$icon_classes[] = 'mobile-hidden';
		}
	}

	// Thumbnail classes
	$thumbnails_classes = array();
	if ( $thumbnails_size ) {
		$thumbnails_classes[] = 'uncode-custom-navigation__thumb--' . $thumbnails_size;
	}
	if ( $thumbnails_shape ) {
		$thumbnails_classes[] = 'uncode-custom-navigation__thumb--' . $thumbnails_shape;
	}
	if ( $thumbnails_responsive === 'yes' ) {
		if ( $thumbnails_desktop_visibility === 'yes' ) {
			$thumbnails_classes[] = 'desktop-hidden';
		}
		if ( $thumbnails_medium_visibility === 'yes' ) {
			$thumbnails_classes[] = 'tablet-hidden';
		}
		if ( $thumbnails_mobile_visibility === 'yes' ) {
			$thumbnails_classes[] = 'mobile-hidden';
		}
	}

	// Stacked classes
	if ( $stacked_layout === 'yes' ) {
		if ( $stacked_layout_desktop === 'yes' ) {
			$classes[] = 'desktop-stacked';
		}
		if ( $stacked_layout_tablet === 'yes' ) {
			$classes[] = 'tablet-stacked';
		}
		if ( $stacked_layout_mobile === 'yes' ) {
			$classes[] = 'mobile-stacked';
		}
	}

	// Gap classes
	if ( ! $navigation_gap ) {
		$navigation_gap = 'double-gap';
	}
	switch ( $navigation_gap ) {
		case 'small':
			$classes[] = 'single-gap';
		break;
		case 'large':
			$classes[] = 'triple-gap';
		break;
		case 'extra-large':
			$classes[] = 'quad-gap';
		break;
		default:
			$classes[] = 'double-gap';
		break;
	}

	// Vertical classes
	if ( ! $vertical_space ) {
		$vertical_space = 'small';
	}
	switch ( $vertical_space ) {
		case 'standard':
			$classes[] = 'standard-v-gap';
		break;
		case 'large':
			$classes[] = 'large-v-gap';
		break;
		default:
			$classes[] = 'small-v-gap';
		break;
	}

	$output = '<div class="uncode-wrapper ' . esc_attr( trim( implode( ' ', $classes ) ) ) . '"' . $el_id . '>';
		$nav_ids = uncode_vc_module_navigation_ids( $current_post_id, $current_post_type, $navigation_index, $generic_index, $no_loop );

		ob_start();
		?>

		<?php if ( $show_nav ) : ?>
			<nav class="uncode-custom-navigation">
				<ul class="uncode-custom-navigation__nav">
					<?php if ( $show_prev_el ) : ?>
						<?php
						$prev_post_obj = false;
						$skip_prev     = false;

						if ( $current_post_type === 'uncodeblock' ) {
							$prev_post_obj        = new stdClass();
							$prev_post_obj->id    = 0;
							$prev_post_obj->title = __( 'Previous Post Title', 'uncode' );
							$prev_post_obj->link  = '#';
						} else {
							$prev_post = isset( $nav_ids[0] ) ? $nav_ids[0] : false;
							$skip_prev = $no_loop === 'yes' && $prev_post === 0 ? true : false;

							if ( $prev_post ) {
								$prev_post_obj     = new stdClass();
								$prev_post_obj->id = $prev_post;

								if ( ! $skip_prev ) {
									$prev_post_obj->title = get_the_title( $prev_post_obj->id );
									$prev_post_obj->link  = get_permalink( $prev_post_obj->id );
								}
							}
						}
						?>
						<?php if ( $prev_post_obj || $skip_prev ) : ?>
							<li class="uncode-custom-navigation__item uncode-custom-navigation__item--prev">
								<?php if ( ! $skip_prev ) : ?>
									<a href="<?php echo esc_url( $prev_post_obj->link ); ?>" class="uncode-custom-navigation__link uncode-custom-navigation__link--prev btn-text-skin">
										<?php if ( $prev_icon ) : ?>
											<i class="uncode-custom-navigation__icon uncode-custom-navigation__icon--prev <?php echo esc_attr( trim( implode( ' ', $icon_classes ) ) ); ?> <?php echo esc_attr( $prev_icon ); ?>"></i>
										<?php endif; ?>
										<?php if ( $hide_thumbnails !== 'yes' ) : ?>
											<?php if ( $current_post_type === 'uncodeblock' ) : ?>
												<div class="uncode-custom-navigation__thumb uncode-custom-navigation__thumb--prev uncode-custom-navigation__thumb--placeholder <?php echo esc_attr( trim( implode( ' ', $thumbnails_classes ) ) ); ?>"></div>
											<?php else : ?>
												<?php if ( has_post_thumbnail( $prev_post_obj->id ) ) : ?>
													<div class="uncode-custom-navigation__thumb uncode-custom-navigation__thumb--prev <?php echo esc_attr( trim( implode( ' ', $thumbnails_classes ) ) ); ?>">
														<?php echo get_the_post_thumbnail( $prev_post_obj->id, 'thumbnail' ); ?>
													</div>
												<?php endif; ?>
											<?php endif; ?>
										<?php endif; ?>
										<?php if ( $hide_label !== 'yes' || $hide_title !== 'yes' ) : ?>
											<div class="uncode-custom-navigation__text uncode-custom-navigation__text--prev">
												<?php if ( $label_position !== 'after' && $hide_label !== 'yes' ) : ?>
													<span class="uncode-custom-navigation__label uncode-custom-navigation__label--prev <?php echo esc_attr( trim( implode( ' ', $label_classes ) ) ); ?>"><?php echo esc_html( $previous_label ); ?></span>
												<?php endif; ?>
												<?php if ( $hide_title !== 'yes' ) : ?>
													<span class="uncode-custom-navigation__title uncode-custom-navigation__title--prev <?php echo esc_attr( trim( implode( ' ', $title_classes ) ) ); ?>"><?php echo esc_html( $prev_post_obj->title ); ?></span>
												<?php endif; ?>
												<?php if ( $label_position === 'after' && $hide_label !== 'yes' ) : ?>
													<span class="uncode-custom-navigation__label uncode-custom-navigation__label--prev <?php echo esc_attr( trim( implode( ' ', $label_classes ) ) ); ?>"><?php echo esc_html( $previous_label ); ?></span>
												<?php endif; ?>
											</div>
										<?php endif; ?>
									</a>
								<?php endif; ?>
							</li>
						<?php endif; ?>
					<?php endif; ?>

					<?php if ( $show_nav_index ) : ?>
						<li class="uncode-custom-navigation__item uncode-custom-navigation__item--parent <?php echo esc_attr( trim( implode( ' ', $parent_responsive_classes ) ) ); ?>">
							<a href="<?php echo esc_url( $navigation_index_link ); ?>" class="uncode-custom-navigation__link uncode-custom-navigation__link--parent btn-text-skin">
								<?php if ( $parent_type === 'icon' && $parent_icon ) : ?>
									<i class="uncode-custom-navigation__title uncode-custom-navigation__title--parent uncode-custom-navigation__title--parent-icon <?php echo esc_attr( $parent_icon_size ); ?> <?php echo esc_attr( $parent_icon ); ?>"></i>
								<?php else : ?>
									<span class="uncode-custom-navigation__title uncode-custom-navigation__title--parent <?php echo esc_attr( trim( implode( ' ', $parent_classes ) ) ); ?>"><?php echo esc_html( $parent_label ); ?></span>
								<?php endif; ?>
							</a>
						</li>
					<?php endif; ?>

					<?php if ( $show_next_el ) : ?>
						<?php
						$next_post_obj = false;
						$skip_next     = false;

						if ( $current_post_type === 'uncodeblock' ) {
							$next_post_obj        = new stdClass();
							$next_post_obj->id    = 0;
							$next_post_obj->title = __( 'Next Post Title', 'uncode' );
							$next_post_obj->link  = '#';
						} else {
							$next_post = isset( $nav_ids[1] ) ? $nav_ids[1] : false;
							$skip_next = $no_loop === 'yes' && $next_post === 0 ? true : false;

							if ( $next_post ) {
								$next_post_obj     = new stdClass();
								$next_post_obj->id = $next_post;

								if ( ! $skip_next ) {
									$next_post_obj->title = get_the_title( $next_post_obj->id );
									$next_post_obj->link  = get_permalink( $next_post_obj->id );
								}
							}
						}
						?>
						<?php if ( $next_post_obj || $skip_next ) : ?>
							<li class="uncode-custom-navigation__item uncode-custom-navigation__item--next">
								<?php if ( ! $skip_next ) : ?>
									<a href="<?php echo esc_url( $next_post_obj->link ); ?>" class="uncode-custom-navigation__link uncode-custom-navigation__link--next btn-text-skin">
										<?php if ( $hide_label !== 'yes' || $hide_title !== 'yes' ) : ?>
											<div class="uncode-custom-navigation__text uncode-custom-navigation__text--next">
												<?php if ( $label_position !== 'after' && $hide_label !== 'yes' ) : ?>
													<span class="uncode-custom-navigation__label uncode-custom-navigation__label--next <?php echo esc_attr( trim( implode( ' ', $label_classes ) ) ); ?>"><?php echo esc_html( $next_label ); ?></span>
												<?php endif; ?>
												<?php if ( $hide_title !== 'yes' ) : ?>
													<span class="uncode-custom-navigation__title uncode-custom-navigation__title--next <?php echo esc_attr( trim( implode( ' ', $title_classes ) ) ); ?>"><?php echo esc_html( $next_post_obj->title ); ?></span>
												<?php endif; ?>
												<?php if ( $label_position === 'after' && $hide_label !== 'yes' ) : ?>
													<span class="uncode-custom-navigation__label uncode-custom-navigation__label--next <?php echo esc_attr( trim( implode( ' ', $label_classes ) ) ); ?>"><?php echo esc_html( $next_label ); ?></span>
												<?php endif; ?>
											</div>
										<?php endif; ?>
										<?php if ( $hide_thumbnails !== 'yes' ) : ?>
											<?php if ( $current_post_type === 'uncodeblock' ) : ?>
												<div class="uncode-custom-navigation__thumb uncode-custom-navigation__thumb--next uncode-custom-navigation__thumb--placeholder <?php echo esc_attr( trim( implode( ' ', $thumbnails_classes ) ) ); ?>"></div>
											<?php else : ?>
												<?php if ( has_post_thumbnail( $next_post_obj->id ) ) : ?>
													<div class="uncode-custom-navigation__thumb uncode-custom-navigation__thumb--next <?php echo esc_attr( trim( implode( ' ', $thumbnails_classes ) ) ); ?>">
														<?php echo get_the_post_thumbnail( $next_post_obj->id, 'thumbnail' ); ?>
													</div>
												<?php endif; ?>
											<?php endif; ?>
										<?php endif; ?>
										<?php if ( $next_icon ) : ?>
											<i class="uncode-custom-navigation__icon uncode-custom-navigation__icon--next <?php echo esc_attr( trim( implode( ' ', $icon_classes ) ) ); ?> <?php echo esc_attr( $next_icon ); ?>"></i>
										<?php endif; ?>
									</a>
								<?php endif; ?>
							</li>
						<?php endif; ?>
					<?php endif; ?>
				</ul>
			</nav>
		<?php endif; ?>

		<?php
		$html = ob_get_clean();
		$output .= $html;
	$output .= '</div>';
}

echo uncode_remove_p_tag($output);

// Add original post object if we have a custom post id via filter
if ( has_filter( 'uncode_navigation_current_post_id' ) ) {
	$original_post_object = get_post( $original_post_id );
	$GLOBALS['post'] = $original_post_object;
}
