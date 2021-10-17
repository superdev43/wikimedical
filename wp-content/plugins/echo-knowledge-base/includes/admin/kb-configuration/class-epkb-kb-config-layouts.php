<?php  if ( ! defined( 'ABSPATH' ) ) exit;

class EPKB_KB_Config_Layouts {

	const KB_ARTICLE_PAGE_NO_LAYOUT = 'Article';
	const SIDEBAR_LAYOUT = 'Sidebar';
	const GRID_LAYOUT = 'Grid';
	const CATEGORIES_LAYOUT = 'Categories';

	/**
	 * Get all known layouts including add-ons
	 * @return array all defined layout names
	 */
	public static function get_main_page_layout_name_value() {
		$core_layouts = array (
			EPKB_KB_Config_Layout_Basic::LAYOUT_NAME => __( 'Basic', 'echo-knowledge-base' ),
			EPKB_KB_Config_Layout_Tabs::LAYOUT_NAME  => __( 'Tabs', 'echo-knowledge-base' ),
			EPKB_KB_Config_Layout_Categories::LAYOUT_NAME  => __( 'Category Focused', 'echo-knowledge-base' )
		);
		return apply_filters( 'epkb_layout_names', $core_layouts );
	}

	/**
	 * Get all known layouts including add-ons
	 * @return array all defined layout names
	 */
	public static function get_main_page_layout_names() {
		$layout_name_values = self::get_main_page_layout_name_value();
		return array_keys($layout_name_values);
	}

	/**
	 * Return current layout or default layout if not found.
	 *
	 * @param $kb_config
	 * @return string
	 */
	public static function get_kb_main_page_layout_name( $kb_config ) {
		$chosen_main_page_layout = EPKB_Utilities::post('epkb_chosen_main_page_layout');
		$layout = empty($kb_config['kb_main_page_layout']) || ! in_array($kb_config['kb_main_page_layout'], self::get_main_page_layout_names() )
						? EPKB_KB_Config_Layout_Basic::LAYOUT_NAME
						: (  empty($chosen_main_page_layout) ? $kb_config['kb_main_page_layout'] : $chosen_main_page_layout );
		return $layout;
	}

	/**
	 * Return current article page layout if any
	 *
	 * @param $kb_config
	 * @return string
	 */
	public static function get_article_page_layout_name( $kb_config ) {
		$layout = empty($kb_config['kb_article_page_layout']) || ! in_array($kb_config['kb_article_page_layout'], array_keys(self::get_article_page_layout_names()) )
						? EPKB_KB_Config_Layouts::KB_ARTICLE_PAGE_NO_LAYOUT : $kb_config['kb_article_page_layout'];
		return $layout;
	}

	/**
	 * Get Article Page layouts
	 * @return array all Page 2 layouts
	 */
	public static function get_article_page_layout_names() {
		$core_layouts = array (
			self::KB_ARTICLE_PAGE_NO_LAYOUT => 'Article'
		);
		return apply_filters( 'epkb_article_page_layout_names', $core_layouts );
	}

	/**
	 * Given Main Page layout, get possible Article Page layouts
	 *
	 * @param $main_page_layout
	 * @return array
	 */
	public static function get_article_page_layouts( $main_page_layout ) {
		$layout_mapping = self::get_layout_mapping();
		$found_article_page_layouts = array();
		$article_page_layouts = self::get_article_page_layout_names();
		unset($article_page_layouts[self::KB_ARTICLE_PAGE_NO_LAYOUT]);
		foreach( $layout_mapping as $index => $mapping ) {
			$article_layout = empty($mapping[$main_page_layout]) ? '' : $mapping[$main_page_layout];
			if ( ! empty($article_layout) ) {
				$found_article_page_layouts[ $article_layout ] = isset($article_page_layouts[$article_layout]) ? $article_page_layouts[$article_layout] : 'Article';
			}
		}

		return $found_article_page_layouts;
	}

	/**
	 * Mapping between Page 1 and Page 2
	 *
	 * @return array all defined layout mapping
	 */
	public static function get_layout_mapping() {
		$core_layouts = array (
			array( EPKB_KB_Config_Layout_Basic::LAYOUT_NAME => self::KB_ARTICLE_PAGE_NO_LAYOUT ),
			array( EPKB_KB_Config_Layout_Tabs::LAYOUT_NAME => self::KB_ARTICLE_PAGE_NO_LAYOUT ),
			array( EPKB_KB_Config_Layout_Categories::LAYOUT_NAME => self::KB_ARTICLE_PAGE_NO_LAYOUT )
		);
		return apply_filters( 'epkb_layout_mapping', $core_layouts );
	}

	/**
	 * Get all layouts that shows article on the KB Main Page
	 *
	 * @param $layout
	 * @return true if this Article Page layout displayes some kind of layout
	 */
	public static function is_article_page_displaying_sidebar( $layout ) {
		return  in_array( $layout, array(EPKB_KB_Config_Layouts::SIDEBAR_LAYOUT) );
	}

	public static function get_max_layout_level( $layout ) {
		if ( $layout === EPKB_KB_Config_Layout_Basic::LAYOUT_NAME ) {
			return EPKB_KB_Config_Layout_Basic::CATEGORY_LEVELS;
		}
		if ( $layout === EPKB_KB_Config_Layout_Tabs::LAYOUT_NAME ) {
			return EPKB_KB_Config_Layout_Tabs::CATEGORY_LEVELS;
		}
		if ( $layout === EPKB_KB_Config_Layout_Categories::LAYOUT_NAME ) {
			return EPKB_KB_Config_Layout_Categories::CATEGORY_LEVELS;
		}
		return $layout;
	}

}
