(function( $ ) {
	'use strict';

	var query_args  = location.search,
		base_url = location.protocol + '//' + location.host + location.pathname;

	if ( -1 !== query_args.indexOf( 'notify=1' ) ) {
		window.history.replaceState( {}, document.title, base_url );
	}

	window.uncode_toolkit_privacy_has_consent = function( consent ) {
		// Check consents that are on by default first
		var consentSwitch = $('#gdpr-consent-' + consent);

		if (consentSwitch.length) {
			if (consentSwitch.attr('data-default-on') === 'true' && consentSwitch.prop('checked')) {
				return true;
			}
		}

		// Check saved cookies
		if ( Cookies.get('uncode_privacy[consent_types]') ) {
			var consentArray = JSON.parse( Cookies.get('uncode_privacy[consent_types]') );
			if ( consentArray.indexOf( consent ) > -1 ) {
				return true;
			}
		}

		return false;
	}

	$(function () {
		if (Uncode_Privacy_Parameters.logs_enabled === 'yes') {
			$.ajax({
				url: Uncode_Privacy_Parameters.ajax_url,
				data: {
					action: 'uncode_privacy_init_session',
					nonce_uncode_privacy_session: Uncode_Privacy_Parameters.nonce_uncode_privacy_session,
				},
				type: 'post',
				error: function (data) {
					if (Uncode_Privacy_Parameters.enable_debug == true) {
						// This console log is disabled by default
						// So nothing is printed in a typical installation
						//
						// It can be enabled for debugging purposes setting
						// the 'uncode_enable_debug_on_js_scripts' filter to true
						console.log('Init session failed (1)');
					}
				},
				success: function (response) {
					if (response && response.success === false) {
						if (Uncode_Privacy_Parameters.enable_debug == true) {
							// This console log is disabled by default
							// So nothing is printed in a typical installation
							//
							// It can be enabled for debugging purposes setting
							// the 'uncode_enable_debug_on_js_scripts' filter to true
							console.log('Init session failed (2)');
						}
					} else if (response && response.success === true) {
						if (Uncode_Privacy_Parameters.enable_debug == true) {
							// This console log is disabled by default
							// So nothing is printed in a typical installation
							//
							// It can be enabled for debugging purposes setting
							// the 'uncode_enable_debug_on_js_scripts' filter to true
							console.log('Init session ok');
						}
					} else {
						if (Uncode_Privacy_Parameters.enable_debug == true) {
							// This console log is disabled by default
							// So nothing is printed in a typical installation
							//
							// It can be enabled for debugging purposes setting
							// the 'uncode_enable_debug_on_js_scripts' filter to true
							console.log('Init session failed (3)');
						}
					}
				}
			});
		}

		if ( ! Cookies.get('uncode_privacy[privacy_bar]') ) {
			if ($('.gdpr.gdpr-privacy-bar').hasClass('gdpr-privacy-bar--float')) {
				$('.gdpr.gdpr-privacy-bar').show();
			} else {
				$('.gdpr.gdpr-privacy-bar').delay(1000).slideDown(600);
			}
		};

		/**
		 * This runs when user clicks on privacy preferences bar agree button.
		 */
		$(document).on('click', '.gdpr.gdpr-privacy-bar .gdpr-agreement', function() {
			var _this = $(this);

			$('#uncode_privacy_save_cookies_from_banner').val(true);
			$('#uncode_privacy_save_cookies_from_banner_button').val('accept');

			if (_this.hasClass('gdpr-submit-consent')) {
				if (_this.hasClass('gdpr-submit-accept-all')) {
					var switches = $('.gdpr-privacy-preferences-frm').find('.gdpr-consent-switch');

					switches.each(function() {
						var _this = $(this);
						_this.prop('checked', true);
					});
				}
				$('.gdpr-privacy-preferences-frm').submit();
			} else {
				var secureFlag = location.protocol === 'https:' ? true : false;
				Cookies.set('uncode_privacy[privacy_bar]', 1, { expires: 365, secure: secureFlag });
			}

			$('.gdpr.gdpr-privacy-bar').addClass('gdpr-hide-bar');
		});

		/**
		 * This runs when user clicks on privacy preferences bar reject button.
		 */
		$(document).on('click', '.gdpr.gdpr-privacy-bar .gdpr-reject', function() {
			var has_switch_on = false;
			var switches = $('.gdpr-privacy-preferences-frm').find('.gdpr-consent-switch');

			$('#uncode_privacy_save_cookies_from_banner').val(true);
			$('#uncode_privacy_save_cookies_from_banner_button').val('reject');

			switches.each(function() {
				var _this = $(this);
				if (_this.prop('checked')) {
					has_switch_on = true;
				}
				_this.removeAttr("checked");
			});

			if (has_switch_on) {
				$('.gdpr-privacy-preferences-frm').submit();
			} else {
				var secureFlag = location.protocol === 'https:' ? true : false;
				Cookies.set('uncode_privacy[privacy_bar]', 1, { expires: 365, secure: secureFlag });
			}

			$('.gdpr.gdpr-privacy-bar').addClass('gdpr-hide-bar');
		});

		/**
		 * Set the privacy bar cookie after privacy preference submission.
		 * This hides the privacy bar from showing after saving privacy preferences.
		 */
		$(document).on('submit', '.gdpr-privacy-preferences-frm', function() {
			var secureFlag = location.protocol === 'https:' ? true : false;
			Cookies.set('uncode_privacy[privacy_bar]', 1, { expires: 365, secure: secureFlag });
		});

		/**
		 * Display the privacy preferences modal.
		 */
		$(document).on('click', '.gdpr-preferences', function() {
			var type = $(this).data('type');
			$('.gdpr-overlay').fadeIn();
			$('body').addClass('gdpr-noscroll');
			$('.gdpr.gdpr-privacy-preferences .gdpr-wrapper').fadeIn();
		});

		/**
		 * Close the privacy preferences modal.
		 */
		$(document).on('click', '.gdpr.gdpr-privacy-preferences .gdpr-close, .gdpr-overlay', function() {
			$('.gdpr-overlay').fadeOut();
			$('body').removeClass('gdpr-noscroll');
			$('.gdpr.gdpr-privacy-preferences .gdpr-wrapper').fadeOut();
		});

		/**
		 * Trigger events
		 */
		$('body').on('click', '.gdpr-preferences', function(e){
			e.preventDefault();
			$(window).trigger('gdprOpen');
		}).on('click', '.gdpr.gdpr-privacy-preferences .gdpr-close, .gdpr-overlay', function(){
			$(window).trigger('gdprClose');
		});


		/**
		 * Check switch via JS
		 */
		var switches = $('.gdpr-switch').find('input');

		function add_active_color(el) {
			el.next().css('background', Uncode_Privacy_Parameters.accent_color);
		}

		function add_default_color(el) {
			el.next().css('background', '#ccc');
		}

		switches.each(function() {
			var _this = $(this);

			if ($('body').hasClass('logged-in')) {
				if (_this.prop('checked')) {
					add_active_color(_this);
				}
			}

			_this.on('change', function() {
				if (_this.prop('checked')) {
					add_active_color(_this);
				} else {
					add_default_color(_this);
				}
			});
		});

		if (!$('body').hasClass('logged-in')) {
			switches.each(function() {
				var _this = $(this);
				var type = _this.attr('name') == 'user_consents[]' ? 'consent' : 'cookie';

				if (type == 'consent') {
					var is_allowed = uncode_toolkit_privacy_has_consent(_this.val());

					if (is_allowed) {
						_this.prop('checked', true);
						add_active_color(_this);
					} else {
						_this.prop('checked', false);
						add_default_color(_this);
					}
				}
			});
		}

		/**
		 * Change link color in banner text
		 */
		var banner_links = $('.gdpr-privacy-bar .gdpr-content').find('a');

		banner_links.each(function() {
			add_link_color($(this));
		});

		function add_link_color(el) {
			el.css('color', Uncode_Privacy_Parameters.accent_color);
		}
	});

})( jQuery );
