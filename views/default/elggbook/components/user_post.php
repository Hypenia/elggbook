<?php
/**
 * Prepend a form before the river for users
 */

if (!elgg_is_logged_in()) {
    return;
}

$user = elgg_get_page_owner_entity();
if ($user instanceof ElggGroup) {
    return;
}

echo elgg_view('elggbook/components/post');
