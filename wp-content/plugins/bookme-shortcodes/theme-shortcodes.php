<?php
/*
 * Plugin Name: Bookme Shortcodes
 * Plugin URI: http://puriwp.com
 * Description: Bookme Shortcodes is a free WordPress plugin for BookMe Theme Shortcodes.
 * Version: 1.0
 * Author: PuriWP
 * Author URI: http://puriwp.com
 * License: GPL2+
 */

define('BOOKME_SHORTCODE_DIR', trailingslashit(plugin_dir_url( __FILE__ )));

class Bookme_BoostrapShortcodes {

	protected static $shortcodes = array(
		  'alert',
		  'badge',
		  'button',
		  'button-toolbar',
		  'code',
		  'column',
		  'clearfix',
		  'divider',
		  'image',
		  'li',
		  'list',
//		  'list-group',
//		  'list-group-item',
//		  'list-group-item-heading',
//		  'list-group-item-text',
//		  'modal',
//		  'modal-footer',
//		  'nav',
//		  'nav-item',
//		  'page-header',
//		  'panel',
		  'row',
		  'slides',
		  'slide',
		  'tab',
//		  'table',
//		  'table-wrap',
		  'tabs',
		  'thumbnail',
		  'title',
		  'toggles',
		  'toggle',
//		  'well',
	);

	public function button_groups( $grps = array() ){
		$grps=array(
			'basic'			=> array( 'name'=>'Basic Elements', 'icon'=>'fa-cube' ),
			'columns'		=> array( 'name'=>'Columns', 'icon'=>'fa-clone' ),
			'interactive'	=> array( 'name'=>'Interactive', 'icon'=>'fa-random' ),
			'content'		=> array( 'name'=>'Content', 'icon'=>'fa-newspaper-o' ),
			'miscellaneous'	=> array( 'name'=>'Miscellaneous', 'icon'=>'fa-puzzle-piece' )
		);
		return $grps;
	}

	public function button_shortcodes( $shortcodes = array() ){
		$shortcodes = array(
			'alert' => array(
				'group'	=> 'basic',
				'name'	=> 'Notifications',
                'icon'  => 'fa-bell',
				'width'	=> 600,
				'height'=> ''
			),
			'badge' => array(
				'group'	=> 'basic',
				'name'	=> 'Badges',
                'icon'  => 'fa-tag',
				'width'	=> '',
				'height'=> ''
			),
			'button' => array(
				'group'	=> 'basic',
				'name'	=> 'Buttons',
                'icon'  => 'fa-square',
				'width'	=> 800,
				'height'=> ''
			),
			'button-toolbar' => array(
				'group'	=> 'basic',
				'name'	=> 'Button Group',
                'icon'  => 'fa-th-large',
				'width'	=> 800,
				'height'=> ''
			),
			'toggles' => array(
				'group'	=> 'interactive',
				'name'	=> 'Toggles',
                'icon'  => 'fa-th-list',
				'width'	=> 980,
				'height'=> ''
			),
			'tabs' => array(
				'group'	=> 'interactive',
				'name'	=> 'Tabs',
                'icon'  => 'fa-list-alt',
				'width'	=> 1170,
				'height'=> ''
			),
			'slides'=>array(
				'group'	=> 'interactive',
				'name'	=> 'Slider',
                'icon'  => 'fa-sliders',
				'width'	=> 900,
				'height'=> 450
			),
			'list' => array(
				'group'	=> 'content',
				'name'	=> 'List',
                'icon'  => 'fa-list-ol',
				'width'	=> 800,
				'height'=> ''
			),
			'title' => array(
				'group'	=> 'content',
				'name'	=> 'Title Heading',
                'icon'  => 'fa-header',
				'width'	=> 800,
				'height'=> ''
			),
			'thumbnail' => array(
				'group'	=> 'miscellaneous',
				'name'	=> 'Thumbnail Image',
                'icon'  => 'fa-picture-o',
				'width'	=> 800,
				'height'=> ''
			),
			'image' => array(
				'group'	=> 'miscellaneous',
				'name'	=> 'Responsive Image',
                'icon'  => 'fa-camera-retro',
				'width'	=> 800,
				'height'=> ''
			),
            'row' => array(
				'group'	=> 'columns',
				'name'	=> 'Row',
                'icon'  => 'fa-bars',
				'width'	=> '',
				'height'=> ''
			),
			'column' => array(
				'group'	=> 'columns',
				'name'	=> 'Columns',
                'icon'  => 'fa-columns',
				'width'	=> 900,
				'height'=> ''
			)
		);
	return $shortcodes;
	}

	function __construct() {
		add_action( 'admin_head', array( $this, 'bookme_var_buttons' ) );
		add_action( 'init', array( $this, 'add_shortcodes' ) );
	}

    /*
     * add_shortcodes
     */
    function add_shortcodes() {

        foreach ( self::$shortcodes as $shortcode ) {
            $function = 'bookme_bs_' . str_replace( '-', '_', $shortcode );
            add_shortcode( $shortcode, array( $this, $function ) );
        }
    }

	/*
     * Load global variables
     */
	function bookme_var_buttons() {
	?>
<script type="text/javascript">/* <![CDATA[ */
    var img_url='<?php echo BOOKME_SHORTCODE_DIR.'editor/';?>';
    var editor_opt='dropdown';
    var dropdown_obj='<?php echo json_encode($this->button_shortcodes()); ?>';
    var dropdown_grp='<?php echo json_encode($this->button_groups()); ?>';/* ]]> */
</script>
	<?php
	}

