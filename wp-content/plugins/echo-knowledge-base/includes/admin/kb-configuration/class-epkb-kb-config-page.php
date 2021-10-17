<?php  if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Display feature settings
 *
 * @copyright   Copyright (C) 2018, Echo Plugins
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class EPKB_KB_Config_Page {

	public $kb_config = array();
	/** @var  EPKB_KB_Config_Elements */
	public $form;
	public $feature_specs = array();
	public $kb_main_page_layout = EPKB_KB_Config_Layout_Basic::LAYOUT_NAME;
	public $kb_article_page_layout = EPKB_KB_Config_Layouts::KB_ARTICLE_PAGE_NO_LAYOUT;
	public $show_main_page = false;
	public $show_overview_page = true;
	public $show_wizard_page = false;

	public function __construct( $kb_config=array() ) {

		// ensure user has correct permissions
		if ( ! EPKB_Admin_UI_Access::is_user_access_to_context_allowed( 'admin_eckb_access_order_articles_write' ) ) {
			EPKB_Utilities::ajax_show_error_die( __( 'You do not have permission to edit this knowledge base', 'echo-knowledge-base' ) );
		}

		// retrieve current KB configuration
		$kb_config = empty($kb_config) ? epkb_get_instance()->kb_config_obj->get_current_kb_configuration() : $kb_config;
		if ( is_wp_error( $kb_config ) || empty($kb_config) || ! is_array($kb_config) || count($kb_config) < 100 ) {
			$kb_config = EPKB_KB_Config_Specs::get_default_kb_config( EPKB_KB_Config_DB::DEFAULT_KB_ID );
		}

		$this->kb_config              = $kb_config;
		$this->feature_specs          = EPKB_KB_Config_Specs::get_fields_specification( $this->kb_config['id'] );
		$this->form                   = new EPKB_KB_Config_Elements();
		$this->kb_main_page_layout    = EPKB_KB_Config_Layouts::get_kb_main_page_layout_name( $this->kb_config );
		$this->kb_article_page_layout = EPKB_KB_Config_Layouts::get_article_page_layout_name( $this->kb_config );
		$this->show_main_page         = isset($_REQUEST['epkb-demo']) || isset($_REQUEST['ekb-main-page']); // maybe deprecated
		
		if ( isset($_REQUEST['epkb-wizard-tab']) ) {
			$this->show_wizard_page = true;
			$this->show_overview_page = false;
		}
	}

	/**************************************************************************************
	 *
	 *                   MAIN PANEL
	 *
	 *************************************************************************************/

	/**
	 * Display the Main Page layout preview.
	 *
	 * @param bool $display
	 * @param array $articles_seq_data
	 * @param array $category_seq_data
	 * @return string
	 */
	public function display_kb_main_page_layout_preview( $display=true, $articles_seq_data=array(), $category_seq_data=array() ) {
		global $eckb_is_kb_main_page;

		// retrieve KB preview using Current KB or Demo KB
		if ( EPKB_Utilities::post( 'epkb-wizard-demo-data', false ) ) {
			$demo_data = EPKB_KB_Demo_Data::get_category_demo_data( $this->kb_main_page_layout, $this->kb_config );
			$category_seq_data = $demo_data['category_seq'];
			$articles_seq_data = $demo_data['article_seq'];
			$this->kb_config['wizard-icons'] = $demo_data['category_icons'];
		}

		$eckb_is_kb_main_page = true;   // pretend this is Main Page
		$main_page_output = EPKB_Layouts_Setup::output_main_page( $this->kb_config, true, $articles_seq_data, $category_seq_data );

		// setup test icons
		if ( $this->kb_main_page_layout == EPKB_KB_Config_Layouts::GRID_LAYOUT && EPKB_Utilities::post( 'epkb-wizard-demo-data', false ) ) {
			$count = 2;
			$main_page_output = preg_replace( '/ep_font_icon_document/', 'ep_font_icon_person', $main_page_output, $count );
			$main_page_output = preg_replace( '/ep_font_icon_document/', 'ep_font_icon_shopping_cart', $main_page_output, $count );
			$main_page_output = preg_replace( '/ep_font_icon_document/', 'ep_font_icon_money', $main_page_output, $count );
			$main_page_output = preg_replace( '/ep_font_icon_document/', 'ep_font_icon_tag', $main_page_output, $count );
			$main_page_output = preg_replace( '/ep_font_icon_document/', 'ep_font_icon_credit_card', $main_page_output, $count );
			$main_page_output = preg_replace( '/ep_font_icon_document/', 'ep_font_icon_building', $main_page_output, $count );
		}
		
		if ( $display ) {
			echo $main_page_output;
		}

		return $main_page_output;
	}

	/**
	 * Show Article Page preview
	 *
	 * @param bool $display
	 * @param array $articles_seq_data
	 * @param array $category_seq_data
	 * @return mixed|string
	 */
	public function display_article_page_layout_preview( $display=false, $articles_seq_data=array(), $category_seq_data=array() ) {
		global $eckb_is_kb_main_page;

		$eckb_is_kb_main_page = false;      // for preview set Article Page

		// setup either current KB or demo KB data
		if ( ( isset($_POST['epkb_demo_kb']) && $_POST['epkb_demo_kb'] == "true" ) || ! empty($_POST['epkb-wizard-demo-data']) ) {
			$demo_data = EPKB_KB_Demo_Data::get_category_demo_data( $this->kb_config['kb_article_page_layout'], $this->kb_config );
			$category_seq_data = $demo_data['category_seq'];
			$articles_seq_data = $demo_data['article_seq'];
        }

        $temp_config = $this->kb_config;

        $demo_article = new stdClass();
        $demo_article->ID = 0;
		$demo_article->post_title = __( 'Demo Article', 'echo-knowledge-base' );
		$demo_article->post_content = wp_kses_post( EPKB_KB_Demo_Data::get_demo_article() );
		$demo_article->post_date = current_time( 'mysql' );
		$demo_article->post_modified = current_time( 'mysql' );
		$demo_article->is_demo = true;
        $demo_article = new WP_Post( $demo_article );

		$temp_config[EPKB_Articles_Admin::KB_ARTICLES_SEQ_META] = $articles_seq_data;
		$temp_config[EPKB_Categories_Admin::KB_CATEGORIES_SEQ_META] = $category_seq_data;

		// for article structure V2 we need to pass to elay demo data this way
		if ( EPKB_Articles_Setup::is_article_structure_v2( $this->kb_config )  ) {
			$GLOBALS['epkb-articles-seq-data'] = $articles_seq_data;
			$GLOBALS['epkb-categories-seq-data'] = $category_seq_data;
		}

		$article_page_output = EPKB_Articles_Setup::get_article_content_and_features( $demo_article, $demo_article->post_content, $temp_config );
		
        if ( EPKB_KB_Config_Layouts::is_article_page_displaying_sidebar( $this->kb_config['kb_article_page_layout'] ) && ! EPKB_Articles_Setup::is_article_structure_v2( $this->kb_config ) ) {
			$article_page_output = EPKB_Articles_Setup::output_article_page_with_layout( $article_page_output, $temp_config, true, $articles_seq_data, $category_seq_data );
        }

        echo $display ? $article_page_output : '';

		return $article_page_output;
	}

	/**
	 * Only with Demo mode
	 * @param bool $display
	 * @return string|void
	 */
	public function display_archive_page_layout_preview ( $display = false ){

		if ( empty($this->kb_config['template_category_archive_page_style']) ) {
			return;
		}

		// Just images for now 
		// TODO: add demo archive template to have live preview 
		
		$img_url = 'https://www.echoknowledgebase.com/wp-content/uploads/2021/02/';
		
		switch ( $this->kb_config['template_category_archive_page_style'] ) {
			case 'eckb-category-archive-style-1':
				$img_url .= 'wizard-archive-style-1.jpg';
				break;
			case 'eckb-category-archive-style-2':
				$img_url .= 'wizard-archive-style-2.jpg';
				break;
			case 'eckb-category-archive-style-3':
				$img_url .= 'wizard-archive-style-3.jpg';
				break;
			case 'eckb-category-archive-style-4':
				$img_url .= 'wizard-archive-style-4.jpg';
				break;
			case 'eckb-category-archive-style-5':
				$img_url .= 'wizard-archive-style-5.jpg';
				break;
		}
		
		$archive_page_output = '<img src="' . $img_url . '" class="epkb-wizard-text-archive-page-preview-image">';
		
		echo $display ? $archive_page_output : '';

		return $archive_page_output;
	}
}
