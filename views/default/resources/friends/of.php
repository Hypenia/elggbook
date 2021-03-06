<?php
/**
 * Elgg friends of page
 *
 * @package Elgg.Core
 * @subpackage Social.Friends
 */

// needed for correct registration of menu items
elgg_set_context('friends');

$owner = elgg_get_page_owner_entity();
if (!$owner instanceof ElggUser) {
	throw new \Elgg\EntityNotFoundException;
}

$title = elgg_echo("friends:of:owned", [$owner->getDisplayName()]);

$content = elgg_list_entities([
	'relationship' => 'friend',
	'relationship_guid' => $owner->getGUID(),
	'inverse_relationship' => true,
	'type' => 'user',
	'size' => 'large',
	'limit' => 12,
	'order_by_metadata' => [
		[
			'name' => 'name',
			'direction' => 'ASC',
		],
	],
	'full_view' => false,
	'list_class' => 'elgg-list-users',
	'no_results' => elgg_echo('friends:none'),
]);

$params = [
	'filter_id' => 'filter',
	'filter_value' => 'friends_off',
	'content' => $content,
	'title' => $title,
];
$body = elgg_view_layout('one_sidebar', $params);

echo elgg_view_page($title, $body);
