<?php
/**
 * This view prepends the content layout
 * to check if we need to add a post form to the group acivity listing
 */

if (!elgg_is_logged_in()) {
    return;
}

$group = elgg_get_page_owner_entity();
if (!($group instanceof ElggGroup)) {
    return;
}

if (!$group->isToolEnabled('thewire')) {
    return;
}

if (!$group->canEdit() && !$group->isMember()) {
    return;
}

// check the plugin setting for thewire_tool
if (elgg_get_plugin_setting('extend_activity', 'thewire_tools') == 'yes') {
    echo elgg_view('elggbook/components/post');
}
