<?php
/**
 * Default river view for ElggObject creation
 * Will show an excerpt of the description of the ElggObject
 *
 * @uses $vars['item'] the river item
 */

$item = elgg_extract('item', $vars);
if (!$item instanceof ElggRiverItem) {
	return;
}

$object = $item->getObjectEntity();
if (!$object instanceof ElggObject) {
	return;
}

// CUSTOM CHANGE: Display attachements in river activity
$attachment = elgg_format_element('div', [
	'class' => 'my-river-attachment',
], elgg_view_entity_icon($object, 'medium'));

$message = elgg_format_element('div', [
	'class' => 'my-river-message',
], elgg_get_excerpt($object->description));

$vars['message'] = elgg_format_element('div', [
    'class' => 'my-river-create',
], $attachment . $message);

echo elgg_view('river/elements/layout', $vars);