	/*
     * Bookme_bs_alert
     */
	function bookme_bs_alert( $atts, $content = null ) {

		$atts = shortcode_atts( array(
		"type"          => false,
		"dismissable"   => false,
		"xclass"        => false,
		"data"          => false
		), $atts );

		$class  = 'alert bookme';
		$class .= ( $atts['type'] )         ? ' alert-' . $atts['type'] : ' alert-success';
		$class .= ( $atts['dismissable']   == 'true' )  ? ' alert-dismissable' : '';
		$class .= ( $atts['xclass'] )       ? ' ' . $atts['xclass'] : '';

		$dismissable = ( $atts['dismissable'] ) ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>' : '';
		switch( $atts['type'] ){
			case 'success':
				$icon = '<span class="title">Success !</span>&nbsp;';
				break;
			case 'info':
				$icon = '<span class="title">Information !</span>&nbsp;';
				break;
			case 'warning':
				$icon = '<span class="title">Notification Block !</span>&nbsp;';
				break;
			case 'danger':
				$icon = '<span class="title">Warning !</span>&nbsp;';
				break;
			default:
				$icon = '<span class="title">Standard Block !</span>&nbsp;';
				break;
		}

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
		'<div class="%s" role="alert"%s>%s%s%s</div>',
		esc_attr( $class ),
		( $data_props )  ? ' ' . $data_props : '',
		$dismissable,
		$icon,
		do_shortcode( $content )
		);
	}

	/*
     * Bookme_bs_badge
     */
	function bookme_bs_badge( $atts, $content = null ) {

		$atts = shortcode_atts( array(
		"right"   => false,
		"xclass"  => false,
		"data"    => false
		), $atts );

		$class  = 'badge';
		$class .= ( $atts['right']   == 'true' )    ? ' pull-right' : '';
		$class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
		'<span class="%s"%s>%s</span>',
		esc_attr( $class ),
		( $data_props ) ? ' ' . $data_props : '',
		do_shortcode( $content )
		);
	}

	/*
     * Bookme_bs_button
     */
	function bookme_bs_button( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"type"     => false,
			"size"     => false,
			"block"    => false,
			"dropdown" => false,
			"link"     => '',
			"target"   => false,
			"disabled" => false,
			"active"   => false,
			"xclass"   => false,
			"title"    => false,
			"data"     => false
		), $atts );

		$class  = 'btn bookme';
		$class .= ( $atts['type'] )     ? ' btn-' . $atts['type'] : ' btn-default';
		$class .= ( $atts['size'] )     ? ' btn-' . $atts['size'] : '';
		$class .= ( $atts['block'] == 'true' )    ? ' btn-block' : '';
		$class .= ( $atts['dropdown']   == 'true' ) ? ' dropdown-toggle' : '';
		$class .= ( $atts['disabled']   == 'true' ) ? ' disabled' : '';
		$class .= ( $atts['active']     == 'true' )   ? ' active' : '';
		$class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<a class="%s" href="%s"%s%s%s>%s</a>',
			esc_attr( $class ),
			esc_url( $atts['link'] ),
			( $atts['target'] )     ? sprintf( ' target="%s"', esc_attr( $atts['target'] ) ) : '',
			( $atts['title'] )      ? sprintf( ' title="%s"',  esc_attr( $atts['title'] ) )  : '',
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);

	}

	/*
     * Bookme_bs_button_toolbar
     */
	function bookme_bs_button_toolbar( $atts, $content = null ) {

		$atts = shortcode_atts( array(
		  "xclass" => false,
		  "data"   => false
		), $atts );

		$class  = 'btn-toolbar';
		$class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
		  '<div class="%s"%s>%s</div>',
		  esc_attr( $class ),
		  ( $data_props ) ? ' ' . $data_props : '',
		  do_shortcode( $content )
		);
	}

    /*
     * Bookme_bs_code
     */
    function bookme_bs_code( $atts, $content = null ) {

        $atts = shortcode_atts( array(
            "inline"      => false,
            "scrollable"  => false,
            "xclass"      => false,
            "data"        => false
        ), $atts );

        $class  = 'bookme';
        $class .= ( $atts['scrollable']   == 'true' )  ? ' pre-scrollable' : '';
        $class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

        $data_props = $this->parse_data_attributes( $atts['data'] );

        return sprintf(
            '<%1$s class="%2$s"%3$s>%4$s</%1$s>',
            ( $atts['inline'] ) ? 'code' : 'pre',
            esc_attr( $class ),
            ( $data_props ) ? ' ' . $data_props : '',
            $this->strip_paragraph( $content )
        );
    }

    /*
     * Bookme_bs_row
     */
    function bookme_bs_row( $atts, $content = null ) {

        $atts = shortcode_atts( array(
          "xclass" => false,
          "data"   => false
        ), $atts );

        $class  = 'row bookme';
        $class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

        $data_props = $this->parse_data_attributes( $atts['data'] );

        return sprintf(
          '<div class="%s"%s>%s</div>',
          esc_attr( $class ),
          ( $data_props ) ? ' ' . $data_props : '',
          do_shortcode( $content )
        );
    }

    /*
     * Bookme_bs_column
     */
    function bookme_bs_column( $atts, $content = null ) {

        $atts = shortcode_atts( array(
          "lg"          => false,
          "md"          => false,
          "sm"          => false,
          "xs"          => false,
          "offset_lg"   => false,
          "offset_md"   => false,
          "offset_sm"   => false,
          "offset_xs"   => false,
          "pull_lg"     => false,
          "pull_md"     => false,
          "pull_sm"     => false,
          "pull_xs"     => false,
          "push_lg"     => false,
          "push_md"     => false,
          "push_sm"     => false,
          "push_xs"     => false,
          "hide_lg"     => false,
          "hide_md"     => false,
          "hide_sm"     => false,
          "hide_xs"     => false,
          "xclass"      => false,
          "data"        => false
        ), $atts );

        $class  = '';
        $class .= ( $atts['lg'] )			                                ? ' col-lg-' . $atts['lg'] : '';
        $class .= ( $atts['md'] )                                           ? ' col-md-' . $atts['md'] : '';
        $class .= ( $atts['sm'] )                                           ? ' col-sm-' . $atts['sm'] : '';
        $class .= ( $atts['xs'] )                                           ? ' col-xs-' . $atts['xs'] : '';
        $class .= ( $atts['offset_lg'] || $atts['offset_lg'] === "0" )      ? ' col-lg-offset-' . $atts['offset_lg'] : '';
        $class .= ( $atts['offset_md'] || $atts['offset_md'] === "0" )      ? ' col-md-offset-' . $atts['offset_md'] : '';
        $class .= ( $atts['offset_sm'] || $atts['offset_sm'] === "0" )      ? ' col-sm-offset-' . $atts['offset_sm'] : '';
        $class .= ( $atts['offset_xs'] || $atts['offset_xs'] === "0" )      ? ' col-xs-offset-' . $atts['offset_xs'] : '';
        $class .= ( $atts['pull_lg']   || $atts['pull_lg'] === "0" )        ? ' col-lg-pull-' . $atts['pull_lg'] : '';
        $class .= ( $atts['pull_md']   || $atts['pull_md'] === "0" )        ? ' col-md-pull-' . $atts['pull_md'] : '';
        $class .= ( $atts['pull_sm']   || $atts['pull_sm'] === "0" )        ? ' col-sm-pull-' . $atts['pull_sm'] : '';
        $class .= ( $atts['pull_xs']   || $atts['pull_xs'] === "0" )        ? ' col-xs-pull-' . $atts['pull_xs'] : '';
        $class .= ( $atts['push_lg']   || $atts['push_lg'] === "0" )        ? ' col-lg-push-' . $atts['push_lg'] : '';
        $class .= ( $atts['push_md']   || $atts['push_md'] === "0" )        ? ' col-md-push-' . $atts['push_md'] : '';
        $class .= ( $atts['push_sm']   || $atts['push_sm'] === "0" )        ? ' col-sm-push-' . $atts['push_sm'] : '';
        $class .= ( $atts['push_xs']   || $atts['push_xs'] === "0" )        ? ' col-xs-push-' . $atts['push_xs'] : '';
        $class .= ( $atts['hide_lg'] )			                            ? ' hidden-lg' : '';
        $class .= ( $atts['hide_md'] )                                      ? ' hidden-md' : '';
        $class .= ( $atts['hide_sm'] )                                      ? ' hidden-sm' : '';
        $class .= ( $atts['hide_xs'] )                                      ? ' hidden-xs' : '';
        $class .= ( $atts['xclass'] )                                       ? ' ' . $atts['xclass'] : '';

        $data_props = $this->parse_data_attributes( $atts['data'] );

        return sprintf(
          '<div class="%s"%s>%s</div>',
          esc_attr( $class ),
          ( $data_props ) ? ' ' . $data_props : '',
          do_shortcode( $content )
        );
    }

	/*
     * Bookme_bs_clearfix
     */
    function bookme_bs_clearfix( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data" 	 => false
		), $atts );

		$class  = 'clearfix bookme';
		$class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
		  '<div class="%s"%s>%s</div>',
		  esc_attr( $class ),
		  ( $data_props ) ? ' ' . $data_props : '',
		  do_shortcode( $content )
		);
	}

	/*
     * Bookme_bs_divider
     */
    function bookme_bs_divider( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data" 	 => false
		), $atts );

		$class  = 'divider bookme';
		$class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
		  '<li class="%s"%s>%s</li>',
		  esc_attr( $class ),
		  ( $data_props ) ? ' ' . $data_props : '',
		  do_shortcode( $content )
		);
	}

	/*
     * Bookme_bs_image
     */
    function bookme_bs_image( $atts, $content = null ) {

		$atts = shortcode_atts( array(
		  "type"       => false,
		  "src"        => false,
		  "responsive" => true,
		  "xclass"     => false,
		  "data"       => false
		), $atts );

		$class  = ( $atts['type'] )       ? 'img-' . $atts['type'] . ' ' : '';
		$class .= ( $atts['responsive']   == 'true' ) ? ' img-responsive' : '';
		$class .= ( $atts['xclass'] )     ? ' ' . $atts['xclass'] : '';

		return sprintf(
		  '<img src="%s" class="%s"%s>',
          ( $atts['src'] ) ? $atts['src'] : '',
		  esc_attr( $class ),
		  ( $data_props ) ? ' ' . $data_props : ''
		);
	}

	/*
     * Bookme_bs_li
     */
    function bookme_bs_li( $atts, $content = null ) {

		$atts = shortcode_atts( array(
		  "xclass" => false,
		  "data"   => false
		), $atts );

		$class = ( $atts['xclass'] ) ? ' class="' . $atts['xclass'] . '"' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
		  '<li%s%s>%s</li>',
		  $class,
		  ( $data_props ) ? ' ' . $data_props : '',
		  do_shortcode( $content )
		);
	}

	/*
     * Bookme_bs_list
     */
    function bookme_bs_list( $atts, $content = null ) {

		$atts = shortcode_atts( array(
		  "type"   => false,
		  "xclass" => false,
		  "data"   => false
		), $atts );

		$class  = 'bookme ';
		$class .= ( $atts['type'] ) ? $atts['type'] . '-list' : 'default-list';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
		  '<%1$s class="%2$s"%3$s>%4$s</%1$s>',
		  ( $atts['type'] == 'number' ) ? 'ol' : 'ul',
		  esc_attr( $class ),
		  ( $data_props ) ? ' ' . $data_props : '',
		  do_shortcode( $content )
		);
	}

	/*
     * Bookme_bs_slides
     */
	function bookme_bs_slides( $atts, $content = null ) {

		if( isset($GLOBALS['slides_count']) )
		  $GLOBALS['slides_count']++;
		else
		  $GLOBALS['slides_count'] = 0;

		$GLOBALS['slides_default_count'] = 0;

		$atts = shortcode_atts( array(
		  "bullets"  => false,
		  "interval" => false,
		  "pause"    => false,
		  "wrap"     => false,
		  "xclass"   => false,
		  "data"     => false,
		), $atts );

		$div_class  = 'carousel bookme slide';
		$div_class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$inner_class = 'carousel-inner';

		$id = 'custom-carousel-'. $GLOBALS['slides_count'];

		$data_props = $this->parse_data_attributes( $atts['data'] );

		$atts_map = $this->attribute_map( $content );

		// Extract the slide titles for use in the carousel widget.
		if ( $atts_map ) {
		  $GLOBALS['slides_default_active'] = true;
		  foreach( $atts_map as $check ) {
			if( !empty($check["slide"]["active"]) ) {
			  $GLOBALS['slides_default_active'] = false;
			}
		  }
		  $indicators = array();
		  if ( $atts['bullets'] ) {
			  $i = 0;
			  foreach( $atts_map as $slide ) {
				$indicators[] = sprintf(
				  '<li class="%s" data-target="%s" data-slide-to="%s"></li>',
				  ( !empty($slide["slide"]["active"]) || ($GLOBALS['slides_default_active'] && $i == 0) ) ? 'active' : '',
				  esc_attr( '#' . $id ),
				  esc_attr( $i )
				);
				$i++;
			  }
		  }
		}

		return sprintf(
		  '<div class="%s" id="%s" data-ride="carousel"%s%s%s%s>%s<div class="%s" role="listbox">%s</div>%s</div>',
		  esc_attr( $div_class ),
		  esc_attr( $id ),
		  ( $atts['interval'] )   ? sprintf( ' data-interval="%d"', $atts['interval'] ) : '',
		  ( $atts['pause'] )      ? sprintf( ' data-pause="%s"', esc_attr( $atts['pause'] ) ) : '',
		  ( $atts['wrap'] == 'true' )       ? sprintf( ' data-wrap="%s"', esc_attr( $atts['wrap'] ) ) : '',
		  ( $data_props ) ? ' ' . $data_props : '',
		  ( $atts['bullets'] ) ? '<ol class="carousel-indicators">' . implode( $indicators ) . '</ol>' : '',
		  esc_attr( $inner_class ),
		  do_shortcode( $content ),
		  '<p class="rem"><a class="left carousel-control" role="button" href="' . esc_url( '#' . $id ) . '" data-slide="prev"><span class="fa fa-chevron-left fa-lg"></span></a><a class="right carousel-control" role="button" href="' . esc_url( '#' . $id ) . '" data-slide="next"><span class="fa fa-chevron-right fa-lg"></span></a></p>'
		);
	}

	/*
     * Bookme_bs_slide
     */
	function bookme_bs_slide( $atts, $content = null ) {

		$atts = shortcode_atts( array(
		  "active"  => false,
		  "title"   => false,
		  "caption" => false,
		  "image"   => false,
		  "xclass"  => false,
		  "data"    => false
		), $atts );

		if( $GLOBALS['slides_default_active'] && $GLOBALS['slides_default_count'] == 0 ) {
			$atts['active'] = true;
		}
		$GLOBALS['slides_default_count']++;

		$class  = 'item';
		$class .= ( $atts['active'] ) ? ' active' : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

        $caption = '';
        if( $atts['caption'] || $atts['title'] ){
            $caption .= '<div class="carousel-caption">';
            if($atts['title']) $caption .= '<h3>'.esc_html( $atts['title'] ).'</h3>';
            if($atts['caption']) $caption .= '<p>'.esc_html( $atts['caption'] ).'</p>';
            $caption .= '</div>';
        }

		$data_props = $this->parse_data_attributes( $atts['data'] );

		//$content = preg_replace('/class=".*?"/', '', $content);

		if( $atts['image'] ){
			$content = '<img src="'.$atts['image'].'" alt="" class="img-responsive">';
		}

		return sprintf(
		  '<div class="%s"%s>%s%s</div>',
		  esc_attr( $class ),
		  ( $data_props ) ? ' ' . $data_props : '',
		  $content,
		  $caption
		);
	}

	/*
     * Bookme_bs_thumbnail
     */
    function bookme_bs_thumbnail( $atts, $content = null ) {

		$atts = shortcode_atts( array(
		  "xclass"    => false,
          "link"      => false,
          "target"    => false,
		  "src"       => false,
		  "alt"       => false,
		  "data"      => false
		), $atts );

		$class  = 'thumbnail bookme';
		$class .= ($atts['xclass']) ? ' ' . $atts['xclass'] : '';

        if($atts['link']) {
            $alink  = '<a ';
            $alink .= ($atts['link']) ? ' href="' . esc_url($atts['link']) . '"' : '';
            $alink .= ($atts['alt']) ? ' title="' . esc_html($atts['alt']) . '"' : '';
            $alink .= ($atts['target']) ? ' target="' . $atts['target'] . '"' : '';
            $alink .= '>';
        }

		if($atts['src']) {
		  $img  = '<img src="'.$atts['src'].'"';
          $img .= ($atts['alt']) ? ' alt="' . esc_html($atts['alt']) . '"' : '';
          $img .= '>';
		}

        $data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
		  '<div class="%s"%s>%s%s%s</div>',
		  esc_attr( $class ),
		  ( $data_props ) ? ' ' . $data_props : '',
		  ( $atts['link'] ) ? $alink : '',
          ( $atts['src'] ) ? $img : '',
          ( $atts['link'] ) ? '</a>' : ''
		);
	}

    /*
     * Bookme_bs_tabs
     */
    function bookme_bs_tabs( $atts, $content = null ) {

        if( isset( $GLOBALS['tabs_count'] ) )
          $GLOBALS['tabs_count']++;
        else
          $GLOBALS['tabs_count'] = 0;

        $GLOBALS['tabs_default_count'] = 0;

        $atts = shortcode_atts( array(
          "type"   => false,
          "xclass" => false,
          "data"   => false
        ), $atts );

        $ul_class  = 'nav bookme';
        $ul_class .= ( $atts['type'] )     ? ' nav-' . $atts['type'] : ' nav-tabs';
        $ul_class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

        $div_class = 'tab-content';

        $id = 'custom-tabs-'. $GLOBALS['tabs_count'];

        $data_props = $this->parse_data_attributes( $atts['data'] );

        $atts_map = $this->attribute_map( $content );

        // Extract the tab titles for use in the tab widget.
        if ( $atts_map ) {
          $tabs = array();
          $GLOBALS['tabs_default_active'] = true;
          foreach( $atts_map as $check ) {
              if( !empty($check["tab"]["active"]) ) {
                  $GLOBALS['tabs_default_active'] = false;
              }
          }
          $i = 0;
          foreach( $atts_map as $tab ) {

            $class  ='';
            $class .= ( !empty($tab["tab"]["active"]) || ($GLOBALS['tabs_default_active'] && $i == 0) ) ? 'active' : '';
            $class .= ( !empty($tab["tab"]["xclass"]) ) ? ' ' . $tab["tab"]["xclass"] : '';

            $tabs[] = sprintf(
              '<li%s><a href="#%s" data-toggle="tab">%s</a></li>',
              ( !empty($class) ) ? ' class="' . $class . '"' : '',
              'custom-tab-' . $GLOBALS['tabs_count'] . '-' . md5($tab["tab"]["title"]),
              $tab["tab"]["title"]
            );
            $i++;
          }
        }
        return sprintf(
          '<ul class="%s" id="%s"%s>%s</ul><div class="%s">%s</div>',
          esc_attr( $ul_class ),
          esc_attr( $id ),
          ( $data_props ) ? ' ' . $data_props : '',
          ( $tabs )  ? implode( $tabs ) : '',
          esc_attr( $div_class ),
          do_shortcode( $content )
        );
    }

    /*
     * Bookme_bs_tab
     */
    function bookme_bs_tab( $atts, $content = null ) {

        $atts = shortcode_atts( array(
          'title'   => false,
          'active'  => false,
          'fade'    => false,
          'xclass'  => false,
          'data'    => false
        ), $atts );

        if( $GLOBALS['tabs_default_active'] && $GLOBALS['tabs_default_count'] == 0 ) {
            $atts['active'] = true;
        }
        $GLOBALS['tabs_default_count']++;

        $class  = 'tab-pane bookme';
        $class .= ( $atts['fade']   == 'true' )                            ? ' fade' : '';
        $class .= ( $atts['active'] == 'true' )                            ? ' active' : '';
        $class .= ( $atts['active'] == 'true' && $atts['fade'] == 'true' ) ? ' in' : '';
        $class .= ( $atts['xclass'] )                                      ? ' ' . $atts['xclass'] : '';


        $id = 'custom-tab-'. $GLOBALS['tabs_count'] . '-'. md5( $atts['title'] );

        $data_props = $this->parse_data_attributes( $atts['data'] );

        return sprintf(
          '<div id="%s" class="%s"%s>%s</div>',
          esc_attr( $id ),
          esc_attr( $class ),
          ( $data_props ) ? ' ' . $data_props : '',
          do_shortcode( $content )
        );

    }

    /*
     * Bookme_bs_title
     */
    function bookme_bs_title( $atts, $content = null ) {

        $atts = shortcode_atts( array(
          "size"   => false,
          "xclass" => false,
          "data"   => false
        ), $atts );

        $class  = 'font-title bookme';
        $class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

        $data_props = $this->parse_data_attributes( $atts['data'] );

        return sprintf(
          '<h%s class="%s"%s>%s</h%s>',
          ( $atts['size'] ) ? $atts['size'] : '3',
          esc_attr( $class ),
          ( $data_props ) ? ' ' . $data_props : '',
          do_shortcode( $content ),
          ( $atts['size'] ) ? $atts['size'] : '3'
        );
    }

    /*
     * Bookme_bs_toggles
     */
    function bookme_bs_toggles( $atts, $content = null ) {

        if( isset($GLOBALS['toggles_count']) )
          $GLOBALS['toggles_count']++;
        else
          $GLOBALS['toggles_count'] = 0;

        $atts = shortcode_atts( array(
          "xclass" => false,
          "data"   => false
        ), $atts );

        $class = 'panel-group bookme';
        $class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

        $id = 'custom-collapse-'. $GLOBALS['toggles_count'];

        $data_props = $this->parse_data_attributes( $atts['data'] );

        return sprintf(
          '<div class="%s" id="%s" role="tablist" aria-multiselectable="true"%s>%s</div>',
          esc_attr( $class ),
          esc_attr( $id ),
          ( $data_props ) ? ' ' . $data_props : '',
          do_shortcode( $content )
        );

    }

    /*
     * Bookme_bs_toggle
     */
    function bookme_bs_toggle( $atts, $content = null ) {

        $atts = shortcode_atts( array(
          "title"   => false,
          "type"    => false,
          "active"  => false,
          "xclass"  => false,
          "data"    => false
        ), $atts );

        $panel_class = 'panel bookme';
        $panel_class .= ( $atts['type'] )     ? ' panel-' . $atts['type'] : ' panel-default';
        $panel_class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

        $collapse_class = 'panel-collapse';
        $collapse_class .= ( $atts['active'] == 'true' )  ? ' in' : ' collapse';

        $a_class = '';
        $a_class .= ( $atts['active'] == 'true' )  ? '' : 'collapsed';

        $parent = 'custom-collapse-'. $GLOBALS['toggles_count'];
        $current_collapse = $parent . '-'. md5( $atts['title'] );

        $data_props = $this->parse_data_attributes( $atts['data'] );

        return sprintf(
          '<div class="%1$s"%2$s>
            <div class="panel-heading" role="tab">
              <h4 class="panel-title">
                <a role="button" class="%3$s" data-toggle="collapse" data-parent="#%4$s" href="#%5$s" aria-expanded="true" aria-controls="%5$s">%6$s</a>
              </h4></div>
            <div role="tabpanel" id="%5$s" class="%7$s">
              <div class="panel-body">%8$s</div></div></div>',
          esc_attr( $panel_class ),
          ( $data_props ) ? ' ' . $data_props : '',
          $a_class,
          $parent,
          $current_collapse,
          $atts['title'],
          esc_attr( $collapse_class ),
          do_shortcode( $content )
        );
    }

	/*--------------------------------------------------------------------------------------
	*
	* Parse data-attributes for shortcodes
	*
	*-------------------------------------------------------------------------------------*/
	function parse_data_attributes( $data ) {

		$data_props = '';

		if( $data ) {
			$data = explode( '|', $data );

			foreach( $data as $d ) {
				$d = explode( ',', $d );
				$data_props .= sprintf( 'data-%s="%s" ', esc_html( $d[0] ), esc_attr( trim( $d[1] ) ) );
			}
		} else {
			$data_props = false;
		}
		return $data_props;
	}

	/*--------------------------------------------------------------------------------------
	*
	* get DOMDocument element and apply shortcode parameters to it. Create the element also
	*
	*-------------------------------------------------------------------------------------*/
	private function get_dom_element( $tag, $content, $class, $title = '', $data = null ) {

		//clean up content
		$content = trim(trim($content), chr(0xC2).chr(0xA0));
		$previous_value = libxml_use_internal_errors(TRUE);

		$dom = new DOMDocument;
		$dom->loadXML(utf8_encode($content));

		libxml_clear_errors();
		libxml_use_internal_errors($previous_value);

		if(!$dom->documentElement) {
			$element = $dom->createElement($tag, utf8_encode($content));
			$dom->appendChild($element);
		}

		$dom->documentElement->setAttribute('class', $dom->documentElement->getAttribute('class') . ' ' . esc_attr( utf8_encode($class) ));

		if( $title ) {
			$dom->documentElement->setAttribute('title', utf8_encode($title) );
		}
		if( $data ) {
			$data = explode( '|', $data );
			foreach( $data as $d ):
				$d = explode(',',$d);
				$dom->documentElement->setAttribute('data-'.utf8_encode($d[0]),trim(utf8_encode($d[1])));
			endforeach;
		}
		return $dom->saveXML($dom->documentElement);
	}

	/*--------------------------------------------------------------------------------------
	*
	* Scrape the shortcode's contents for a particular DOMDocument tag or tags,
	* pull them out, apply attributes, and return just the tags.
	*
	*-------------------------------------------------------------------------------------*/
	private function scrape_dom_element( $tag, $content, $class, $title = '', $data = null ) {

		$previous_value = libxml_use_internal_errors(TRUE);

		$dom = new DOMDocument;
		$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));

		libxml_clear_errors();
		libxml_use_internal_errors($previous_value);
		foreach ($tag as $find) {
			$tags = $dom->getElementsByTagName($find);
			foreach ($tags as $find_tag) {
				$outputdom = new DOMDocument;
				$new_root = $outputdom->importNode($find_tag, true);
				$outputdom->appendChild($new_root);

				if(is_object($outputdom->documentElement)) {
					$outputdom->documentElement->setAttribute('class', $outputdom->documentElement->getAttribute('class') . ' ' . esc_attr( $class ));
					if( $title ) {
						$outputdom->documentElement->setAttribute('title', $title );
					}
					if( $data ) {
						$data = explode( '|', $data );
						foreach( $data as $d ):
							$d = explode(',',$d);
							$outputdom->documentElement->setAttribute('data-'.$d[0],trim($d[1]));
						endforeach;
					}
				}
				return $outputdom->saveHTML($outputdom->documentElement);
			}
		}
	}

	/*--------------------------------------------------------------------------------------
	*
	* Find if content contains a particular tag, if not, create it, either way wrap it
	* Example: Check if the contents of [page-header] include an h1, if not, add one,
	* then wrap it all in a div so we can add classes to that.
	*
	*-------------------------------------------------------------------------------------*/
	function nest_dom_element($find, $append, $content) {

		$previous_value = libxml_use_internal_errors(TRUE);

		$dom = new DOMDocument;
		$dom->loadXML(utf8_encode($content));

		libxml_clear_errors();
		libxml_use_internal_errors($previous_value);

		//Does $content include the tag we're looking for?
		$hasFind = $dom->getElementsByTagName($find);

		//If not, add it and wrap it all in our append tag
		if( $hasFind->length == 0 ) {
			$wrapper = $dom->createElement($append);
			$dom->appendChild($wrapper);

			$tag = $dom->createElement($find, $content);
			$wrapper->appendChild($tag);
		} else { //If so, just wrap everything in our append tag
			$new_root = $dom->createElement($append);
			$new_root->appendChild($dom->documentElement);
			$dom->appendChild($new_root);
		}
		return $dom->saveXML($dom->documentElement);
	}

	/**
	 * Add dividers to data attributes content if needed
	 */
	private function check_for_data( $data ) {
		if( $data )
			return "|";
	}
    /**
     * Remove wpautop
     */
    private function strip_paragraph( $content ) {
        $content = str_ireplace( '<p>','',$content );
        $content = str_ireplace( '</p>','',$content );
        $content = str_ireplace( '<br>','',$content );
		$content = htmlentities( $content, ENT_IGNORE, 'UTF-8', false );
        return $content;
    }

    private function attribute_map($str, $att = null) {
        $res = array();
        $return = array();
        $reg = get_shortcode_regex();
        preg_match_all('~'.$reg.'~',$str, $matches);
        foreach($matches[2] as $key => $name) {
            $parsed = shortcode_parse_atts($matches[3][$key]);
            $parsed = is_array($parsed) ? $parsed : array();

                $res[$name] = $parsed;
                $return[] = $res;
            }
        return $return;
    }

	/**
	 * CleanUp DOM Document element
	 */
	function cleanup_domdocument($content) {
		$content = preg_replace('#(( ){0,}<br( {0,})(/{0,1})>){1,}$#i', '', $content);
		return $content;
	}

} //end Class

