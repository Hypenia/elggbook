<?php
/**
 * Elggbook 3.0
 *
 * @category  ElggTheme
 * @package   Elggbook
 * @author    David Onche <daveonche@gmail.com>
 * @copyright Copyright (c) 2020, Hypenia™ | DesigN'Code Studios
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 * @link      https://biz.hypenia.com/
 **/

use Elgg\Activity\GroupRiverFilter;
use Elgg\Database\QueryBuilder;
use Elgg\Database\Clauses\OrderByClause;

$list_options = [
    'type' => 'object',
    'icon_size' => 'large',
    'limit' => 8,
    'list_class' => 'elgg-list-users',
    'pagination_type' => 'infinite',
  ];

$tab = elgg_extract('entity', $vars);
$group = $tab->getOwnerEntity();

// Use hypeWall if active
if (elgg_is_logged_in() && elgg_is_active_plugin('hypeWall')) {
    $form = elgg_view('framework/wall/container');

    if ($form) {
        $post = elgg_format_element('div', [
            'class' => [ 'wall-component',
            ],
        ], $form);
    }
} elseif (elgg_in_context('profile')) {
    // Else use thewire and file plugin form for user's profile
    $owner = elgg_get_page_owner_entity();
    if (elgg_get_logged_in_user_guid() == $owner->guid) {

        $post = elgg_view('elggbook/components/user_post');

    } elseif (elgg_is_logged_in() && elgg_is_active_plugin('messageboard')) {
        // Use messageboard form for profile visitors

        $post = elgg_view_form('messageboard/add', ['name' => 'elgg-messageboard']);

    }
} elseif (elgg_in_context('groups')) {
    // Else use thewire and file plugin form for groups

    $post = elgg_view('elggbook/components/group_post');
}

if ($tab instanceof ElggGroup) {
    // Group activity tab
    $timeline = elgg_list_river([
        'limit' => 20,
        'pagination_type' => 'infinite',
        'wheres' => [
            function (QueryBuilder $qb, $main_alias) use ($tab) {
                $tab = new GroupRiverFilter($tab);

                return $tab($qb, $main_alias);
            },
        ],
        'no_results' => elgg_echo('river:none'),
    ]);

    // Group profile details
    $about = elgg_format_element('div', [
        'class' => 'groups-profile-fields',
    ], elgg_view('groups/profile/fields', $vars));

    // Group members tab
    $mf = elgg_list_entities([
        'relationship' => 'member',
        'relationship_guid' => $tab->guid,
        'inverse_relationship' => true,
        'type' => 'user',
        'limit' => 14,
        'order_by' => [
            new OrderByClause('r.time_created', 'DESC'),
        ],
        'pagination_type' => 'infinite',
        'size' => 'large',
        'list_class' => 'elgg-list-users',
    ]);

    // Count group members
    $count_members = $tab->getMembers(['count' => true]);

    $mf_text = elgg_echo('tab:members') . " ({$count_members})";

    // Group files
    if (elgg_is_active_plugin('file')) {
        $file_options = $list_options;
        $file_options['subtype'] = 'file';
        $file_options['container_guid'] = $tab->guid;
        $file_options['list_type'] = 'gallery';
        $file_options['no_results'] = elgg_echo('file:none');
        $file = elgg_list_entities($file_options);

        // Count group files
        $file_count = $file_options;
        $file_count['count'] = true;
        $count_files = elgg_get_entities($file_count);

        $file_text = elgg_echo('tab:files') . " ({$count_files})";
    }

} elseif ($tab instanceof ElggUser) {

    // User Activity tab
    $options = [
        'limit' => 20,
        'pagination_type' => 'infinite',
        'no_results' => elgg_echo('river:none'),
    ];

    $options['subject_guid'] = $tab->getOwnerGUID();
    $timeline = elgg_list_river($options);

    // User Profile details tab
    $about = elgg_view('profile/details', $vars);

    // User friends tab
    if (elgg_is_active_plugin('friends')) {
        $pageowner = elgg_get_page_owner_entity();
        $friendrequest = (bool) elgg_get_plugin_setting('friend_request', 'friends');

        $friend_options = [
            'relationship' => 'friend',
            'relationship_guid' => $pageowner->getGUID(),
            'inverse_relationship' => true,
            'type' => 'user',
            'order_by_metadata' => [
                [
                    'name' => 'name',
                    'direction' => 'ASC',
                ],
            ],
            'full_view' => false,
            'no_results' => elgg_echo('friends:none'),
            'limit' => 12,
            'size' => $tab->icon_size ?: 'large',
            'list_class' => 'elgg-list-users',
        ];

        $mf = elgg_list_entities($friend_options);

        // Count user friends
        $count_friends = $pageowner->getFriends(['count' => TRUE]);

        $mf_text = elgg_echo('tab:friends') . " ({$count_friends})";
    }

    // User files
    if (elgg_is_active_plugin('file')) {
        $file_options = $list_options;
        $file_options['subtype'] = 'file';
        $file_options['owner_guid'] = $tab->guid;
        $file_options['list_type'] = 'gallery';
        $file_options['no_results'] = elgg_echo('file:none');
        $file = elgg_list_entities($file_options);

        // Count user files
        $file_count = $file_options;
        $file_count['count'] = TRUE;
        $count_files = elgg_get_entities($file_count);

        $file_text = elgg_echo('tab:files') . " ({$count_files})";
    }
}

echo elgg_view('page/components/tabs', [
    'tabs' => [

        'inline' => [
            'text' => elgg_echo('tab:timeline'),
            'icon' => 'clock-o',
            'content' => $post . $timeline,
            'selected' => true,
        ],

        'inline2' => [
            'text' => elgg_echo('tab:about'),
            'icon' => 'info',
            'content' => $about,
        ],

        'inline3' => [
            'text' => $mf_text,
            'icon' => 'user-friends',
            'content' => $mf,
        ],

        'inline4' => [
            'text' => $file_text,
            'icon' => 'images',
            'content' => $file,
            'class' => 'tab-inline4',
        ],
    ],
]);

?>
