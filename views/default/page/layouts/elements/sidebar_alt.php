<?php

/**
 * Second layout sidebar
 *
 * @uses $vars['sidebar_alt'] Sidebar view
 */

elgg_require_js("elggbook/js/sticker");

elgg_require_js('elggbook/js/responsivebar');

echo elgg_view('output/url', [
    'class' => 'elgg-altnav-button',
    'icon' => 'chevron-right',
]);

$sidebar_alt = elgg_extract('sidebar_alt', $vars);
if (!$sidebar_alt) {
    return;
}

?>
<div class="elgg-altnav-collapse">
    <div class="elgg-sidebar-alt elgg-layout-sidebar-alt clearfix">
        <?= $sidebar_alt ?>
    </div>
</div>
