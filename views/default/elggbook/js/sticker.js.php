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
?>

define(['elgg', 'jquery', 'stickyjs/jquery.sticky'], function (elgg, $) {
	elgg.register_hook_handler('init', 'system', function() {
        $(document).on('scroll', function(){
            $(".elgg-page-body .elgg-sidebar-alt, .elgg-layout-columns .elgg-sidebar, .profile-sidebar").sticky({ topSpacing: 0});
        });
	}, 1000);
});
