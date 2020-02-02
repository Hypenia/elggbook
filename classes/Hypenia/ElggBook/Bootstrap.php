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

namespace Hypenia\ElggBook;

use Elgg\DefaultPluginBootstrap;

class Bootstrap extends DefaultPluginBootstrap {

	/**
	 * {@inheritdoc}
	 */
	public function init() {

        // Footer Copyright
        $year = date('Y');
        elgg_register_menu_item('footer', \ElggMenuItem::factory([
            'name' => 'designed',
            'text' => elgg_echo("&copy;") . $year . ' ' . elgg_echo("hypenia:designed"),
            'href' => 'https://biz.hypenia.com/',
            'section' => 'meta',
            'priority' => 500,
        ]));

		$this->registerViews();
		$this->registerEvents();
        $this->registerHooks();

	}

    /**
	 * Register view extensions / ajax views
	 *
	 * @return void
	 */
	protected function registerViews() {

        // Extend elgg.css
        elgg_extend_view('elgg.css', 'elggbook/elggbook.css');

        // Display post form
        if (!elgg_is_active_plugin('hypeWall')) {

            elgg_unextend_view('river/filter', 'thewire_tools/activity_post', 400);

            elgg_extend_view('river/filter', 'elggbook/components/user_post', 100);

            elgg_unextend_view('page/layouts/elements/filter', 'thewire_tools/group_activity', 400);

            elgg_extend_view('river/filter', 'elggbook/components/group_post', 100);
        }

        // Add Script for Sticker
        elgg_register_simplecache_view('elggbook/js/sticker.js');

        // Add Script for ads banner
        elgg_register_simplecache_view('elggbook/js/ads.js');

    }

	/**
	 * Register event listeners
	 *
	 * @return void
	 */
	protected function registerEvents() {
		$events = $this->elgg()->events;

	}

/**
	 * Register plugin hook handlers
	 *
	 * @return void
	 */
	protected function registerHooks() {
        $hooks = $this->elgg()->hooks;

        $hooks->registerHandler('register', 'menu:title', __NAMESPACE__ . '\Menus::titleRegister');

    }
}