<?php

/**
 * Layout sidebar
 *
 * @uses $vars['sidebar'] Sidebar view
 */

$sidebar = elgg_extract('sidebar', $vars);
if ($sidebar === false) {
    return;
 }

if (!elgg_in_context('admin')) {

    elgg_require_js("elggbook/js/sticker");

    elgg_require_js('elggbook/js/bar');

    echo elgg_view('output/url', [
        'class' => 'elgg-sidenav-button',
        'icon' => 'chevron-left',
    ]);

    $collapse = elgg_format_element('div', [
        'class' => 'elgg-sidebar elgg-layout-sidebar clearfix',
    ],  $sidebar);

    echo elgg_format_element('div', [
        'class' => 'elgg-sidenav-collapse',
    ], $collapse);

} else {

    echo elgg_format_element('div', [
        'class' => 'elgg-sidebar elgg-layout-sidebar clearfix',
    ], $sidebar);
}

?>
<!-- <div class="elgg-sidebar elgg-layout-sidebar clearfix">
    <?php
        // echo $sidebar;
    ?>
</div> -->
