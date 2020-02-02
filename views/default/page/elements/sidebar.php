<?php
/**
 * Elgg sidebar contents
 *
 * @uses $vars['sidebar'] Optional content that is displayed at the bottom of sidebar
 */

// echo elgg_view('page/elements/owner_block', $vars);
// echo elgg_view('page/elements/page_menu', $vars);

echo elgg_view('elggbook/components/ads', $vars);

// optional 'sidebar' parameter
if (isset($vars['sidebar'])) {
	echo $vars['sidebar'];
}
