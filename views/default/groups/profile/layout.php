<?php
/**
 * Layout of the groups profile page
 *
 * @uses $vars['entity']
 */

$group = elgg_extract('entity', $vars);

if (!$group instanceof ElggGroup) {
	return;
}

/*======START Custom Changes=======*/

// echo elgg_view('groups/profile/summary', $vars);

 /*======END Custom Changes=======*/

if ($group->canAccessContent()) {
	if (!$group->isPublicMembership() && !$group->isMember()) {
		echo elgg_view('groups/profile/closed_membership');
	}

	/*======START Custom Changes=======*/

	// echo elgg_view('groups/profile/widgets', $vars);

	echo elgg_format_element('div', ['class' => 'elggbook-group-tabs'], elgg_view('elggbook/components/tabs', [
		'entity' => $group,
	]));
    /*======END Custom Changes=======*/

} else {
	if ($group->isPublicMembership()) {
		echo elgg_view('groups/profile/membersonly_open');
	} else {
		echo elgg_view('groups/profile/membersonly_closed');
	}
}
