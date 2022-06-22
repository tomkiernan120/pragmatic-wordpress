<?php

require_once __DIR__ . '/vendor/autoload.php';

if (class_exists('Timber\Timber')) {
	$timber = new Timber\Timber();
}

add_theme_support('post-thumbnails');
add_filter('allowed_block_types_all', 'allowed_block_types');

function allowed_block_types($allowed_blocks)
{
	$allowedBlocks = [];

	foreach (glob(__DIR__ . "/blocks/*.php") as $filename) {

		$allowedBlocks[] = "acf/" . pathinfo( $filename, PATHINFO_FILENAME );
	}


	return $allowedBlocks;
}


function add_theme_scripts()
{
	wp_enqueue_style('stylesheet', get_template_directory_uri() . '/dist/main.css', array(), '1.1', 'all');
	wp_enqueue_script('js-script', get_template_directory_uri() . '/dist/index.js', [], 1.2, true);

	// fancybox
	// wp_enqueue_script('fancybox-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js');
	wp_enqueue_style('fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');


// function add_to_context($context)
// {
// 	$context['menu'] = new \Timber\Menu('main');
// 	$context['footer_menu'] = new \Timber\Menu('footer');

// 	$context["footer_body"] = get_field('body', 'option');

// 	$context["newsItems"] = get_posts([
// 		'numberposts' => 4
// 	]);

// 	return $context;
// }

add_filter('timber/context', 'add_to_context');

if (function_exists('acf_add_options_page')) {
	acf_add_options_page();

	if (function_exists('acf_add_local_field_group')) {

		acf_add_local_field_group(array(
			'key' => 'header_text_block',
			'title' => 'Header Text Block',
			'fields' => array(
				array(
					'key' => 'header_text_block_text',
					'label' => 'Header Text Block',
					'name' => 'header_text_block_text',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'acf-options',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'left',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
			'acfe_display_title' => '',
			'acfe_autosync' => '',
			'acfe_form' => 0,
			'acfe_meta' => '',
			'acfe_note' => '',
		));

		acf_add_local_field_group(array(
			'key' => 'group_popup_options',
			'title' => 'Popup Options',
			'fields' => array(
				array(
					'key' => 'group_popup_options_text',
					'label' => 'Text',
					'name' => 'popup_options_text',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
					'delay' => 0,
				),
				array(
					'key' => 'group_popup_options_map',
					'label' => 'Map',
					'name' => 'popup_options_map',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
					'delay' => 0,
				),
				array(
					'key' => 'group_popup_options_text_repeater',
					'label' => 'Text Container',
					'name' => 'text_container',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
					'delay' => 0,
					'layout' => 'row',
					'sub_fields' => array(
						array(
							'key' => 'group_popup_options_text_repeater_text',
							'label' => 'Text',
							'name' => 'text',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 1,
							'delay' => 0,
						),
						array(
							'key' => 'group_popup_options_text_repeater_link',
							'label' => 'Link',
							'name' => 'link',
							'type' => 'link',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 1,
							'delay' => 0,
						),
						array(
							'key' => 'group_popup_options_text_repeater_link-orange',
							'label' => 'Link Orange',
							'name' => 'link_orange',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 1,
							'delay' => 0,
						),
					),
				),
				array(
					'key' => 'group_popup_options_text_form_title',
					'label' => 'Form Title',
					'name' => 'form_title',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
					'delay' => 0,
				),
				array(
					'key' => 'group_popup_options_text_form_shortcode',
					'label' => 'Form Shortcode',
					'name' => 'form_shortcode',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
					'delay' => 0,
				),
				array(
					'key' => 'group_popup_options_text_form_footer',
					'label' => 'Form Footer',
					'name' => 'form_footer',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
					'delay' => 0,
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'acf-options',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'left',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
			'acfe_display_title' => '',
			'acfe_autosync' => '',
			'acfe_form' => 0,
			'acfe_meta' => '',
			'acfe_note' => '',
		));

		acf_add_local_field_group(array(
			'key' => 'group_616ef2cf124fb',
			'title' => 'Footer Options',
			'fields' => array(
				array(
					'key' => 'field_616ef2d8198a7',
					'label' => 'Body',
					'name' => 'body',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
					'delay' => 0,
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'acf-options',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'left',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
			'acfe_display_title' => '',
			'acfe_autosync' => '',
			'acfe_form' => 0,
			'acfe_meta' => '',
			'acfe_note' => '',
		));
	}
}


add_action('acf/init', 'register_blocks');

function renderACFBlock($block){

	$context = Timber::get_context();

	$context[ "data" ] = $block[ "data" ];

	$string = Timber::compile(get_template_directory() . "/views/parts/" . str_replace( "acf/", "", $block["name"] ) . ".twig", $context, false, 'default', true);

	echo $string;
}

function register_blocks()
{

	foreach (glob(__DIR__ . "/blocks/*.php") as $filename) {

		require_once $filename;
	}
}

add_theme_support('menus');


// Gutenberg custom stylesheet
add_theme_support('editor-styles');
add_editor_style('dist/editor.css'); // make sure path reflects where the file is located


if( $_GET && isset( $_GET[ "debug" ] ) ) {
	function wpse33318_tiny_mce_before_init($mce_init)
	{

		$mce_init['cache_suffix'] = "v=" . rand(100000000,999999999);

		return $mce_init;
	}

	add_filter('tiny_mce_before_init', 'wpse33318_tiny_mce_before_init');
}