function bookme_contact_form_sc( $atts ) {
 
    // This line of comment, too, holds the place of the brilliant yet simple shortcode that creates our contact form. And yet you're still wasting your time to read this comment. Bravo.
 	extract( shortcode_atts( array(
    	// if you don't provide an e-mail address, the shortcode will pick the e-mail address of the admin:
    	"email" => get_bloginfo( 'admin_email' ),
    	"subject" => "",
    	"class" => '',
    	"label_name" => __('Name', 'bookme'),
    	"label_last_name" => __('Last Name', 'bookme'),
    	"label_email" => __('Email', 'bookme'),
    	"label_phone" => __('Phone', 'bookme'),
    	"label_service" => __('Service', 'bookme'),
    	"label_message" => __('Message', 'bookme'),
    	"label_submit" => __('Submit', 'bookme'),
    	// the error message when at least one of the required fields are empty:
    	"error_empty" => __('Please fill in all the required fields.', 'bookme'),
    	// the error message when the e-mail address is not valid:
    	"error_noemail" => __('Please enter a valid e-mail address.', 'bookme'),
    	// and the success message when the e-mail is sent:
    	"success" => __("Thanks for your e-mail! We'll get back to you as soon as we can.", "bookme"),
	), $atts ) );
	
	$result = '';
	$sent = false;
	$info = '';
	$form_data = array();
	$form_data['cf_name'] = $form_data['last_name'] = $form_data['cf_email'] = $form_data['cf_phone'] = $form_data['cf_service'] = $form_data['cf_message'] = '';
	
	// if the <form> element is POSTed, run the following code
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    	$error = false;
    	// set the "required fields" to check
    	if (is_page_template('template-architect.php') ) { 
    		$required_fields = array( "cf_name", "cf_email" );
    	} else {
    		$required_fields = array( "cf_name", "last_name", "cf_email", "cf_service" );
    	}
 
    	// this part fetches everything that has been POSTed, sanitizes them and lets us use them as $form_data['subject']
    	foreach ( $_POST as $field => $value ) {
        	if ( get_magic_quotes_gpc() ) {
            	$value = stripslashes( $value );
        	}
        	$form_data[$field] = strip_tags( $value );
    	}
 
    	// if the required fields are empty, switch $error to TRUE and set the result text to the shortcode attribute named 'error_empty'
    	foreach ( $required_fields as $required_field ) {
        	$value = trim( $form_data[$required_field] );
        	if ( empty( $value ) || $value == '' ) {
            	$error = true;
            	$result = $error_empty;
        	}
    	}
 
    	// and if the e-mail is not valid, switch $error to TRUE and set the result text to the shortcode attribute named 'error_noemail'
    	if ( ! is_email( $form_data['cf_email'] ) ) {
        	$error = true;
        	$result = $error_noemail;
    	}
 
    	if ( $error == false ) {
        	$email_subject = "[" . get_bloginfo( 'name' ) . " " . $subject . " - " . $form_data['cf_service'] . " Service]";
        	$email_message = $form_data['cf_message'] . "\n\nPhone: " . $form_data['cf_phone'] . " - \n\nIP: " . bookme_get_the_ip();
        	$headers  = "From: " . $form_data['last_name'] . ", " . $form_data['cf_name'] . " <" . $form_data['cf_email'] . ">\n";
        	$headers .= "Content-Type: text/plain; charset=UTF-8\n";
        	$headers .= "Content-Transfer-Encoding: 8bit\n";
	        wp_mail( $email, $email_subject, $email_message, $headers );
    	    $result = $success;
        	$sent = true;
    	}
	}
	
	// if there's no $result text (meaning there's no error or success, meaning the user just opened the page and did nothing) there's no need to show the $info variable
	if ( $result != '' ) {
    	$info = '<div class="col-md-12"><div class="info">' . $result . '</div></div>';
	}
	// anyways, let's build the form! (remember that we're using shortcode attributes as variables with their names)
	if (is_page_template('template-contact.php') ) {
		$email_form = '<form class="' . $class . '" method="post" action="' . get_permalink() . '">
			<div class="col-md-12">
				<div class="form-group">
					<div class="col-md-6">
						<input type="text" class="form-control" name="cf_name" value="' . $form_data['cf_name'] . '" placeholder="' . $label_name . '">
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control" name="last_name" value="' . $form_data['last_name'] . '" placeholder="' . $label_last_name . '">
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<div class="col-md-6">
						<input type="tel" class="form-control" name="cf_phone" value="' . $form_data['cf_phone'] . '" placeholder="' . $label_phone . '">
					</div>
					<div class="col-md-6">
						<input type="email" class="form-control" name="cf_email" value="' . $form_data['cf_email'] . '" placeholder="' . $label_email . '">
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<div class="col-md-6">
						<select class="form-control" name="cf_service" value="' . $form_data['cf_service'] . '">
							<option>' . __('Service', 'bookme') . '</option>'
							. bookme_service_query() . ' 
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<div class="col-md-12">
						<textarea class="form-control" name="cf_message" value="' . $form_data['cf_message'] . '" placeholder="' . $label_message . '"></textarea>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<div class="col-md-12">
						<input type="submit" class="btn btn-one" value="' . $label_submit . '" name="send" id="cf_send" />
					</div>
				</div>
			</div>
		</form>'; 
	} elseif( is_page_template('template-architect.php') ) {
		$email_form = '<form class="' . $class . '" method="post" action="' . get_permalink() . '/#requests">
			<input type="text" name="cf_name" value="' . $form_data['cf_name'] . '" placeholder="' . __('Full Name', 'bookme') . '">
			<input type="email" name="cf_email" value="' . $form_data['cf_email'] . '" placeholder="' . __('Email Address', 'bookme') . '">
			<input type="tel" name="cf_phone" value="' . $form_data['cf_phone'] . '" placeholder="' . $label_phone . '">
			<textarea name="cf_message" value="' . $form_data['cf_message'] . '" placeholder="' . __('Description', 'bookme') . '"></textarea>
			<input type="submit" class="btn btn-one" value="' . $label_submit . '" name="send" id="cf_send" />
		</form>';		
	} else {
		$email_form = '<form class="' . $class . '" method="post" action="' . get_permalink() . '">
			<input type="text" name="cf_name" value="' . $form_data['cf_name'] . '" placeholder="' . $label_name . '">
			<input type="text" name="last_name" value="' . $form_data['last_name'] . '" placeholder="' . $label_last_name . '">
			<input type="tel" name="cf_phone" value="' . $form_data['cf_phone'] . '" placeholder="' . $label_phone . '">
			<input type="email" name="cf_email" value="' . $form_data['cf_email'] . '" placeholder="' . $label_email . '">
			<select name="cf_service" value="' . $form_data['cf_service'] . '">
				<option>' . __('Service', 'bookme') . '</option>'
				. bookme_service_query() . ' 
			</select>
			<textarea name="cf_message" value="' . $form_data['cf_message'] . '" placeholder="' . $label_message . '"></textarea>
			<input type="submit" class="btn btn-one" value="' . $label_submit . '" name="send" id="cf_send" />
		</form>';
	}
	
	if ( $sent == true ) {
		return $info;
	} else {
		return $info . $email_form;
	}
 
}
add_shortcode( 'bookme_contact', 'bookme_contact_form_sc' );

