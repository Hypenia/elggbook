<?php

$username = elgg_extract('username', $vars);
if ($username) {
	$user = get_user_by_username($username);
} else {
	$user = elgg_get_logged_in_user_entity();
}

$user_guid = $user ? $user->guid : 0;

elgg_entity_gatekeeper($user_guid, 'user');

elgg_set_page_owner_guid($user_guid);

/*======START Custom Changes=======*/
$content = elgg_view('output/url', [
    'class' => 'elgg-sidenav-button',
    'icon' => 'chevron-left',
]);

$content .= elgg_format_element('div', ['class' => 'elggbook-profile-tabs'], elgg_view('elggbook/components/tabs', [
	'entity' => $user,
]));

$messageboard_posts = elgg_view_module('aside', elgg_echo('messageboard'), elgg_view('elggbook/components/messageboard'), [
	'class' => 'elgg-messageboard-list',
]);

$widgets = elgg_view_layout('widgets', [
    'num_columns' => 1,
    'owner_guid' => $user_guid,
]);

$profile_sidebar = elgg_format_element('div', ['class' => 'profile-sidebar'], $messageboard_posts . $widgets);

$content .= elgg_format_element('div', ['class' => 'elgg-sidenav-collapse'], $profile_sidebar);

/*======END Custom Changes=======*/

$body = elgg_view_layout('default', [
	'content' => $content,
	'title' => $user->getDisplayName(),
	'entity' => $user,
	'sidebar_alt' => elgg_view('profile/owner_block', [
	'entity' => $user,
	]),
	'class' => 'profile',
	'sidebar' => false,
]);

echo elgg_view_page($user->getDisplayName(), $body);

/*========Elggbook Sticky JS=========*/
    elgg_require_js("elggbook/js/sticker");
