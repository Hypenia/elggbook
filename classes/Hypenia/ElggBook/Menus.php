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

use Elgg\Menu\MenuItems;

class Menus {

    /**
     * Register menu items for the title menu
     *
     * @param \Elgg\Hook $hook 'register', 'menu:title'
     *
     * @return void|\ElggMenuItem[]
     */
    public static function titleRegister(\Elgg\Hook $hook) {
        $user = $hook->getEntityParam();
        if (!($user instanceof \ElggUser) || !$user->canEdit() || !elgg_is_logged_in()) {
            return;
        }

        $return = $hook->getValue();

        $return[] = \ElggMenuItem::factory([
            'name' => 'edit_profile',
            'href' => elgg_generate_entity_url($user, 'edit'),
            'text' => elgg_echo('profile:edit'),
            // 'icon' => 'address-card',
            'icon' => 'user-edit',
            'class' => ['elgg-lightbox', 'elgg-button', 'elgg-button-action'],
            'contexts' => ['profile', 'profile_edit']
        ]);

        if (elgg_is_active_plugin('profile_cover')) {
            $return[] = \ElggMenuItem::factory([
                'name' => 'profile_cover',
                'text' => elgg_echo('profile_cover:menu:edit'),
                'href' => elgg_generate_url('settings:cover', [
                    'username' => $user->username,
                ]),
                'icon' => 'id-card',
                'class' => ['elgg-lightbox', 'elgg-button', 'elgg-button-action'],
                'contexts' => ['profile', 'profile_edit'],
            ]);
        }

        $return[] = \ElggMenuItem::factory([
            'name' => 'avatar:edit',
            'text' => elgg_echo('avatar:edit'),
            'icon' => 'id-badge',
            'class' => ['elgg-lightbox', 'elgg-button', 'elgg-button-action'],
            'href' => elgg_generate_entity_url($user, 'edit', 'avatar'),
        ]);
    
        return $return;
    }

}