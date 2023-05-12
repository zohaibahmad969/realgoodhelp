<?php

/*
 * Remove inner container from WP group
*/

add_filter('render_block', 'realgh_custom_render_group_block', null, 2);

function realgh_custom_render_group_block (
	string $block_content, 
	array $block
): string {
	if (
		$block['blockName'] === 'core/group' && 
		!is_admin() &&
		!wp_is_json_request()
	) {
		$html = '';
		$tag = $block['attrs']['tagName'] ?? 'div';

		$html .= '<' . $tag . ' class="' . $block['attrs']['className'] . '">' . "\n";

		if (isset($block['innerBlocks'])) {
			foreach ($block['innerBlocks'] as $inner_block) {
				$html .= render_block($inner_block);
			}
		}

		$html .= '</' . $tag . '>' . "\n";

		return $html;
	}

	return $block_content;
}