<?php
/**
 * Messageboard list view
 */

use Elgg\Database\Clauses\OrderByClause;

$owner = elgg_get_page_owner_entity();

$num_display = 4;

echo elgg_list_annotations([
	'annotations_name' => 'messageboard',
	'guid' => $owner->guid,
	'limit' => $num_display,
	'pagination' => false,
	'no_results' => elgg_echo('messageboard:none'),
	'order_by' => [
		new OrderByClause('n_table.time_created', 'DESC'),
		new OrderByClause('n_table.id', 'DESC'),
	],
]);

$more_link = elgg_view('output/url', [
	'href' => elgg_generate_url('collection:annotation:messageboard:owner', [
		'username' => $owner->username,
	]),
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
]);

echo elgg_format_element('div', ['class' => 'elgg-widget-more'], $more_link);

elgg_require_js('elgg/messageboard');
