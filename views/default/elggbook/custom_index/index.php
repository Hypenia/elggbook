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

// Send logged in users to profile page
if (elgg_is_logged_in()) {

    // forward to the user’s profile:
    $user = elgg_get_logged_in_user_entity();
    forward($user->getURL());
}

?>

<style>
  .elgg-page-default .elgg-page-body > .elgg-inner {
    padding: 0px;
  }
  .elgg-page-topbar > .elgg-inner {
    visibility: hidden;
  }
  .elgg-menu-login > .elgg-menu-item-register {
    display: none;
  }
</style>

<div class="custom-index elgg-main elgg-grid clearfix">
  <div class="col-head">
    <div class="col-head-left">

      <?php
        // Site Name
        $site = elgg_get_site_entity();
        echo elgg_format_element('h3',  [
              'class' => 'elgg-heading-site'
            ],
            elgg_view('output/url',
                [
                  'text' => $site->getDisplayName(),
                ]
            )
        );
      ?>

    </div>
    <div class="col-head-right">

      <?= elgg_view_form('login'); ?>

    </div>
  </div>
  <div class="elgg-col elgg-col-1of2 custom-index-col1">
    <div class="elgg-inner">
      <div class="index-col1-head">

        <?= elgg_echo('welcome:guest'); ?>

      </div>
      <div class="index-center-content">
        <div class="index-col1-left">
          <h1>Sign Up</h1>

            <?= elgg_view_form('register'); ?>

        </div>
      </div>
    </div>
  </div>
  <div class="elgg-col elgg-col-1of2 custom-index-col2">
    <div class="elgg-inner">
      <div class="index-col2-right">

        <?php
          // map image
          echo elgg_format_element('img',
              [
                'src' => elgg_get_simplecache_url('elggbook/images/map.png'),
                'alt' => 'map',
                'class' => 'map-icon',
              ]
          );
        ?>
      </div>
    </div>
  </div>
</div>
