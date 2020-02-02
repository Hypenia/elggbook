<?php
/*
 *
 * Elggbook 3.0
 *
 * @author David Onche
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 * @copyright Copyright (c) 2019, Hypenia™
 *
 */

$body = elgg_view('elggbook/custom_index/index', $vars);

echo elgg_view_page('', $body);

