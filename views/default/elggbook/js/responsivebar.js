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

define(function (require) {

	var $ = require('jquery');

	$(document).on('click', '.elgg-altnav-button', function () {
		$('body').toggleClass('elgg-altnav-collapsed');
	});

	$(document).on('click', '.elgg-sidenav-button', function () {
		$('body').toggleClass('elgg-sidenav-collapsed');
	});
});
