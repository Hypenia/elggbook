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

$path = '';
if (is_dir(__DIR__ . '/vendor')) {
    $path = __DIR__ . '/';
}

return [

    'bootstrap' => '\Hypenia\ElggBook\Bootstrap',

    // add custom images and js directory
    'views' => [
        'default' => [
            'elggbook/' => elgg_get_data_path() . 'elggbook/images/',
            'stickyjs/' => $path . 'vendor/bower-asset/stickyjs/',
        ],
    ],

    // Remove default title menu in favor of custom title menu
    'hooks' => [
        'register' => [
            'menu:title' => [
                '_profile_title_menu' => [
                    'register' => false
                ],
            ],
        ],
        'register' => [
            'menu:title' => [
                '_elgg_user_title_menu' => [
                    'register' => false
                ],
            ],
        ],
    ],

    // Remove messageboard widget from profile and add form for user profile visitor's post and list posts
    'widgets' => [
        'messageboard' => [
            'context' => [
                'profile' => [
                    'register' => false
                ],
            ],
        ],
    ],
];
