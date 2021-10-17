jQuery(document).ready(function($) {

	let wizard = $( '#epkb-config-wizard-content, .epkb-config-wizard-content' );
	let need_to_apply_theme = true;
	
	// If the Wizard is not detected don't run scripts.
	if ( wizard.length <= 0 ) {
		return;
	}

	/**
	 * Highlight all completed steps in status bar.
	 */
	function wizard_status_bar_highlight_completed_steps( nextStep, current_wizard ){

		// Clear Completed Classes
		current_wizard.find( '.epkb-wizard-status-bar .epkb-wsb-step' ).removeClass( 'epkb-wsb-step--completed' );

		current_wizard.find( '.epkb-wizard-status-bar .epkb-wsb-step' ).each( function(){

			// Get each Step ID
			id = $( this ).attr( 'id' );

			// Get last character the number of each ID
			let lastChar = id[id.length -1];

			// If the ID is less than the current step then add completed class.
			if( lastChar < nextStep ){
				$( this ).addClass( 'epkb-wsb-step--completed' );
			}
		});
	}

	/**
	 * Change Next button to apply button on last step.
	 * Remove Class for all steps other than the first: epkb-wizard-button-container--first-step
	 */
	function wizard_change_buttons( current_wizard ){
		current_wizard.find( '.epkb-wizard-button-container' ).removeClass( 'epkb-wizard-button-container--final-step' );
		current_wizard.find( '.epkb-wizard-button-container' ).removeClass( 'epkb-wizard-button-container--first-step' );
		current_wizard.find('.epkb-wizard-header__exit-wizard').removeClass( 'epkb-wizard-header__exit-wizard--final-step' );
		let id = current_wizard.find( '.epkb-wsb-step--active' ).attr( 'id' );

		// Get last character the number of each ID
		let lastChar = Number(id[id.length - 1]);
		let stepLength = current_wizard.find('.epkb-wizard-status-bar li.epkb-wsb-step').length;
		if ( current_wizard.find('.epkb-wizard-ordering-ordering-preview').length ) {
			//stepLength = stepLength - 1;
		}
		if( lastChar === 1 ){
			current_wizard.find( '.epkb-wizard-button-container' ).addClass( 'epkb-wizard-button-container--first-step' );
		}
		
		if( lastChar === stepLength ){
			current_wizard.find( '.epkb-wizard-button-container' ).addClass( 'epkb-wizard-button-container--final-step' );
			current_wizard.find('.epkb-wizard-header__exit-wizard').addClass( 'epkb-wizard-header__exit-wizard--final-step' );
		}
	}

	/**
	 * Change the Top Description based on step.
	 */
	function wizard_show_step_description( current_wizard ){

		// Get the current active step ID
		let id = $( '.epkb-wsb-step--active' ).attr( 'id' );

		// Get last character the number of each ID
		let lastChar = Number(id[id.length -1]);

		// Clear all active classes
		current_wizard.find( '.epkb-wizard-header__desc__step' ).removeClass( 'epkb-wizard-desc-active' );

		// Set the Active class based on ID
		current_wizard.find( '#epkb-wizard-desc-step-' + lastChar ).addClass( 'epkb-wizard-desc-active' );

	}
	
	/**
	 * Special functions for the turning steps to move data between steps 
	 */
	function wizard_changed_step( from, to, current_wizard ) {

		// update KB name at the top
		if ( from == 1 && to == 2 ) {

			// Color wizard
			if ( current_wizard.find( '.epkb-wizard-name input' ).length ) {
				current_wizard.find( '#epkb_current_kb_name' ).text( current_wizard.find( '.epkb-wizard-name input' ).val() );
			}
		}

		// update preview from theme selection on Main Page colors
		if ( from == 2 && to == 3 ) {
			
			// Color wizard
			if ( current_wizard.find( '.epkb-wizard-name input' ).length ) {
				
				// change only if the user changed something on this page 
				if ( need_to_apply_theme ) {
					
					// change only once
					need_to_apply_theme = false;
					
					// move template to the next step when we press 'next'
					current_wizard.find( '#eckb-wizard-main-page-preview' ).html( '<div class="eckb-wizard-help__image"></div>' + current_wizard.find( '.epkb-wt-panel--active' ).html() );
					
					let data = JSON.parse( current_wizard.find( '#eckb-wizard-main-page-preview' ).find( '.theme-values' ).val() );
					
					// set colors on the right panel to theme's colors 
					epkb_try_set_colors_on_panel( 
						data,
						current_wizard.find( '.eckb-wizard-colors-content' )
					);
				
					// add first preset as current
					current_wizard.find('#epkb-wc-preset-0').data('colors', JSON.parse( current_wizard.find( '#eckb-wizard-main-page-preview' ).find( '.theme-values' ).val() ) );
					let currentThemeName = current_wizard.find( '.epkb-wt-tab.epkb-wt--active .epkb-wt-tab__name' ).text();
					currentThemeName = current_wizard.find( '.epkb-wt-tab.epkb-wt--active' ).data().template_id == 0 ? 'Saved KB' : currentThemeName;
					current_wizard.find( '#epkb-wc-preset-0 .epkb-wcp-current-settings__name' ).text( currentThemeName );
					
					// show/hide options groups 
					epkb_toggle_options_groups( current_wizard.find( '#eckb-wizard-main-page-preview' ).find( '.theme-values' ).val() );
					
					// update article page view
					epkb_wizard_update_color_article_view( current_wizard );
				}
			}
			
			// Features wizard 
			if ( current_wizard.find( '#epkb-wizard-button-apply' ).data( 'wizard-type' ) == 'features' ) {
				current_wizard.find( '.epkb-wizard-features-article-page-preview' ).prependTo( '#epkb-wsb-step-3-panel' );
			}
		}
		
		if ( from == 3 && to == 2 ) {
			// Features wizard 
			if ( current_wizard.find( '#epkb-wizard-button-apply').data( 'wizard-type' ) == 'features' ) {
				current_wizard.find( '.epkb-wizard-features-article-page-preview' ).prependTo( '#epkb-wsb-step-2-panel' );
			}
		}
		
		epkb_fix_collapsed_button();
	}

	/**
	 * Quickly scroll the user back to the top.
	 */
	function wizard_scroll_to_top(){
		$("html, body").animate({ scrollTop: 0 }, 0);
	}

	/**
	 * Button JS for next Step.
	 *
	 */
	wizard.find( '#epkb-wizard-button-next' ).on( 'click' , function(e){
		e.preventDefault();

		// Get currently active wizard
		let current_wizard = $( this ).closest( '#epkb-config-wizard-content, .epkb-config-wizard-content' );

		// Get the Step values
		let nextStep = Number( current_wizard.find( '#epkb-wizard-button-next' ).val() );
		let prevStep = Number( current_wizard.find( '#epkb-wizard-button-prev' ).val() );

		// Remove all Active Step classes in Step Status Bar.
		current_wizard.find( '.epkb-wsb-step' ).removeClass( 'epkb-wsb-step--active' );

		// Add Active class to next Step in Status Bar.
		current_wizard.find( '#epkb-wsb-step-' + nextStep ).addClass( 'epkb-wsb-step--active' );

		// Remove all active class from panels.
		current_wizard.find( '.epkb-wc-step-panel' ).removeClass( 'epkb-wc-step-panel--active' );

		// Add Active class to next panel in the steps.
		current_wizard.find( '#epkb-wsb-step-' + nextStep + '-panel' ).addClass( 'epkb-wc-step-panel--active' );

		// Update the Previous and Next Data values.
		current_wizard.find( '#epkb-wizard-button-prev' ).val( prevStep + 1 );
		current_wizard.find( '#epkb-wizard-button-next' ).val( nextStep + 1 );

		wizard_status_bar_highlight_completed_steps( nextStep, current_wizard );
		wizard_change_buttons( current_wizard );
		wizard_show_step_description( current_wizard );
		wizard_changed_step( nextStep - 1, nextStep, current_wizard );
		wizard_scroll_to_top();
	});

	/**
	 * Button JS for prev Step.
	 *
	 */
	wizard.find( '#epkb-wizard-button-prev' ).on( 'click' , function(e){
		e.preventDefault();

		// Get currently active wizard
		let current_wizard = $( this ).closest( '#epkb-config-wizard-content, .epkb-config-wizard-content' );

		// Get the Step values
		let nextStep = Number( current_wizard.find( '#epkb-wizard-button-next' ).val() );
		let prevStep = Number( current_wizard.find( '#epkb-wizard-button-prev' ).val() );

		// Remove all Active Step classes in Step Status Bar.
		current_wizard.find( '.epkb-wsb-step' ).removeClass( 'epkb-wsb-step--active' );

		// Add Active class to next Step in Status Bar.
		current_wizard.find( '#epkb-wsb-step-' + prevStep ).addClass( 'epkb-wsb-step--active' );

		// Remove all active class from panels.
		current_wizard.find( '.epkb-wc-step-panel' ).removeClass( 'epkb-wc-step-panel--active' );

		// Add Active class to next panel in the steps.
		current_wizard.find( '#epkb-wsb-step-' + prevStep + '-panel' ).addClass( 'epkb-wc-step-panel--active' );

		// Update the Previous and Next Data values.
		current_wizard.find( '#epkb-wizard-button-prev' ).val( prevStep - 1 );
		current_wizard.find( '#epkb-wizard-button-next' ).val( nextStep - 1 );

		wizard_status_bar_highlight_completed_steps( prevStep, current_wizard );
		wizard_change_buttons( current_wizard );
		wizard_show_step_description( current_wizard );
		wizard_changed_step( prevStep + 1,prevStep, current_wizard );
		wizard_scroll_to_top();
	});

	/**
	 * Theme Toggle JS
	 *
	 */
	wizard.find( '.epkb-wt-tab' ).on( 'click' , function(e){

		// Get Tab ID Value and Template ID
		let tab = $( this );
		let id = tab.attr( 'id' );
		let panel = $( '#'+id+'-panel' );

		// Remove all Active Tab classes
		$( '.epkb-wt-tab' ).removeClass( 'epkb-wt--active' );
		
		
		// Add Active class to click on theme.
		tab.addClass( 'epkb-wt--active' );
		
		
		// Remove all active class from panels.
		$( '.epkb-wt-panel' ).removeClass( ' epkb-wt-panel--active' );
		$( '.epkb-wt-panel' ).css({'opacity' : '0'});
		// Add Active class to panel with the same id
		panel.addClass( 'epkb-wt-panel--active' );
		panel.animate({'opacity' : '1'}, 200);
		// change styles for the tabs 
		let styles = JSON.parse(panel.find('.theme-values').val());
		
		if (styles) {

			$('#epkb-advanced-style').html(`
				#epkb-content-container .epkb-nav-tabs .active:after {
					border-top-color: ${styles.tab_nav_active_background_color}!important
				}
				#epkb-content-container .epkb-nav-tabs .active {
					background-color: ${styles.tab_nav_active_background_color}!important
				}
				#epkb-content-container .epkb-nav-tabs .active .epkb-category-level-1,
				#epkb-content-container .epkb-nav-tabs .active p {
					color: ${styles.tab_nav_active_font_color}!important
				}
				#epkb-content-container .epkb-nav-tabs .active:before {
					border-top-color: ${styles.tab_nav_border_color}!important
				}		
			`);
			original_styles = $('#epkb-advanced-style').html();
		}
		
		// set value true to change color pickers on "next" button click
		need_to_apply_theme = true;
		
		epkb_fix_collapsed_button();
	});

	/** Change colors on the Main and Article page settings */
	
	let original_styles = $('#epkb-advanced-style').html();
	
	$('body').on('color_changed', 'input', function(){
		let that = $(this);
		
		setTimeout(function(){
		if ( that.data('target_selector') ) {
			let $target = $( that.data('target_selector') );
			
			if ($target.length) {
				let new_styles = {};
				new_styles[that.data('style_name')] = that.val();
				$target.css(new_styles);
			}
			
			if ( that.data('target_selector') == 'tab_nav_active_font_color' 
				|| that.data('target_selector') == 'tab_nav_active_background_color' 
				|| that.data('target_selector') == 'tab_nav_border_color' 
				|| that.data('target_selector') == 'article_toc_cursor_hover_bg_color'
				|| that.data('target_selector') == 'article_toc_active_bg_color'
				|| that.data('target_selector') == 'article_toc_active_text_color'
				|| that.data('target_selector') == 'article_toc_cursor_hover_text_color' ) { 
					let tab_nav_active_font_color = $('.eckb-wizard-step-3 input[name=tab_nav_active_font_color]').val();
					let tab_nav_active_background_color = $('.eckb-wizard-step-3 input[name=tab_nav_active_background_color]').val();
					let tab_nav_border_color = $('.eckb-wizard-step-3 input[name=tab_nav_border_color]').val();
					let article_toc_cursor_hover_bg_color = $('.eckb-wizard-step-4 input[name=article_toc_cursor_hover_bg_color]').val();
					let article_toc_cursor_hover_text_color = $('.eckb-wizard-step-4 input[name=article_toc_cursor_hover_text_color]').val();
					let article_toc_active_text_color = $('.eckb-wizard-step-4 input[name=article_toc_active_text_color]').val();
					let article_toc_active_bg_color = $('.eckb-wizard-step-4 input[name=article_toc_active_bg_color]').val();
					// special trigger for active tabs 
					$('#epkb-advanced-style').html( original_styles + `
						#epkb-wsb-step-3-panel #epkb-content-container .epkb-nav-tabs .active:after {
							border-top-color: ${tab_nav_active_background_color} !important;
						}
						
						#epkb-wsb-step-3-panel #epkb-content-container .epkb-nav-tabs .active {
							background-color: ${tab_nav_active_background_color} !important;
						}
						#epkb-wsb-step-3-panel #epkb-content-container .epkb-nav-tabs .active .epkb-category-level-1,
						#epkb-wsb-step-3-panel #epkb-content-container .epkb-nav-tabs .active p {
							color: ${tab_nav_active_font_color} !important;
						}
						#epkb-wsb-step-3-panel #epkb-content-container .epkb-nav-tabs .active:before {
							border-top-color: ${tab_nav_border_color} !important;
						}
						
						#epkb-wsb-step-3-panel #epkb-content-container .epkb-nav-tabs {
							border-bottom-color: ${tab_nav_border_color} !important;
						}
						.eckb-wizard-step-4 .eckb-article-toc ul a.active {
							background: ${article_toc_active_bg_color} !important;
							color: ${article_toc_active_text_color} !important;
						}
						.eckb-wizard-step-4 .eckb-article-toc ul a:hover {
							background: ${article_toc_cursor_hover_bg_color} !important;
							color: ${article_toc_cursor_hover_text_color} !important;
						} 	`);
				}
		} 
		
		if ( typeof that.data('preview') == 'undefined' ) {
			return;
		}
		
		update_current_preview();
		
		}, 50);
	});

	/**
	 * Handle Apply Button
	 *
	 */
	wizard.find( '.epkb-wizard-button-apply' ).on( 'click' , function(e){

		// Get currently active wizard
		let current_wizard = $( this ).closest( '#epkb-config-wizard-content, .epkb-config-wizard-content' );

		let wizard_type = $(this).data('wizard-type');
		let kb_config = {};
		let article_sidebar_component_priority = {};
		let menu_ids = [];

		let postData = {
			wizard_type: wizard_type,
			action: 'epkb_apply_wizard_changes',
			_wpnonce_apply_wizard_changes: current_wizard.find( '#_wpnonce_apply_wizard_changes' ).val(),
			epkb_wizard_kb_id: current_wizard.find( '#epkb_wizard_kb_id' ).val(),
			kb_main_page_id: current_wizard.data( 'kb-main-page-id' ),
		};

		if ( wizard_type == 'theme' ) {
			
			if ( current_wizard.find( '#epkb-wsb-step-3-panel .theme-values' ).length ) {
				// Get Tab ID Value and Template ID
				kb_config = JSON.parse( current_wizard.find( '#epkb-wsb-step-3-panel .theme-values' ).val() );
			} else {
				// get default if we are on first 2 steps 
				kb_config = JSON.parse( current_wizard.find( '#epkb-wt-theme-current-panel .theme-values' ).val() );
			}
			
			// change template values to the values from inputs 
			current_wizard.find( '#epkb-wsb-step-3-panel .eckb-wizard-colors-content input, #epkb-wsb-step-4-panel .eckb-wizard-colors-content input' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});

			if ( current_wizard.find( '.epkb-menu-checkbox input[type=checkbox]:checked' ).length ) {
				current_wizard.find( '.epkb-menu-checkbox input[type=checkbox]:checked' ).each(function(){
					menu_ids.push($(this).prop('name').split('epkb_menu_')[1]);
				});
			}

			postData.kb_name = current_wizard.find('.epkb-wizard-name input').val();
			postData.kb_slug = current_wizard.find('.epkb-wizard-slug input').val();
			postData.menu_ids = menu_ids;
			postData.article_sidebar_component_priority = kb_config.article_sidebar_component_priority;
		} else if ( wizard_type == 'text' ) {
			// Get Tab ID Value and Template ID
			kb_config = JSON.parse( current_wizard.find( '#eckb_current_theme_values' ).val() );
			
			$('.eckb-wizard-single-text input, .eckb-wizard-wp-editor textarea').each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});
		} else if ( wizard_type == 'features' ) {
			// Get Tab ID Value and Template ID
			kb_config = JSON.parse( current_wizard.find( '#eckb_current_theme_values' ).val() );

			current_wizard.find('.eckb-wizard-single-text input').each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});

			current_wizard.find('.eckb-wizard-single-checkbox input').each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					
					if ($(this).prop('checked')) {
						kb_config[$(this).attr('name')] = 'on';
					} else {
						kb_config[$(this).attr('name')] = 'off';
					}
					
				}
			});

			current_wizard.find( '.config-input-group select' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});

			current_wizard.find( '.eckb-wizard-single-radio input[type=radio]:checked, .radio-buttons-vertical  input[type=radio]:checked, .radio-buttons-horizontal input[type=radio]:checked' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});

			current_wizard.find( '.text-select-fields-horizontal input' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});
			current_wizard.find( '.eckb-wizard-multiple-number-group input' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});

			current_wizard.find( '.epkb_toc_position select, .epkb_kb_sidebar_position select, .epkb_elay_sidebar_position select, .epkb_categories_position select' ).each(function(){
				article_sidebar_component_priority[$(this).prop('id')] = $(this).val();
				postData.article_sidebar_component_priority = article_sidebar_component_priority;
			});
			
		} else if ( wizard_type == 'search' ) {
			// Get Tab ID Value and Template ID
			kb_config = JSON.parse( current_wizard.find( '#eckb_current_theme_values' ).val() );

			current_wizard.find( '.eckb-wizard-single-text input' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});

			current_wizard.find( '.eckb-multiple-number-group input' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});

			current_wizard.find( '.eckb-wizard-single-checkbox input' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					
					if ($(this).prop('checked')) {
						kb_config[$(this).attr('name')] = 'on';
					} else {
						kb_config[$(this).attr('name')] = 'off';
					}
					
				}
			});

			current_wizard.find( '.config-input-group select' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});

			current_wizard.find( '.eckb-wizard-single-radio input[type=radio]:checked, .radio-buttons-vertical  input[type=radio]:checked, .radio-buttons-horizontal input[type=radio]:checked' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});

			current_wizard.find( '.text-select-fields-horizontal input' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});

			current_wizard.find( '.radio-buttons-horizontal input' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined' && $(this).prop('checked') ) {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});

		} else if ( wizard_type == 'ordering' ) {
			// Get Tab ID Value and Template ID
			kb_config = JSON.parse( current_wizard.find( '#eckb_current_theme_values' ).val() );

			current_wizard.find( '.eckb-wizard-single-radio input[type=radio]:checked, .radio-buttons-vertical  input[type=radio]:checked, .radio-buttons-horizontal input[type=radio]:checked' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});
			
			
			kb_config.sidebar_show_articles_before_categories = kb_config.show_articles_before_categories;
			
			// Sequence 
			postData.epkb_new_sequence = epkb_get_new_main_page_sequence();
			postData.top_cat_sequence = epkb_get_top_category_seq();
		} else if ( wizard_type == 'global' ) {
			// Get Tab ID Value and Template ID
			kb_config = JSON.parse( current_wizard.find( '#eckb_current_theme_values' ).val() );

			current_wizard.find( '.eckb-wizard-single-text input, input[name=kb_articles_common_path], input[name=categories_in_url_enabled]' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});

			current_wizard.find( '.eckb-wizard-single-radio input[type=radio]:checked, .radio-buttons-vertical  input[type=radio]:checked, .radio-buttons-horizontal input[type=radio]:checked' ).each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});

			current_wizard.find( '.eckb-wizard-single-checkbox input' ).each(function(){
				
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					
					if ($(this).prop('checked')) {
						kb_config[$(this).attr('name')] = 'on';
					} else {
						kb_config[$(this).attr('name')] = 'off';
					}
					
				}
			});
		}

		postData.kb_config = kb_config;

		epkb_send_ajax ( current_wizard, postData, function( response ) {
			// after ajax function 
			
			// Check save and exit button 
			if ( current_wizard.find( '.epkb-wizard-header__exit-wizard input:checked' ).length ) {
				location.href = current_wizard.find( '.epkb-wizard-header__exit-wizard a' ).prop('href');
				return;
			}
			
			if ( wizard_type == 'theme' ) {
				if ( ! response.error && typeof response.message !== 'undefined' ) {
					$('#epkb-wsb-step-5-panel').removeClass('epkb-wc-step-panel--active');
					$('#epkb-wsb-step-6-panel').addClass('epkb-wc-step-panel--active').show();
				}

			} else if ( wizard_type == 'text' ) {
				if ( ! response.error && typeof response.message !== 'undefined' ) {
					$('#epkb-wsb-step-4-panel').removeClass('epkb-wc-step-panel--active');
					$('#epkb-wsb-step-5-panel').addClass('epkb-wc-step-panel--active').show();
				}
			} else if ( wizard_type == 'features' ) {  // for Features Wizard
				if ( ! response.error && typeof response.message !== 'undefined' ) {
					$('#epkb-wsb-step-5-panel').removeClass('epkb-wc-step-panel--active');
					$('#epkb-wsb-step-6-panel').addClass('epkb-wc-step-panel--active').show();
				}
			} else if ( wizard_type == 'search' ) {  // for Search Wizard
				if ( ! response.error && typeof response.message !== 'undefined' ) {
					
					if ( $("#epkb_wizard_show_article_step").val() == 1 ) {
						$('#epkb-wsb-step-3-panel').removeClass('epkb-wc-step-panel--active');
						$('#epkb-wsb-step-4-panel').addClass('epkb-wc-step-panel--active').show();
					} else {
						$('#epkb-wsb-step-2-panel').removeClass('epkb-wc-step-panel--active');
						$('#epkb-wsb-step-3-panel').addClass('epkb-wc-step-panel--active').show();
					}
					
					
				}
			} else if ( wizard_type == 'ordering' ) {  // for Ordering  Wizard
				if ( ! response.error && typeof response.message !== 'undefined' ) {

				}
			}  else if ( wizard_type == 'global' ) {  // for Global  Wizard
				if ( ! response.error && typeof response.message !== 'undefined' ) {

					current_wizard.find( '#epkb-wsb-step-2-panel' ).removeClass( 'epkb-wc-step-panel--active' );
					current_wizard.find( '#epkb-wsb-step-3-panel' ).addClass( 'epkb-wc-step-panel--active' ).show();

					// refresh page
					location.reload();
				}
			}
			
		}, false, epkb_vars.save_config);
	});
	
	/**
	 * SAVE AND EXIT BUTTON
	 */
	$('.epkb-wizard-header__exit-wizard a').on('click',function(e){

		// Get currently active wizard
		let current_wizard = $( this ).closest( '#epkb-config-wizard-content, .epkb-config-wizard-content' );

		if ( $('.epkb-wizard-header__exit-wizard input:checked').length ) {
			e.preventDefault();
			// check if we are on the themes choose screen and save it before saving 
			if ( current_wizard.find( '#epkb-wizard-button-apply' ).data('wizard-type') == 'theme' && current_wizard.find( '#epkb-wsb-step-2-panel' ).hasClass('epkb-wc-step-panel--active') ) {
				current_wizard.find( '#epkb-wizard-button-next' ).trigger('click');
			}
			
			// Need delay to wait all events and changing of the data between click and save 
			setTimeout(function() {
				wizard.find( '.epkb-wizard-button-apply' ).trigger('click');
			}, 100);
		}
	});

	$('.epkb-wizard-header__exit-wizard input').on( 'change', function(e){

		// Get currently active wizard
		let current_wizard = $( this ).closest( '#epkb-config-wizard-content, .epkb-config-wizard-content' );

		if ( $(this).prop('checked') ) {
			current_wizard.find( '.epkb-wizard-header__exit-wizard a' ).text( $(this).data('save_exit') );
			current_wizard.find( '.epkb-wizard-header__exit-wizard a' ).addClass('epkb_and_save');
		} else {
			current_wizard.find( '.epkb-wizard-header__exit-wizard a' ).text( $(this).data('exit') );
			current_wizard.find( '.epkb-wizard-header__exit-wizard a' ).removeClass('epkb_and_save');
		}
	});

	/**
	 * SHOW INFO MESSAGES
	 */
	function epkb_admin_notification( $title, $message , $type ) {

		clear_message_after_set_time();

		return '<div class="eckb-bottom-notice-message">' +
			'<div class="contents">' +
			'<span class="' + $type + '">' +
			($title ? '<h4>' + $title + '</h4>' : '' ) +
			($message ? $message : '') +
			'</span>' +
			'</div>' +
			'</div>';
	}
	
	/** 
	 * Set colors on the panel from JSON or object
	 * $data - json or object where { input_name : value }
	 * $panel_parent jQuery object with parent div of the color panel 
	*/
	function epkb_try_set_colors_on_panel( data, $panel_parent ) {
		
		if ( typeof data == 'string') {
			data = JSON.parse( data );
		}
		
		if (data.length == 0) {
			return;
		}
		
		// check colors 
		$panel_parent.find('input.wp-color-picker').each(function(){
			if ( typeof data[$(this).attr('name')] !== 'undefined' ) {
				$(this).val(data[$(this).attr('name')]).iris('color', data[$(this).attr('name')]);
				$(this).data( 'default_color', data[$(this).attr('name')] );
			}
		});
		
		// check text fields 
		$('.config-input-group.eckb-wizard-single-text input, .config-input-group.eckb-multiple-number-group input').each(function() {
			
			if ( typeof data[$(this).attr('name')] == 'undefined' ) {
				return;
			}
			
			$(this).val(data[$(this).attr('name')]);
				
			if ( typeof $(this).data('preview') == 'undefined' ) {
				$(this).trigger('change');
			}
			
		});
		
		// check checkboxes 
		$('.config-input-group.eckb-wizard-single-checkbox input').each(function() {
			if ( typeof data[$(this).attr('name')] !== 'undefined' ) {
				if ( data[$(this).attr('name')] == 'on' ) {
					$(this).prop('checked', 'checked');
				} else {
					$(this).prop('checked', false);
				}
				
				if ( typeof $(this).data('preview') == 'undefined' ) {
					$(this).trigger('change');
				}
			}
		});
		
		// check radio 
		// TODO in future
		
		// check selects 
		$('.config-input-group.eckb-wizard-single-dropdown select').each(function() {
			if ( typeof data[$(this).attr('name')] !== 'undefined' ) {
				$(this).val(data[$(this).attr('name')]);
				
				if ( typeof $(this).data('preview') == 'undefined' ) {
					$(this).trigger('change');
				} 
			}
		});
		
		// change theme values for searh wizard 
		if ( $('#epkb-config-wizard-content').hasClass('eckb-wizard-search') ) {
			let old_val = JSON.parse($('#eckb_current_theme_values').val());
			
			for ( let name in data ) {
				old_val[name] = data[name];
			}
			
			$('#eckb_current_theme_values').val( JSON.stringify(old_val) );
			
			update_current_preview('main_page');
			update_current_preview('article_page', true);
		}
	}
	
	/**
	 * Preset functions 
	 */
	$('body').on('click', '.epkb-preset-button', function(){

		// Get currently active wizard
		let current_wizard = $( this ).closest( '#epkb-config-wizard-content, .epkb-config-wizard-content' );

		let data = $(this).data('colors');
		
		if ($(this).closest('#epkb-wsb-step-3-panel').length) {
			// Main page presets 
			
			epkb_try_set_colors_on_panel( 
				data,
				current_wizard.find( '.eckb-wizard-colors-content' )
			);
		}
		
		if ($(this).closest('#epkb-wsb-step-1-panel').length) {
			// Search main page presets 
			
			epkb_try_set_colors_on_panel( 
				data,
				current_wizard.find( '.epkb-wizard-search-selection-container' )
			);
		}
	});
	
	/**
	 * Check and toggle option groups depends on the options of the current template 
	 */
	function epkb_toggle_options_groups( $options_input ) {

		if ( ! $options_input.length ) {
			return;
		}
		
		let config = JSON.parse( $options_input );
		$('.eckb-wizard-colors-content, .eckb-wizard-texts-content, .eckb-wizard-features-content, .eckb-wizard-search-content').each(function(){
			
			let depends = $(this).data('depends');
				
			if ( depends === undefined ) {
				return;
			}


			// check show off options - they are primary
			let show = true;
			let values = '';

			if ( depends.show_when !== undefined && Object.keys(depends.show_when) ) {

				show = false;
				for ( let name in depends.show_when ) {

					if ( $('select#'+name).length ) {
						config[name] = $('select#'+name).val();
					}
					
					// TODO in future - add other selects/inputs
					
					if ( config[name] !== undefined ) {
						values = depends.show_when[name];
						values = values.split('|');

						for ( let val of values ) {

							if ( config[name] == val ) {
								show = true;
								break;
							}
						}
					}
				}
			}

			if ( depends.hide_when !== undefined && Object.keys(depends.hide_when) ) {

				for ( let name in depends.hide_when ) {
					
					if ( $('select#'+name).length ) {
						config[name] = $('select#'+name).val();
					}
					
					// TODO in future - add other selects/inputs
					
					if ( config[name] !== undefined ) {
						values = depends.hide_when[name];
						values = values.split('|');

						for ( let val of values ) {

							if ( config[name] == val ) {
								
								show = false;
								break;
							}
						}
					}
				}
			}

			if ( show ) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
	}
	

	/********************************************************************
	 *                      Article TOC
	 ********************************************************************/
	function activate_TOC() {
		
		$('.eckb-article-toc').each(function(){
			
			let articleToc     = $(this);
			let articleContent = articleToc.closest('#eckb-article-body').find('#eckb-article-content-body');
			
			if (articleToc.length) {

				if ( !articleToc.data('min') ) {
					articleToc.data('min', 1);
				}
				if ( !articleToc.data('max') ) {
					articleToc.data('min', 6);
				}

				if ( !articleToc.data('offset') ) {
					articleToc.data('offset', 50);
				}

				let firstLevel = articleToc.data('min');
				let lastLevel = articleToc.data('max');
				let searchStr = 'h' + firstLevel;
				let currentId = '';
				
				let params = {
					'scrollOffset' : articleToc.data('offset'),
					'getActiveElement' : function(id) {
						
						if ( currentId == id ) {
							return 'a[href="#' + id + '"]';
						}
						
						currentId = id;
						
						let item = $('.eckb-article-toc__inner a[href="#' + id + '"]');
						if ( item.length ) {
							
							$('#eckb-article-page-container-v2 .eckb-article-toc .eckb-article-toc__inner').animate({ scrollTop: item.position().top }, 50);
						}
						
						return 'a[href="#' + id + '"]';
					}
				};
				let exclude_class = false;
				
				if ( typeof articleToc.data('exclude_class') !== 'undefined' ) {
					exclude_class = articleToc.data('exclude_class');
				}
				
				while ( firstLevel < lastLevel ) {
					firstLevel++;
					searchStr += ', h' + firstLevel;
				}

				// return object with headers and their ids
				function getArticleHeaders() {
					let headers = [];

					articleContent.find(searchStr).each(function(){
						
						if ( $(this).text().length == 0 ) {
							return;
						}
						
						if ( exclude_class && $(this).hasClass( articleToc.data('exclude_class') ) ) {
							return;
						}
							
						let tid;
						let header = {};

						if ($(this).prop('id')) {
							tid = $(this).prop('id');
						} else {
							tid = 'articleTOC_' + headers.length;
							$(this).prop('id', tid);
						}

						header.id = tid;
						header.title = $(this).text();

						if ('H1' == $(this).prop("tagName")) {
							header.level = 1;
						} else if ('H2' == $(this).prop("tagName")) {
							header.level = 2;
						} else if ('H3' == $(this).prop("tagName")) {
							header.level = 3;
						} else if ('H4' == $(this).prop("tagName")) {
							header.level = 4;
						} else if ('H5' == $(this).prop("tagName")) {
							header.level = 5;
						} else if ('H6' == $(this).prop("tagName")) {
							header.level = 6;
						}

						headers.push(header);
					});

					if ( headers.length == 0 ) {
						return headers;
					}

					// find max and min header level
					let maxH = 1;
					let minH = 6;

					headers.forEach(function(header){
						if (header.level > maxH) {
							maxH = header.level
						}

						if (header.level < minH) {
							minH = header.level
						}
					});

					// move down all levels to have 1 lowest
					if ( minH > 1 ) {
						headers.forEach(function(header, i){
							headers[i].level = header.level - minH + 1;
						});
					}

					// now we have levels started from 1 but maybe some levels do not exist

					// check level exist and decrease if not exist
					let i = 1;

					while (i < maxH) {
						let levelExist = false;
						headers.forEach(function(header){
							if (header.level == i) {
								levelExist = true;
							}
						});

						if (levelExist) {
							// all right, level exist, go to the next
							i++;
						} else {
							// no such levelm move all levels that more than current down and check once more
							headers.forEach(function(header, j){
								if (header.level > i) {
									headers[j].level = header.level - 1;
								}
							});
						}
						i++;
					}

					return headers;
				}

				// return html from headers object
				function getToCHTML(headers) {
					let html;

					if ( articleToc.find('.eckb-article-toc__title').length ) {
						let title = articleToc.find('.eckb-article-toc__title').html();
						html = `
							<div class="eckb-article-toc__inner">
								<div class="eckb-article-toc__title">${title}</div>
								<ul>
							`;
					} else {
						html = `
							<div class="eckb-article-toc__inner">
								<ul>
							`;
					}


					headers.forEach(function(header){
						html += `<li class="eckb-article-toc__level eckb-article-toc__level-${header.level}"><a href="#${header.id}">${header.title}</a></li>`;
					});

					html += `
								</ul>
							</div>
						`;

					return html;
				}

				let articleHeaders = getArticleHeaders();

				// show TOC only if headers preset
				if ( articleHeaders.length > 0 ) {
					articleToc.html(getToCHTML(articleHeaders));
					articleContent.find(searchStr).scrollSpy(params);
					articleToc.fadeIn();
				}
			}
			
		});
	}
	activate_TOC();
	
	/** 
	 * Update article view on the colors wizard depends of the selected theme 
	 */
	 
	function epkb_wizard_update_color_article_view( current_wizard ) {
		// get current config 
		let kb_config = {};
		
		kb_config = JSON.parse( current_wizard.find( '#epkb-wsb-step-3-panel .theme-values' ).val() );
		// change template values to the values from inputs 
		current_wizard.find( '#epkb-wsb-step-3-panel .eckb-wizard-colors-content input, #epkb-wsb-step-4-panel .eckb-wizard-colors-content input' ).each(function(){
			if (kb_config[$(this).attr('name')] !== 'undefined') {
				kb_config[$(this).attr('name')] = $(this).val();
			}
		});
		
		let postData = {
			action: 'epkb_wizard_update_color_article_view',
			_wpnonce_apply_wizard_changes: current_wizard.find( '#_wpnonce_apply_wizard_changes' ).val(),
			kb_config: kb_config,
		};
		
		epkb_send_ajax( current_wizard, postData, function( response ){
			if ( typeof response.html !== 'undefined' ) {
				current_wizard.find('#eckb-wizard-article-page-preview').html( '<div class="eckb-wizard-help__image"></div>' + response.html);
				activate_TOC();
				current_wizard.find('.epkb-wizard-header__exit-wizard .epkb-wizard-header__exit-wizard__label').animate({'opacity': '1'}, 200);
			}
		}, false, '', true );
	}
	
	/**
	 * Check KB Url and show notice if bad 
	 */
	
	function eckb_wizard_check_slug() {

		// Get currently active wizard
		let current_wizard = $( this ).closest( '#epkb-config-wizard-content, .epkb-config-wizard-content' );

		let input = current_wizard.find( '.epkb-wizard-slug input' );
		if ( input.length == 0 ) {
			return true;
		}
		
		let val = input.val();
		let isValid = true;

		if ( val.startsWith("http") ) {
			isValid = false;
		}

		if ( val.startsWith("www") ) {
			isValid = false;
		}

		if ( val.endsWith(".") ) {
			isValid = false;
		}

		if ( val.endsWith(".com") ) {
			isValid = false;
		}

		if ( val.endsWith(".org") ) {
			isValid = false;
		}

		if ( isValid ) {
			current_wizard.find( '#epkb-wizard-slug-error' ).hide();
			current_wizard.find( '#epkb-wizard-button-next' ).prop('disabled', false);
			input.removeClass('epkb-wizard-input-error');
		} else {
			current_wizard.find( '#epkb-wizard-slug-error' ).show();
			current_wizard.find( '#epkb-wizard-button-next' ).prop('disabled', 'disabled');
			input.addClass('epkb-wizard-input-error');
		}
	}
	
	$( '.epkb-wizard-slug input' ).on( 'change keyup paste', eckb_wizard_check_slug );
	$( '.epkb-wizard-slug input' ).trigger( 'change' );
	
	/********************************************************************
	 *
	 *                      TEXT WIZARD
	 *
	 ********************************************************************/
	
	/**
	 * Initial Settings
	 */
	
	if ( $('#eckb_current_theme_values').length ) {
		// hide/show texts depends on the config 
		epkb_toggle_options_groups( $('#eckb_current_theme_values').val() );
	}
	
	/** 
	 * Check and change texts when the user change input 
	 */
	$('body').on('change paste keyup', '.eckb-wizard-single-text input, .eckb-wizard-wp-editor textarea, .eckb-wizard-single-dropdown select, .eckb-wizard-multiple-number-group input', function() {
		let input = $(this);

		if ( typeof input.data('target_selector') == 'undefined' ) {
			return;
		}
		
		target = $( input.data('target_selector') );		

		if ( ! target.length ) {
			return;
		}
		
		if ( input.data('text') == '1' ) {
			target.text( input.val() );
		}
		
		if ( input.data('html') == '1' ) {	
				
			target.html( input.val() );
		}
		
		epkb_hightlight_changed_element(target);
		
		if ( ! ( typeof input.data('target_attr') === 'undefined' ) ) {	
			let attributes = input.data('target_attr').split('|');
			
			for ( let attribute of attributes ) {
				target.prop( attribute, input.val() );
			}
		}
		
		if ( typeof input.data('style_name') === 'undefined' ) {
			return;
		}
		
		let postfix = '';
		
		if ( ! ( typeof input.data('postfix') === 'undefined' ) ) {
			postfix = input.data('postfix')
		}
		
		let new_styles = {};
		new_styles[input.data('style_name')] = input.val() + postfix;
		target.css(new_styles);
				
	});


	/********************************************************************
	 *
	 *                      FEATURES WIZARD
	 *
	 ********************************************************************/

	// TODO

	/********************************************************************
	 *
	 *                      SEARCH WIZARD
	 *
	 ********************************************************************/

	// TODO
	
	/********************************************************************
	 *
	 *                      ORDERING WIZARD
	 *
	 ********************************************************************/

	/** Initial Settings */

	let wizard_ordering_preview = $( '.epkb-wizard-ordering-ordering-preview' );
	if ( wizard_ordering_preview.length ) {
		$( '#eckb-wizard-ordering__page' ).on( 'change', 'input', epkb_wizard_update_ordering_view );
	}

	$( '.epkb-admin__secondary-panel__order-articles' ).on( 'click', function() {
		if ( wizard_ordering_preview.hasClass( 'epkb-wizard-ordering-ordering-preview--init' ) ) {
			return;
		}
		wizard_ordering_preview.addClass( 'epkb-wizard-ordering-ordering-preview--init' );
		epkb_wizard_update_ordering_view();
	});

	function epkb_wizard_update_ordering_view() {

		let current_wizard = $( '#eckb-wizard-ordering__page' );

		// get current config 
		let sequence_settings = {
			categories_display_sequence : current_wizard.find( 'input[name=categories_display_sequence]:checked' ).val(),
			articles_display_sequence : current_wizard.find( 'input[name=articles_display_sequence]:checked' ).val(),
			show_articles_before_categories : current_wizard.find( 'input[name=show_articles_before_categories]:checked' ).val(),
			sidebar_show_articles_before_categories : current_wizard.find( 'input[name=show_articles_before_categories]:checked' ).val(),
		};
		
		let postData = {
			action: 'epkb_wizard_update_order_view',
			_wpnonce_apply_wizard_changes: current_wizard.find( '#_wpnonce_apply_wizard_changes' ).val(),
			sequence_settings: sequence_settings,
			epkb_kb_id: current_wizard.find( '#epkb_wizard_kb_id' ).val()
		};
		
		epkb_send_ajax( current_wizard, postData, function( response ){
			if ( typeof response.html !== 'undefined' ) {
				
				let preview = '';
				
				if ( response.message.length ) {
					preview += '<h1 class="eckb-wisard-ordering-title">' + response.message + '</h1>';
				}
				
				preview += response.html;

				current_wizard.find( '.epkb-wizard-ordering-ordering-preview' ).html( preview );
				
				epkb_enable_custom_ordering( ( sequence_settings.articles_display_sequence == 'user-sequenced' ), ( sequence_settings.categories_display_sequence == 'user-sequenced' ) );

				current_wizard.find( '.epkb-wizard-header__exit-wizard .epkb-wizard-header__exit-wizard__label' ).animate({'opacity': '1'}, 200);
			}
		}, false, '', true );
	}

	function epkb_enable_custom_ordering( articles, categories ) {
		if ( ! articles && ! categories ) {
			return false;
		} 
		
		if ( categories ) {
			// Order Top Categories for Tabs layout
			$('.epkb-wizard-ordering-ordering-preview .epkb-top-categories-list').sortable({
				axis: 'x',
				forceHelperSize: true,
				forcePlaceholderSize: true,
				// handle: '.epkb-sortable-articles',
				opacity: 0.8,
				placeholder: 'epkb-sortable-placeholder',
			});
			
			// Order Categories
			$('.epkb-wizard-ordering-ordering-preview .eckb-categories-list, .epkb-wizard-ordering-ordering-preview .elay-sidebar__cat-container').sortable({
				axis: 'x,y',
				forceHelperSize: true,
				forcePlaceholderSize: true,
				// handle: '.epkb-sortable-articles',
				opacity: 0.8,
				placeholder: 'epkb-sortable-placeholder',
			});
			
			// Order Sub-categories
			$('.epkb-wizard-ordering-ordering-preview .eckb-sub-category-ordering').sortable({
				axis: 'x,y',
				forceHelperSize: true,
				forcePlaceholderSize: true,
				// handle: '.epkb-sortable-articles',
				opacity: 0.8,
				placeholder: 'epkb-sortable-placeholder',
			});

			// Order Sub-sub-categories
			$('.epkb-wizard-ordering-ordering-preview .eckb-sub-sub-category-ordering').sortable({
				axis: 'x,y',
				forceHelperSize: true,
				forcePlaceholderSize: true,
				// handle: '.epkb-sortable-articles',
				opacity: 0.8,
				placeholder: 'epkb-sortable-placeholder',
			});
		}

		if ( articles ) {
			// Order Articles
			$('.epkb-wizard-ordering-ordering-preview .epkb-articles').sortable({
				axis: 'y',
				forceHelperSize: true,
				forcePlaceholderSize: true,
				// handle: '.epkb-sortable-articles',
				opacity: 0.8,
				placeholder: 'epkb-sortable-placeholder',
			});
		}
		
		$('.epkb-wizard-ordering-ordering-preview').find( 'a' ).css('cursor', 'move', 'important');
	}
	
	function epkb_get_new_main_page_sequence() {
		let new_sequence = '';

		// make virtual tree and sort articles when artiles on the top of the categories
		if ($('.epkb-wizard-ordering-ordering-preview').find('#epkb-content-container').length) {
			// not sidebar template
			$('.epkb-wizard-ordering-ordering-preview').append('<div class="epkb-virtual-articles" style="display:none!important;">' + $('.epkb-wizard-ordering-ordering-preview').find('#epkb-content-container').html() + '</div>');

			$('.epkb-virtual-articles').find('ul.epkb-articles').each(function(){
				// check if we have articles on the top - move them to the bottom
				if ($(this).next().length && $(this).next().prop('tagName') == 'UL') {
					let wrap = $(this).parent();

					$(this).appendTo(wrap);
				}
			});
		}
		
		// handle Elegant Layouts with Sidebar
		if ($('.epkb-wizard-ordering-ordering-preview #el'+'ay-sidebar-layout-page-container').find('.el'+'ay-sidebar').length) {
			// sidebar template
			$('.epkb-wizard-ordering-ordering-preview #el'+'ay-sidebar-layout-page-container').append('<div class="epkb-virtual-articles" style="display:none!important;">' + $('.epkb-wizard-ordering-ordering-preview #el'+'ay-sidebar-layout-page-container').find('.el'+'ay-sidebar').html() + '</div>');

			$('.epkb-wizard-ordering-ordering-preview .epkb-virtual-articles').find('ul.el'+'ay-articles').each(function(){
				// check if we have articles on the top - move them to the bottom
				if ($(this).next().length && $(this).next().prop('tagName') == 'UL') {
					let wrap = $(this).parent();

					$(this).appendTo(wrap);
				}
			});
		}

		// handle Elegant Layouts with Grid
		if ( $('.epkb-wizard-ordering-ordering-preview #el'+'ay-grid-layout-page-container').length ) {
			$('.epkb-wizard-ordering-ordering-preview').find('[data-kb-type]').each(function (i, obj) {

				// some layouts like Tabs Layout has top categories and sub-categories "disconnected". Connect them here
				let top_cat_id = $(this).data('kb-top-category-id') ? $(this).data('kb-top-category-id') : '';
				if (top_cat_id) {
					new_sequence += 'xx' + top_cat_id + 'x' + 'category';
				}

				if (typeof $(this).attr("data-kb-type") !== 'undefined' && $(this).attr("data-kb-type") == 'top-category-no-articles') {
					return true;
				}

				// add sub-category or articles
				let category_id = typeof $(this).data('kb-category-id') === 'undefined' ? $(this).data('kb-article-id') : $(this).data('kb-category-id');
				if (typeof category_id !== 'undefined') {
					new_sequence += 'xx' + category_id + 'x' + $(this).attr("data-kb-type");
				}
			});

			return new_sequence;
		}
		
		// for v2 
		if ($('.epkb-wizard-ordering-ordering-preview #elay-sidebar-container-v2').length) {
			// Wsidebar template
			$('.epkb-wizard-ordering-ordering-preview #elay-sidebar-container-v2').append('<div class="epkb-virtual-articles" style="display:none!important;">' + $('.epkb-wizard-ordering-ordering-preview #elay-sidebar-container-v2').html() + '</div>');

			$('.epkb-wizard-ordering-ordering-preview .epkb-virtual-articles').find('ul.el'+'ay-articles').each(function(){
				// check if we have articles on the top - move them to the bottom
				if ($(this).next().length && $(this).next().prop('tagName') == 'UL') {
					let wrap = $(this).parent();

					$(this).appendTo(wrap);
				}
			});
		}

		// handle the rest
		$('.epkb-wizard-ordering-ordering-preview').find('.epkb-virtual-articles [data-kb-type]').each(function(i, obj) {

			// some layouts like Tabs Layout has top categories and sub-categories "disconnected". Connect them here
			let top_cat_id = $(this).data('kb-top-category-id') ? $(this).data('kb-top-category-id') : '';
			if ( top_cat_id ) {
				new_sequence += 'xx' + top_cat_id + 'x' + 'category';
			}

			if ( typeof $(this).attr("data-kb-type") !== 'undefined' && $(this).attr("data-kb-type") == 'top-category-no-articles' ) {
				return true;
			}

			// add sub-category or articles
			let category_id = typeof $(this).data('kb-category-id') === 'undefined' ? $(this).data('kb-article-id') : $(this).data('kb-category-id');
			if ( typeof category_id !== 'undefined' ) {
				new_sequence += 'xx' + category_id + 'x' + $(this).attr("data-kb-type");
			}
		});
		
		$('.epkb-wizard-ordering-ordering-preview .epkb-virtual-articles').remove();
		return new_sequence;
	}

	function epkb_get_new_article_page_sequence() {
		let new_sequence = '';

		// make virtual tree and sort articles when artiles on the top of the categories
		// For v1 
		if ($('.epkb-wizard-ordering-ordering-preview #el'+'ay-sidebar-layout-page-container').find('.el'+'ay-sidebar').length) {
			// Wsidebar template
			$('.epkb-wizard-ordering-ordering-preview #el'+'ay-sidebar-layout-page-container').append('<div class="epkb-virtual-articles" style="display:none!important;">' + $('.epkb-wizard-ordering-ordering-preview #el'+'ay-sidebar-layout-page-container').find('.el'+'ay-sidebar').html() + '</div>');

			$('.epkb-wizard-ordering-ordering-preview .epkb-virtual-articles').find('ul.el'+'ay-articles').each(function(){
				// check if we have articles on the top - move them to the bottom
				if ($(this).next().length && $(this).next().prop('tagName') == 'UL') {
					let wrap = $(this).parent();

					$(this).appendTo(wrap);
				}
			});
		}
		
		// for v2 
		if ($('.epkb-wizard-ordering-ordering-preview #elay-sidebar-container-v2').length) {
			// Wsidebar template
			
			$('.epkb-wizard-ordering-ordering-preview #elay-sidebar-container-v2').append('<div class="epkb-virtual-articles" style="display:none!important;">' + $('.epkb-wizard-ordering-ordering-preview #elay-sidebar-container-v2').html() + '</div>');

			$('.epkb-wizard-ordering-ordering-preview .epkb-virtual-articles').find('ul.el'+'ay-articles').each(function(){
				
				// check if we have articles on the top - move them to the bottom
				if ($(this).next().length && $(this).next().prop('tagName') == 'UL') {
					let wrap = $(this).parent();

					$(this).appendTo(wrap);
				}
			});
		}

		$('.epkb-wizard-ordering-ordering-preview .epkb-virtual-articles').find('[data-kb-type]').each(function(i, obj) {

			// some layouts like Tabs Layout has top categories and sub-categories "disconnected". Connect them here
			let top_cat_id = $(this).data('kb-top-category-id') ? $(this).data('kb-top-category-id') : '';
			if ( top_cat_id ) {
				new_sequence += 'xx' + top_cat_id + 'x' + 'category';
			}

			let category_id = typeof $(this).data('kb-category-id') === 'undefined' ? $(this).data('kb-article-id') : $(this).data('kb-category-id');
			if ( typeof category_id !== 'undefined' ) {
				new_sequence += 'xx' + category_id + 'x' + $(this).attr("data-kb-type");
			}
		});

		$('.epkb-wizard-ordering-ordering-preview .epkb-virtual-articles').remove();
		console.log(new_sequence);
		return new_sequence;
	}

	function epkb_get_top_category_seq() {

		let top_cat_sequence = '';
		let kb_config = JSON.parse( $('#eckb_current_theme_values').val() );
		let use_top_sequence = kb_config.kb_main_page_layout === 'Tabs';

		if ( ! use_top_sequence || typeof $('.epkb-wizard-ordering-ordering-preview .epkb-top-categories-list') === 'undefined' ) {
			return top_cat_sequence;
		}

		$('.epkb-wizard-ordering-ordering-preview .epkb-top-categories-list').children().each(function(i, obj) {
			let top_cat_id = $(this).find('[data-kb-category-id]').data('kb-category-id');
			if ( top_cat_id ) {
				top_cat_sequence += 'xx' + top_cat_id;
			}
		});

		return top_cat_sequence;
	}
	
	/********************************************************************
	 *
	 *                      GLOBAL WIZARD
	 *
	 ********************************************************************/

	let wizard_global = $( '.eckb-wizard-global-page' );
	
	/** Initial Settings */
	
	if ( wizard_global.length ) {
		// Open panel with the settings because we have only 1 accordion item 
		wizard_global.find( '#epkb-wsb-step-1-panel .eckb-wizard-option-heading' ).trigger( 'click' );
		$( '.notice-epkb_changed_slug' ).remove();
		
		if ( $( '.notice-epkb-no-main-pages' ).length ) {
			$( '.notice-epkb-no-main-pages' ).appendTo( $( '#epkb-wsb-step-1-panel' ) );
			$( '.notice-epkb-no-main-pages' ).find( '.epkb-notice-dismiss' ).remove();
		}
	}
	
	if ( wizard_global.find( '.eckb_slug' ).length ) {
		let eckb_slug_checked = false;
		let current_path = wizard_global.find( '#kb_articles_common_path' ).val();

		wizard_global.find( '.eckb_slug' ).each( function() {
			if ( $( this ).data( 'path' ) == current_path ) {
				$( this ).prop( 'checked', 'checked' );
				eckb_slug_checked = true;
			}
		});

		if ( ! eckb_slug_checked ) {
			wizard_global.find( '.eckb_slug' ).eq( 0 ).prop( 'checked', 'checked' );
			$( '#kb_articles_common_path' ).val( wizard_global.find( '.eckb_slug' ).eq( 0 ).data( 'path' ) );
		}

		wizard_global.find( '.eckb_slug' ).on( 'change', function() {
			$( '#kb_articles_common_path' ).val( $( this ).data( 'path' ) );
			wizard_global.data( 'kb-main-page-id', $( this ).data( 'kb-main-page-id' ) );
		});
	}

	$( document.body ).on( 'click', '#categories_in_url_enabled__toggle input', function (){
		if ( $( this ).is( ':checked' ) ) {
			wizard_global.find( '#categories_in_url_enabled' ).val( 'on' );
			wizard_global.find( '.epkb-wso-with-category__category' ).removeClass( 'epkb-wso-with-category__category--off' );
		} else {
			wizard_global.find( '#categories_in_url_enabled' ).val( 'off' );
			wizard_global.find( '.epkb-wso-with-category__category' ).addClass( 'epkb-wso-with-category__category--off' );
		}
	});
	
	/** ***********************************************************************************************
	 *
	 *          AJAX calls
	 *
	 * **********************************************************************************************/


	// generic AJAX call handler
	function epkb_send_ajax( current_wizard, postData, refreshCallback, reload, loaderMessage, silent_mode = false ) {

		let errorMsg;
		let theResponse;
		refreshCallback = (typeof refreshCallback === 'undefined') ? 'epkb_callback_noop' : refreshCallback;

		$.ajax({
			type: 'POST',
			dataType: 'json',
			data: postData,
			url: ajaxurl,
			beforeSend: function (xhr)
			{
				if ( ! silent_mode ) {
					epkb_loading_Dialog( 'show', loaderMessage );
				}
			}
		}).done(function (response)        {
			theResponse = ( response ? response : '' );
			if ( theResponse.error || typeof theResponse.message === 'undefined' ) {
				//noinspection JSUnresolvedVariable,JSUnusedAssignment
				errorMsg = theResponse.message ? theResponse.message : epkb_admin_notification('', epkb_vars.reload_try_again, 'error');
			}

		}).fail( function ( response, textStatus, error )        {
			//noinspection JSUnresolvedVariable
			errorMsg = ( error ? ' [' + error + ']' : epkb_vars.unknown_error );
			//noinspection JSUnresolvedVariable
			errorMsg = epkb_admin_notification(epkb_vars.error_occurred + '. ' + epkb_vars.msg_try_again, errorMsg, 'error');
		}).always(function ()        {
			if ( ! silent_mode ) {

				epkb_loading_Dialog( 'remove', '' );

			}

			if ( errorMsg ) {
				current_wizard.find( '.eckb-bottom-notice-message' ).replaceWith( errorMsg );
				$("html, body").animate({scrollTop: 0}, "slow");

			} else {
				if ( ! silent_mode ) {
					if ( ! theResponse.error && typeof theResponse.message !== 'undefined' ) {

						current_wizard.find( '.eckb-bottom-notice-message' ).replaceWith(
							epkb_admin_notification('', theResponse.message, 'success')
						);
					}
				}
				
				if ( typeof refreshCallback === "function" ) {
					theResponse = (typeof theResponse === 'undefined') ? '' : theResponse;
					refreshCallback(theResponse);
				} else {
					if ( reload ) {
						location.reload();
					}
				}
			}
		});
	}
	
	/** Text Wizard: Highlight text changed element */
	
	function epkb_hightlight_changed_element( $el ) {
		if ( typeof $el.data('old_transition') == 'undefined' ) {
			$el.data('old_transition', $el.css('transition'));
			$el.data('old_shadow', $el.css('transition'));
		}
		
		$el.data('hightlight_coming', 'yes');
		
		$el.css({
			'transition' : '0.2s',
			'box-shadow' : 'inset 0 0 0px 0px #1bff1b'
		});
		
		$el.css({
			'box-shadow' : 'inset 0 0 20px 0px #1bff1b'
		});
		
		setTimeout( function() {
			$el.css({
				'box-shadow' : 'inset 0 0 0px 0px #1bff1b'
			});
			
			$el.data('hightlight_coming', 'no');
		}, 1000);
		
		setTimeout( function() {
			if ($el.data('hightlight_coming') == 'no') {
				$el.css({
					'transition' : $el.data('old_transition'),
					'box-shadow' : $el.data('old_shadow')
				});
			}
		}, 2000);
	}
	
	/** AJAX Update of the current preview */
	// Only for features and search wizards
	// TODO in future: update for all wizards 
	
	function update_current_preview( screen = '', silent = false ) {

		// detect the wizard 
		let wizard_type = wizard.find( '.epkb-wizard-button-apply' ).data( 'wizard-type' );
		let kb_config = {}; 
		let wizard_screen = 'main_page';
		let postData = {
			wizard_type: wizard_type,
			action: 'epkb_update_wizard_preview',
			_wpnonce_apply_wizard_changes: $('#_wpnonce_apply_wizard_changes').val(),
			epkb_wizard_kb_id: $('#epkb_wizard_kb_id').val(),
		};
		
		let prev_state = false;
		
		// detect the screen
		if ( wizard.find('.epkb-wc-step-panel--active').find('.epkb-wizard-features-article-page-preview, .epkb-wizard-search-article-page-preview').length ) {
			wizard_screen = 'article_page';
		}
		
		if ( wizard.find('.epkb-wc-step-panel--active').find('.epkb-wizard-features-archive-page-preview, .epkb-wizard-search-archive-page-preview').length ) {
			wizard_screen = 'archive_page';
		}
		
		if ( screen ) {
			wizard_screen = screen;
		}
		
		// take parameters 
		if ( wizard_type == 'features' || wizard_type == 'search' ) {
			// Get Tab ID Value and Template ID
			kb_config = JSON.parse( $('#eckb_current_theme_values').val() );

			$('.eckb-wizard-single-text input').each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});
			
			$('.eckb-multiple-number-group input').each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});
			
			$('.eckb-wizard-single-checkbox input').each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					
					if ($(this).prop('checked')) {
						kb_config[$(this).attr('name')] = 'on';
					} else {
						kb_config[$(this).attr('name')] = 'off';
					}
					
				}
			});
			
			$('.config-input-group select').each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});
			
			$('.eckb-wizard-single-radio input[type=radio]:checked, .radio-buttons-vertical  input[type=radio]:checked, .radio-buttons-horizontal input[type=radio]:checked').each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});
			
			$('.text-select-fields-horizontal input').each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined') {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});

			$('.radio-buttons-horizontal input').each(function(){
				if (kb_config[$(this).attr('name')] !== 'undefined' && $(this).prop('checked') ) {
					kb_config[$(this).attr('name')] = $(this).val();
				}
			});
			
			$('.epkb_toc_position select, .epkb_kb_sidebar_position select, .epkb_elay_sidebar_position select, .epkb_categories_position select').each(function(){
				kb_config['article_sidebar_component_priority'][$(this).prop('id')] = $(this).val();
			});
			
			let left_sidebar = $('#epkb-wsb-step-2-panel #eckb-article-left-sidebar');
			let right_sidebar = $('#epkb-wsb-step-2-panel #eckb-article-right-sidebar');
			
			if ( left_sidebar.length > 0 && right_sidebar.length > 0 ) {
				if ( left_sidebar.html() && !right_sidebar.html() ) {
					prev_state = 1;
				}
				
				if ( left_sidebar.html() && right_sidebar.html() ) {
					prev_state = 2;
				}
				
				if ( !left_sidebar.html() && right_sidebar.html() ) {
					prev_state = 3;
				}
				
				if ( !left_sidebar.html() && !right_sidebar.html() ) {
					prev_state = 4;
				}
			}
			
		} else {
			return;
		}

		postData.kb_config = kb_config;
		postData.wizard_screen = wizard_screen;
		// request 
		epkb_send_ajax ( wizard, postData, function( response ) {
			if ( wizard_type == 'features' ) {
				if ( wizard_screen == 'main_page' ) {
					$('.epkb-wizard-features-main-page-preview').animate({'opacity' : 0}, 200);
					
					setTimeout(function(){
						$('.epkb-wizard-features-main-page-preview').html( '<div class="eckb-wizard-help__image"></div>' + response.html );
						$('.epkb-wizard-features-main-page-preview').animate({'opacity' : 1}, 200);
						activate_TOC();
					}, 200);
				} else if ( wizard_screen == 'article_page' ) {
					$('.epkb-wizard-features-article-page-preview').animate({'opacity' : 0}, 200);
					
					setTimeout(function(){
						$('.epkb-wizard-features-article-page-preview').html( '<div class="eckb-wizard-help__image"></div>' + response.html );
						activate_TOC();
						$('.epkb-wizard-features-article-page-preview').animate({'opacity' : 1}, 200);
						epkb_control_article_columns_width_inputs( prev_state );
					}, 200);
				} else {
					$('.epkb-wizard-features-archive-page-preview').animate({'opacity' : 0}, 200);
					
					// TODO remove when we will add noral prevview for archive page. need to wait when the user will download new image 
					$('.epkb-wizard-features-archive-page-preview').css({ 
						'min-height' : $('.epkb-wizard-features-archive-page-preview').height() + 'px'
					});
					
					setTimeout(function(){
						$('.epkb-wizard-features-archive-page-preview').css({ 
							'min-height' : 'auto'
						});
					}, 2000);
					// end TODO remove
						
					setTimeout(function(){
						$('.epkb-wizard-features-archive-page-preview').html( '<div class="eckb-wizard-help__image"></div>' + response.html );
						$('.epkb-wizard-features-archive-page-preview').animate({'opacity' : 1}, 200);
					}, 200);
				}
			}
			
			if ( wizard_type == 'search' ) {
				if ( wizard_screen == 'main_page' ) {
					$('.epkb-wizard-search-main-page-preview').animate({'opacity' : 0}, 200);
					
					setTimeout(function(){
						$('.epkb-wizard-search-main-page-preview').html( '<div class="eckb-wizard-help__image"></div>' + response.html );
						$('.epkb-wizard-search-main-page-preview').animate({'opacity' : 1}, 200);
					}, 200);
				} else if ( wizard_screen == 'article_page' ) {
					$('.epkb-wizard-search-article-page-preview').animate({'opacity' : 0}, 200);
					
					setTimeout(function(){
						$('.epkb-wizard-search-article-page-preview').html( '<div class="eckb-wizard-help__image"></div>' + response.html );
						activate_TOC();
						$('.epkb-wizard-search-article-page-preview').animate({'opacity' : 1}, 400);
					}, 400);
				} else {
					$('.epkb-wizard-search-archive-page-preview').animate({'opacity' : 0}, 200);
					
					setTimeout(function(){
						$('.epkb-wizard-search-archive-page-preview').html( '<div class="eckb-wizard-help__image"></div>' + response.html );
						$('.epkb-wizard-search-archive-page-preview').animate({'opacity' : 1}, 200);
					}, 200);
				}
			}
			
			epkb_toggle_options_groups( $('#eckb_current_theme_values').val() );
			
			setTimeout(epkb_fix_collapsed_button, 210);
			
		}, false, epkb_vars.load_template, silent);
	}

	/** Update page preview if needs */
	$('body').on('change', '.config-input-group input, .config-input-group select', function(){
		if ( typeof $(this).data('preview') == 'undefined' ) {
			return;
		}
		
		update_current_preview();
	});

	/* Dialogs --------------------------------------------------------------------*/

	/**
	  * Displays a Center Dialog box with a loading icon and text.
	  *
	  * This should only be used for indicating users that loading or saving or processing is in progress, nothing else.
	  * This code is used in these files, any changes here must be done to the following files.
	  *   - admin-plugin-pages.js
	  *   - admin-kb-config-scripts.js
	  *   - admin-kb-wizard-script.js
	  *
	  * @param  {string}    displayType     Show or hide Dialog initially. ( show, remove )
	  * @param  {string}    message         Optional    Message output from database or settings.
	  *
	  * @return {html}                      Removes old dialogs and adds the HTML to the end body tag with optional message.
	  *
	  */
	function epkb_loading_Dialog( displayType, message ){

		if( displayType === 'show' ){

			let output =
				'<div class="epkb-admin-dialog-box-loading">' +

				//<-- Header -->
				'<div class="epkb-admin-dbl__header">' +
				'<div class="epkb-admin-dbl-icon epkbfa epkbfa-hourglass-half"></div>'+
				(message ? '<div class="epkb-admin-text">' + message + '</div>' : '' ) +
				'</div>'+

				'</div>' +
				'<div class="epkb-admin-dialog-box-overlay"></div>';

			//Add message output at the end of Body Tag
			$( 'body' ).append( output );
		}else if( displayType === 'remove' ){

			// Remove loading dialogs.
			$( '.epkb-admin-dialog-box-loading' ).remove();
			$( '.epkb-admin-dialog-box-overlay' ).remove();
		}

	}

	/** Disable submit forms inside preview  */
	$('.eprf-leave-feedback-form').on( 'submit', false);
	
	/** Hide Demo Article Categories message */
	
	$(document).on('click', '.epkb-daca__button button', function(){
		$(this).closest('.epkb-daca').slideUp();
		
		let postData = {
			action: 'epkb_hide_demo_content_alert',
			_wpnonce_apply_wizard_changes: $('#_wpnonce_apply_wizard_changes').val(),
		};
		
		epkb_send_ajax ( wizard, postData, false, false, '', true);
	});
	
	
	/*************************************************************************************************
	 *
	 * Special Scenarios for some wizard Inputs
	 *
	 *************************************************************************************************/
	 
	// Features Wizard
	let image_icons = $('.epkb-cat-icon.epkb-cat-icon--image').length ? true : false;
	$('.eckb-wizard-features-content #section_head_category_icon_location').on('change', function(){
		
		
		if ($(this).val() == 'top' && !image_icons) {
			$('.eckb-wizard-features-content #section_head_category_icon_size').val('40');
		}
		
		if ($(this).val() == 'left' && !image_icons) {
			$('.eckb-wizard-features-content #section_head_category_icon_size').val('40');
		}
		
		if ($(this).val() == 'right' && !image_icons) {
			$('.eckb-wizard-features-content #section_head_category_icon_size').val('40');
		}
		
		if ($(this).val() == 'top' && image_icons) {
			$('.eckb-wizard-features-content #section_head_category_icon_size').val('150');
		}
		
		if ($(this).val() == 'left' && image_icons) {
			$('.eckb-wizard-features-content #section_head_category_icon_size').val('150');
		}
		
		if ($(this).val() == 'right' && image_icons) {
			$('.eckb-wizard-features-content #section_head_category_icon_size').val('150');
		}

	});
	
	$('input[name=categories_in_url_enabled]').on( 'change', function(){
		if ( $('input[name=categories_in_url_enabled]:checked').val() == 'on' ) {
			$('.epkb-category-slug-name').removeClass('epkb-half-visible');
		} else {
			$('.epkb-category-slug-name').addClass('epkb-half-visible');
		}
	});
	
	$('.epkb_toc_position select, .epkb_kb_sidebar_position select, .epkb_elay_sidebar_position select, .epkb_categories_position select').on( 'change', function(){
		
		if ( $(this).val() === '0' ) {
			return;
		}
		
		let id = $(this).prop('id');
		let thisSelector = '';
		
		if ( $(this).parent().hasClass('epkb_toc_position') ) {
			thisSelector = '.epkb_toc_position select';
		}
		
		if ( $(this).parent().hasClass('epkb_kb_sidebar_position') ) {
			thisSelector = '.epkb_kb_sidebar_position select';
		}
		
		if ( $(this).parent().hasClass('epkb_elay_sidebar_position') ) {
			thisSelector = '.epkb_elay_sidebar_position select';
		}
		
		if ( $(this).parent().hasClass('epkb_categories_position') ) {
			thisSelector = '.epkb_categories_position select';
		}
		
		$(thisSelector).each(function(){
			if ( $(this).prop('id') !== id ) {
				$(this).val('0');
			}
		});
		
		epkb_sync_features_layout_to_page_toc_positions();
	});
	
	
	function epkb_sync_features_layout_to_page_toc_positions() {
		if ( $('#toc_left').val() !== '0' ) {
			$('#article_toc_position0').prop('checked', 'checked');
		}
		
		if ( $('#toc_right').val() !== '0' ) {
			$('#article_toc_position1').prop('checked', 'checked');
		}
		
		if ( $('#toc_content').val() !== '0' ) {
			$('#article_toc_position2').prop('checked', 'checked');
		}
	}
	
	function epkb_sync_features_page_to_layout_toc_positions() {
		let position = $('input[name=article_toc_position]:checked').val();
		
		if ( ! position ) {
			return;
		}
		
		if ( position == 'left' ) {
			if ( $('#toc_right').val() !== '0' ) {
				$('#toc_left').val( $('#toc_right').val() );
				$('#toc_right').val('0');
			}
			
			if ( $('#toc_content').val() !== '0' ) {
				$('#toc_left').val( $('#toc_content').val() );
				$('#toc_content').val('0');
			}
		}
		
		if ( position == 'right' ) {
			if ( $('#toc_left').val() !== '0' ) {
				$('#toc_right').val( $('#toc_left').val() );
				$('#toc_left').val('0');
			}
			
			if ( $('#toc_content').val() !== '0' ) {
				$('#toc_right').val( $('#toc_content').val() );
				$('#toc_content').val('0');
			}
		}
		
		if ( position == 'middle' ) {
			if ( $('#toc_left').val() !== '0' ) {
				$('#toc_content').val( $('#toc_left').val() );
				$('#toc_left').val('0');
			}
			
			if ( $('#toc_right').val() !== '0' ) {
				$('#toc_content').val( $('#toc_right').val() );
				$('#toc_right').val('0');
			}
		}
		
	}
	
	epkb_sync_features_page_to_layout_toc_positions();
	$('input[name=article_toc_position]').on( 'change', epkb_sync_features_page_to_layout_toc_positions);
	
	// control article columns settings on the features wizard
	function epkb_calc_article_columns_width( reload = false ) {
		let sum = 0;
		let block = false;
		
		$('.eckb-wizard-option-heading h4').removeClass('epkb-wizard-header-alert-icon');
		
		$('.eckb-wizard-article-width-input-desktop input').each(function(){
			
			if ( $(this).prop('disabled') ) {
				return; // continue next step 
			}
			
			let val = parseFloat( $(this).val() );
			
			if ( isNaN(val) ) {
				val = 0;
			}
			
			$(this).val( val );
			
			sum += val;
		});

		if ( sum !== 100 ) {
			$('.eckb-wizard-article-width-input-desktop input').each(function(){
				if ( $(this).prop('disabled') ) {
					$(this).closest('.eckb-wizard-accordion__body-content').find('.eckb-wizard-article-width-input-alert-desktop').removeClass('wrong');
				} else {
					$(this).closest('.eckb-wizard-accordion__body-content').find('.eckb-wizard-article-width-input-alert-desktop').addClass('wrong');
					$(this).closest('.eckb-wizard-accordion__body-content').find('.eckb-wizard-article-width-input-alert-desktop .epkb-wizard-article-width-alert-num').text(sum);
					$(this).closest('.eckb-wizard-accordion__body-content').find('.eckb-wizard-option-heading h4').addClass('epkb-wizard-header-alert-icon');
				}
			});
			
			block = true;
			
		} else {
			$('.eckb-wizard-article-width-input-alert-desktop').removeClass('wrong');
		}
		
		sum = 0;
		
		$('.eckb-wizard-article-width-input-tablet input').each(function(){
			
			if ( $(this).prop('disabled') ) {
				return; // continue next step 
			}
			
			let val = parseFloat( $(this).val() );
			
			if ( isNaN(val) ) {
				val = 0;
			}
	
			$(this).val( val );
			sum += val;
		});

		if ( sum !== 100 ) {
			$('.eckb-wizard-article-width-input-tablet input').each(function(){
				if ( $(this).prop('disabled') ) {
					$(this).closest('.eckb-wizard-accordion__body-content').find('.eckb-wizard-article-width-input-alert-tablet').removeClass('wrong');
				} else { 
					$(this).closest('.eckb-wizard-accordion__body-content').find('.eckb-wizard-article-width-input-alert-tablet').addClass('wrong');
					$(this).closest('.eckb-wizard-accordion__body-content').find('.eckb-wizard-article-width-input-alert-tablet .epkb-wizard-article-width-alert-num').text(sum);
					$(this).closest('.eckb-wizard-accordion__body-content').find('.eckb-wizard-option-heading h4').addClass('epkb-wizard-header-alert-icon');
				}
			});
			
			block = true;
			
		} else {
			$('.eckb-wizard-article-width-input-alert-tablet').removeClass('wrong');
		}
		
		epkb_features_show_buttons_errors();

		if ( reload === true ) {
			update_current_preview();
		}
	}
	
	$('.eckb-wizard-article-width-input-desktop input, .eckb-wizard-article-width-input-tablet input').on('change keyup paste', epkb_calc_article_columns_width);

	// block/ubblock changing of the sidebar width if sidebar is empty 
	function epkb_control_article_columns_width_inputs( prev_state ) {
		
		let left_sidebar = $('#epkb-wsb-step-2-panel #eckb-article-left-sidebar');
		let right_sidebar = $('#epkb-wsb-step-2-panel #eckb-article-right-sidebar');
		
		if ( left_sidebar.length < 1 || right_sidebar.length < 1 ) {
			return;
		}
		
		if ( left_sidebar.html() ) {
			// left sidebar active 
			$('#article-left-sidebar-tablet-width-v2, #article-left-sidebar-desktop-width-v2').prop('disabled', false);
			$('.eckb-wizard-article-blocked-lsidebar').removeClass('active');
		} else {
			// left sidebar non-active 
			$('#article-left-sidebar-tablet-width-v2, #article-left-sidebar-desktop-width-v2').prop('disabled', 'disabled');
			$('.eckb-wizard-article-blocked-lsidebar').addClass('active');
		}
		
		if ( right_sidebar.html() ) {
			// right sidebar active 
			$('#article-right-sidebar-tablet-width-v2, #article-right-sidebar-desktop-width-v2').prop('disabled', false);
			$('.eckb-wizard-article-blocked-rsidebar').removeClass('active');
		} else {
			// right sidebar non-active 
			$('#article-right-sidebar-tablet-width-v2, #article-right-sidebar-desktop-width-v2').prop('disabled', 'disabled');
			$('.eckb-wizard-article-blocked-rsidebar').addClass('active');
		}
		
		let need_reload = false;

		// change widths 
		if ( left_sidebar.html() && !right_sidebar.html() && prev_state ) {
			if ( prev_state !== 1 ) {
				$('#article-left-sidebar-desktop-width-v2, #article-left-sidebar-tablet-width-v2').val('20');
				$('#article-content-desktop-width-v2, #article-content-tablet-width-v2').val('80');
				need_reload = true;
			}
		}
		
		if ( left_sidebar.html() && right_sidebar.html() && prev_state ) {
			if ( prev_state !== 2 ) {
				$('#article-left-sidebar-desktop-width-v2, #article-left-sidebar-tablet-width-v2').val('20');
				$('#article-content-desktop-width-v2, #article-content-tablet-width-v2').val('60');
				$('#article-right-sidebar-desktop-width-v2, #article-right-sidebar-tablet-width-v2').val('20');
				need_reload = true;
			}
		}
		
		if ( !left_sidebar.html() && right_sidebar.html() && prev_state ) {
			if ( prev_state !== 3 ) {
				$('#article-content-desktop-width-v2, #article-content-tablet-width-v2').val('80');
				$('#article-right-sidebar-desktop-width-v2, #article-right-sidebar-tablet-width-v2').val('20');
				need_reload = true;
			}
		}
		
		if ( !left_sidebar.html() && !right_sidebar.html() && prev_state ) {
			if ( prev_state !== 4 ) {
				$('#article-content-desktop-width-v2, #article-content-tablet-width-v2').val('100');
				need_reload = true;
			}
		}
		
		epkb_calc_article_columns_width( need_reload );
	}
	
	epkb_control_article_columns_width_inputs();
	
	// Click on the blocked left/right sidebars messages 
	$('.eckb-wizard-article-blocked-rsidebar').on('click',function(){
		$('.eckb-wizard-features-right-sidebar-content h4').trigger('click');
	});
	
	$('.eckb-wizard-article-blocked-lsidebar').on('click',function(){
		$('.eckb-wizard-features-left-sidebar-content h4').trigger('click');
	});
	
	$('#article-container-desktop-width-units-v2').on( 'change', function(){
		if ( $(this).val() == '%' ) {
			$('#article-container-desktop-width-v2').val('100');
		} else {
			$('#article-container-desktop-width-v2').val('1140');
		}
	});
	
	$('#article-container-tablet-width-units-v2').on( 'change', function(){
		if ( $(this).val() == '%' ) {
			$('#article-container-tablet-width-v2').val('100');
		} else {
			$('#article-container-tablet-width-v2').val('1025');
		}
	});

	$('#article-body-desktop-width-units-v2').on( 'change', function(){
		if ( $(this).val() == '%' ) {
			$('#article-body-desktop-width-v2').val('100');
		} else {
			$('#article-body-desktop-width-v2').val('1140');
		}
	});
	
	$('#article-body-tablet-width-units-v2').on( 'change', function(){
		if ( $(this).val() == '%' ) {
			$('#article-body-tablet-width-v2').val('100');
		} else {
			$('#article-body-tablet-width-v2').val('1025');
		}	
	});
	
	let eckb_input_watchdog = false;
	let eckb_input_values = {};
	let eckb_input_watchdog_timer;
	
	// this function set state to true and start count from 0, use on keyup 
	function eckp_start_typing_watchdog() {
		eckb_input_watchdog = true;
		clearTimeout(eckb_input_watchdog_timer);
		eckb_input_watchdog_timer = setTimeout(function(){
			eckb_input_watchdog = false;
		}, 2000);
	}
	
	// this function will check did we want to set some value to input, use instead if $(el).val()
	function eckp_set_input_values( new_selector, new_value ) {
		if ( typeof new_selector !== 'undefined' && typeof new_value !== 'undefined' ) {
			eckb_input_values[new_selector] = new_value;
		}
		
		if ( eckb_input_watchdog ) {
			// check timer and add it again 
			setTimeout(eckp_set_input_values, 500); 
		} else {
			// user are not typing, apply changes 
			for ( selector in eckb_input_values ) {
				if ( $(selector).length ) {
					$(selector).val(eckb_input_values[selector]);
					delete eckb_input_values[selector];
				}
			}
		}
	} 
	
	// max-min width for Article page and Article body widths
	$('#article-container-desktop-width-v2').on('keyup paste', function(){
		let current = parseFloat($(this).val());
		if ( isNaN(current) ) {
			current = 0;
		}
		let max = 100;
		let min = 1;
		eckp_start_typing_watchdog();
		
		if ( $('#article-container-desktop-width-units-v2').val() == 'px' ) {
			max = 3000;
			min = 10;
		}
		
		if ( current > max ) {
			current = max;
		}
		
		if ( current < min ) {
			current = min;
		}
		
		eckp_set_input_values( '#article-container-desktop-width-v2', current );
	});
	
	$('#article-container-tablet-width-v2').on('keyup paste', function(){
		let current = parseFloat($(this).val());
		if ( isNaN(current) ) {
			current = 0;
		}
		let max = 100;
		let min = 1;
		eckp_start_typing_watchdog();
		
		if ( $('#article-container-tablet-width-units-v2').val() == 'px' ) {
			max = 1100;
			min = 10;
		}
		
		if ( current > max ) {
			current = max;
		}
		
		if ( current < min ) {
			current = min;
		}
		
		eckp_set_input_values( '#article-container-tablet-width-v2', current );
	});
	
	$('#article-body-desktop-width-v2').on('keyup paste', function(){
		let current = parseFloat($(this).val());
		if ( isNaN(current) ) {
			current = 0;
		}
		let max = 100;
		let min = 1;
		eckp_start_typing_watchdog();
		
		if ( $('#article-body-desktop-width-units-v2').val() == 'px' ) {
			max = 3000;
			min = 10;
		}
		
		if ( current > max ) {
			current = max;
		}
		
		if ( current < min ) {
			current = min;
		}

		eckp_set_input_values( '#article-body-desktop-width-v2', current );
	});
	
	$('#article-body-tablet-width-v2').on('keyup paste', function(){
		let current = parseFloat($(this).val());
		if ( isNaN(current) ) {
			current = 0;
		}
		let max = 100;
		let min = 1;
		eckp_start_typing_watchdog();
		
		if ( $('#article-body-tablet-width-units-v2').val() == 'px' ) {
			max = 1100;
			min = 10;
		}
		
		if ( current > max ) {
			current = max;
		}
		
		if ( current < min ) {
			current = min;
		}
		
		eckp_set_input_values( '#article-body-tablet-width-v2', current );
	});
	
	// Function that will copy error messages above the buttons 
	function epkb_features_show_buttons_errors() {
		let errors = '';
		$('.epkb-wizard-footer .wrong').remove();
		
		if ( $('.eckb-wizard-article-width-input-alert-desktop.wrong').length ) {
			errors += '<div class="eckb-wizard-article-width-input-alert-desktop wrong">'+$('.eckb-wizard-article-width-input-alert-desktop.wrong').eq(0).html()+'</div>';
		}
		
		if ( $('.eckb-wizard-article-width-input-alert-tablet.wrong').length ) {
			errors += '<div class="eckb-wizard-article-width-input-alert-tablet wrong">'+$('.eckb-wizard-article-width-input-alert-tablet.wrong').eq(0).html()+'</div>';
		}
		
		$('.epkb-wizard-footer').prepend(errors);
	}
	
	if ( $('#eckb_preselect').length ) {
		let input = $('#' + $('#eckb_preselect').val() );

		input.closest('.eckb-wizard-accordion__body-content').find('.eckb-wizard-option-heading').trigger('click');
		
		setTimeout(function(){
			input.closest('.config-input-group').css({'background-color' : '#7dba5d', 'color':'white'});
		}, 500);
		
		setTimeout(function(){
			$('html, body').animate({
				scrollTop: input.closest('.config-input-group').offset().top - 150
			}, 200);
		}, 200);
		
		setTimeout(function(){
			input.closest('.config-input-group').css({'background-color' : '#fff', 'color':'black'});
		}, 2000 );
	}
	
	function epkb_fix_collapsed_button() {
		setTimeout(function(){
			$('.epkb-search-box button').each(function(){
				let search_text = $( this ).text();
				$( this ).text( search_text );
			});
		}, 1);
	}


	/*********************************************************************************************
	 *********************************************************************************************
	 *
	 *                Color Picker
	 *
	 * ********************************************************************************************
	 ********************************************************************************************/
	var myOptions = {
		// a callback to fire whenever the color changes to a valid color
		done: function(event, ui){
		},
		change: function(event, ui) {
			// event = standard jQuery event, produced by whichever control was changed.
			// ui = standard jQuery UI object, with a color member containing a Color.js object

			// change the headline color
			$(event.target).trigger('color_changed');
		},
		// a callback to fire when the input is emptied or an invalid color
		clear: function( event, ui) {
			let input = $(event.target).closest('.input_container').find('.wp-picker-input-wrap label input[type=text]');

			if ( input.length < 1 ) {
				return;
			}

			if ( typeof input.data('default_color') == 'undefined' ) {
				return;
			}

			input.iris('color', input.data('default_color'));

		}
	};
	$( '.ekb-color-picker input' ).wpColorPicker(myOptions);


	//Fix WordPress 5.5 remove text string from color picker.
	$( '.ekb-color-picker').find( '.wp-color-result-text' ).text( '' );
	
	/** Remove loader, should be last function in this file */
	// We need timeout to skip all start accordion animations
	setTimeout(function(){
		epkb_fix_collapsed_button();
		$( '.epkb-admin-dialog-box-loading' ).remove();
		$( '.epkb-admin-dialog-box-overlay' ).remove();
	}, 500);


	/********************************************************************************************
	 *
	 *                CATEGORY SECTIONS
	 *
	 ********************************************************************************************/

	{
		/**
		 * 1. ICON TOGGLE for Sub Category - toggle between open icon and close icon
		 */
		$('#epkb-main-page-content, .epkb-wc-step-panel').on('click', '.epkb-section-body .epkb-category-level-2-3', function (){

			var plus_icons = ['ep_font_icon_plus', 'ep_font_icon_minus'];
			var plus_icons_box = ['ep_font_icon_plus_box', 'ep_font_icon_minus_box'];
			var arrow_icons1 = ['ep_font_icon_right_arrow', 'ep_font_icon_down_arrow'];
			var arrow_icons2 = ['ep_font_icon_arrow_carrot_right', 'ep_font_icon_arrow_carrot_down'];
			var arrow_icons3 = ['ep_font_icon_arrow_carrot_right_circle', 'ep_font_icon_arrow_carrot_down_circle'];
			var folder_icon = ['ep_font_icon_folder_add', 'ep_font_icon_folder_open'];

			var icon = $(this).find('i');
			function toggle_category_icons($array) {

				//If Parameter Icon exists
				if ( icon.hasClass( $array[0] ) ) {

					icon.removeClass( $array[0] );
					icon.addClass( $array[1] );

				} else if ( icon.hasClass( $array[1] )) {

					icon.removeClass( $array[1] );
					icon.addClass($array[0]);
				}
			}

			toggle_category_icons(plus_icons);
			toggle_category_icons(plus_icons_box);
			toggle_category_icons(arrow_icons1);
			toggle_category_icons(arrow_icons2);
			toggle_category_icons(arrow_icons3);
			toggle_category_icons(folder_icon);
		});

		/**
		 *  2. SHOW ITEMS in SUB-CATEGORY
		 */
		$('#epkb-main-page-content, .epkb-wc-step-panel').on('click', '.epkb-section-body .epkb-category-level-2-3', function () {
			$(this).parent().children('ul').toggleClass('active');
		});

		/**
		 * 3. SHOW ALL articles functionality
		 *
		 * When user clicks on the "Show all articles" it will toggle the "hide" class on all hidden articles
		 */
		$('#epkb-main-page-content').on('click', '.epkb-show-all-articles', function () {

			$(this).toggleClass('active');
			var parent = $(this).parent('ul');
			var article = parent.find('li');

			//If this has class "active" then change the text to Hide extra articles
			if ($(this).hasClass('active')) {

				//If Active
				$(this).find('.epkb-show-text').addClass('epkb-hide-elem');
				$(this).find('.epkb-hide-text').removeClass('epkb-hide-elem');

			} else {
				//If not Active
				$(this).find('.epkb-show-text').removeClass('epkb-hide-elem');
				$(this).find('.epkb-hide-text').addClass('epkb-hide-elem');
			}

			$(article).each(function () {

				//If has class "hide" remove it and replace it with class "Visible"
				if ($(this).hasClass('epkb-hide-elem')) {
					$(this).removeClass('epkb-hide-elem');
					$(this).addClass('visible');
				} else if ($(this).hasClass('visible')) {
					$(this).removeClass('visible');
					$(this).addClass('epkb-hide-elem');
				}
			});
		});
	}

	function clear_bottom_notifications() {
		var bottom_message = $('body').find('.eckb-bottom-notice-message');
		if ( bottom_message.length ) {
			bottom_message.addClass( 'fadeOutDown' ).html( '' );
		}
	}

	function clear_message_after_set_time(){

		var epkb_timeout;
		if( $('.eckb-bottom-notice-message' ).length > 0 ) {
			clearTimeout(epkb_timeout);

			//Add fadeout class to notice after set amount of time has passed.
			epkb_timeout = setTimeout(function () {
				clear_bottom_notifications();
			} , 10000);
		}
	}
});