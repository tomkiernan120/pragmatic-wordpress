<?php

if (function_exists('acf_register_block')) {

	acf_register_block([
		'name' => 'text-block',
		'title' => __('Text Block'),
		'description' => __('Text Block'),
		'render_callback' => 'renderACFBlock',
		'category' => 'layout',
		'icon' => 'admin-comments',
		'mode' => 'preview',
		'keywords' => ['text', 'block', 'layout'],
		'post_'
	]);

	if (function_exists('acf_add_local_field_group')) {

		acf_add_local_field_group(array(
			'key' => 'text-block',
			'title' => 'Text Block',
			'fields' => array(
				array(
					'key' => 'text-block-layout',
					'label' => 'Layout',
					'name' => 'layout',
					'type' => 'select',
					'choices' => array(
						'left' => 'Left',
						'center' => 'Center',
						'right' => 'Right'
					),
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'text-block-text',
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
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'text-block-school-selector',
					'label' => 'School Selector',
					'name' => 'school-selector',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/text-block',
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