/*--------------------------------------------------------------------------------------
*
* add_shortcodes button as TinyMCE Plugin
*
*-------------------------------------------------------------------------------------*/
add_action('admin_head', 'bookme_shortcode_buttons');

function bookme_shortcode_buttons(){
    global $typenow;
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') )
        return;

    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return;

    if (get_user_option('rich_editing') == 'true') {
        add_filter( 'mce_external_plugins', 'bookme_mce_buttons' );
        add_filter( 'mce_buttons', 'bookme_add_buttons' ); //1375.261
    }
}
/*
 * hook the new plugin to TinyMCE and all dependencies
 */
function Bookme_mce_buttons( $plugin_array ){
    wp_enqueue_script('jquery');
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('jquery-ui-slider');
    $plugin_array['bookme_sc_button'] = BOOKME_SHORTCODE_DIR . 'editor/editor.plugin.js';
    $elements = new Bookme_BoostrapShortcodes();
    foreach( $elements->button_shortcodes() as $element => $value ){
        $plugin_array['bookme_sc_button_' . $element] = BOOKME_SHORTCODE_DIR . 'editor/' . $element . '_plugin.js';
    }
    return $plugin_array;
}
/*
 * Hook is used to tell the TinyMCE editor which buttons in our plugin we want to show
 */
function bookme_add_buttons( $buttons ){
    array_push($buttons, "bookme_sc_button");
    return $buttons;
}
function bookme_shortcode_admin_add_script() {
	wp_register_style( 'admin-shortcode', BOOKME_SHORTCODE_DIR . 'admin.shortcode.css', false, '1.0.0' );
	wp_enqueue_style( 'admin-shortcode' );
	wp_register_style( 'magni-css', BOOKME_SHORTCODE_DIR . 'magnific-popup.css', false, '1.0.0' );
	wp_enqueue_style( 'magni-css' );
	wp_register_script( 'mfp-js', BOOKME_SHORTCODE_DIR . 'jquery.mfp.min.js', true, '1.0.0' );
	wp_enqueue_script( 'mfp-js' );
	wp_register_script( 'admin_shortcode_js', BOOKME_SHORTCODE_DIR . 'editor/admin.shortcode.js', true, '1.0.0' );
	wp_enqueue_script( 'admin_shortcode_js' );
}
add_action( 'admin_enqueue_scripts', 'bookme_shortcode_admin_add_script' );
        
new Bookme_BoostrapShortcodes();
