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

// create thewire form
$wireform_vars = ['class' => 'thewire-form'];
$thewire = elgg_view_form('thewire/add', $wireform_vars);
$thewire .= elgg_view('input/urlshortener');

// create file form
$fileform_vars = ['enctype' => 'multipart/form-data'];
$body_vars = file_prepare_form_vars();
$file = elgg_view_form('file/upload', $fileform_vars, $body_vars);


$timeline_post = elgg_view('page/components/tabs', [
    'tabs' => [

        'inline' => [
            'text' => elgg_echo('post:status'),
            'icon' => 'feather-alt',
            'content' => $thewire,
            'selected' => true,
        ],

        'inline2' => [
            'text' => elgg_echo('post:file'),
            'icon' => 'images',
            'content' => $file,
        ],
    ],
]);

echo elgg_format_element('div', [
    'class' => [ 'post-form',
    ],
], $timeline_post);