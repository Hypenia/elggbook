<?php
/**
 * Elgg secondary sidebar contents
 *
 * You can override, extend, or pass content to it
 *
 * @uses $vars['sidebar_alt] HTML content for the alternate sidebar
 */

$page_menu = elgg_view_menu('page', ['sort_by' => 'name']);
if ($page_menu) {
	$sidebar = elgg_view_module('info', '', $page_menu, [
		'class' => 'elgg-page-menu',
	]);
}

if (!elgg_in_context('profile')) {
    $sidebar .= elgg_view('page/elements/owner_block', $vars);
}

$sidebar .= elgg_extract('sidebar_alt', $vars, '');

$sidebar .= elgg_view('page/elements/tagcloud_block', $vars);

echo $sidebar;

