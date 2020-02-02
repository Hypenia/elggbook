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

// JS for adverts display
elgg_require_js("elggbook/js/ads");

// Do not show this view in admin dashboard/backend
if (elgg_in_context('admin')) {
    return;
}

// Display ads in sidebar
$ads = elgg_format_element('div', ['class' => 'adSlides slide-one'], elgg_echo('howto:disable'));

$ads .= elgg_format_element('div', ['class' => 'adSlides slide-two'], elgg_echo('howto:edit'));

 $ads .= elgg_format_element('div', ['class' => 'adSlides slide-three'], elgg_echo('fundme'));

 $ads .= elgg_format_element('div', ['class' => 'adSlides slide-four'], elgg_echo('helpme'));

 $ads .= elgg_format_element('div', ['class' => 'adSlides slide-five'], elgg_echo('donate'));

 $ads .= elgg_format_element('div', ['class' => 'adSlides slide-six'], elgg_echo('givepurpose'));

 $ads .= elgg_format_element('div', ['class' => 'adSlides slide-seven'], elgg_echo('supportme'));
?>

<div class="banner">
    <?= $ads ?>
</div>

