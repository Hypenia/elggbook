<?php

/**
 * Header for layouts
 *
 * @uses $vars['title']  Title
 * @uses $vars['header'] Optional override for the header
 */
$header = elgg_extract('header', $vars);
unset($vars['header']);

if (!isset($header)) {
    $owner = elgg_get_page_owner_entity();
    $user = elgg_get_logged_in_user_entity();
    $group = elgg_extract('entity', $vars);

    if (elgg_in_context('admin')) {
        return;
    }
    if ($owner instanceof ElggUser) {
        if ($owner->hasIcon('cover', 'profile_cover')) {
            $cover_image_url =      $owner->getIconURL([
                'type' => 'profile_cover',
                'size' => 'cover',
            ]);
        }
        $icon = elgg_view_entity_icon ($owner, 'large', [
            'use_hover' => false,
            'use_link' => false,
            'img_class' => 'photo u-photo',
        ]);
    } elseif ($owner instanceof ElggGroup) {
    // we don't force icons to be square so don't set width/height
        $cover_image_url = $owner->getIconURL('master', [
            'href' => '',
            'width' => '',
            'height' => '',
            'size' => 'cover',
        ]);

        // $groupowner = $owner->getOwnerEntity();
        // if (!($groupowner instanceof \ElggUser)) {
        //     return;
        // }

        // $body = elgg_view_entity($groupowner, [
        //     'full_view' => false,
        // ]);

        // // $icon = elgg_format_element('div', [
        // //     'class' => 'groups-owner',
        // // ], elgg_view_module('aside', elgg_echo('groups:owner'), $body));

    } elseif ($user instanceof ElggUser)  {
        if ($user->hasIcon('cover', 'profile_cover')) {
            $cover_image_url =      $user->getIconURL([
                'type' => 'profile_cover',
                'size' => 'cover',
            ]);
        }
        $icon = elgg_view_entity_icon ($user, 'large',
            [
                'use_hover' => false,
                'use_link' => false,
                'img_class' => 'photo u-photo',
            ]
        );
    }

    $title = elgg_extract('title', $vars, '');
    unset($vars['title']);

    if ($title) {
        $title = elgg_view_title($title, [
            'class' => 'elgg-heading-main',
        ]);
    }

    // Moved Breadcrumbs below header title from default layout
    $breadcrumbs = elgg_view('page/layouts/elements/breadcrumbs', $vars);

    $menu_params = $vars;
    $menu_params['sort_by'] = 'priority';
    $menu_params['class'] = 'elgg-menu-hz';
    $buttons = elgg_view_menu('title', $menu_params);

    $header = $icon . $title . $breadcrumbs . $buttons;
}

if (!$header) {
    return;
}

$filter = elgg_view('page/layouts/elements/filter', $vars);

echo <<<HTML
<div class="elgg-head-bg">
    <div class="elgg-head elgg-layout-header" style="background: url($cover_image_url) center no-repeat; background-size: cover;">
	    $header
    </div>
    $filter
</div>
HTML;
