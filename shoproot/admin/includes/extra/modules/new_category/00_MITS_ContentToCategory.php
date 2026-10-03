<?php
/**
 * --------------------------------------------------------------
 * File: 00_MITS_ContentToCategory.php
 * Date: 02.10.2026
 *
 * Author: Hetfield
 * Copyright: (c) 2026 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');

if (defined('MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_STATUS') && MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_STATUS == 'true') {
    $mits_content_dropdowns = '';
    $mits_prod_content_counter = 1;

    if (isset($cInfo->mits_contentsite_coid) && $cInfo->mits_contentsite_coid != '') {
        $mits_prod_content_array = explode(',', $cInfo->mits_contentsite_coid);
        if (is_array($mits_prod_content_array) && sizeof($mits_prod_content_array) > 0) {
            foreach ($mits_prod_content_array as $mits_prod_content) {
                $mits_content_dropdowns .= '
                  <tr class="mits-content-row">
                    <td class="mits-content-label-cell">
                      <span class="main">' . MITS_CONTENTFORPRODUCTSANDCATEGORIES_TEXT . $mits_prod_content_counter . '</span>
                    </td>
                    <td>
                      <div class="mits-content-dropdown-row">
                        ' . mits_content_dropdown('mits_contentsites_coids[]', $mits_prod_content) . '
                        <span class="mits-content-tooltip" tabindex="0">
                          <img src="images/icons/tooltip_icon.png" alt="Tooltip">
                          <em>' . MITS_CONTENTFORPRODUCTSANDCATEGORIES_TOOLTIP . '<code>{$MITS_CONTENT_ID_' . $mits_prod_content_counter . '}<br>{$MITS_CONTENT_HEADING_' . $mits_prod_content_counter . '}<br>{$MITS_CONTENT_TEXT_' . $mits_prod_content_counter . '}</code></em>
                        </span>
                      </div>
                    </td>
                  </tr>
                ';
                $mits_prod_content_counter++;
            }
        }
    }

    $mits_new_content_dropdown = '
      <tr class="mits-content-row">
        <td class="mits-content-label-cell">
          <span class="main">' . MITS_CONTENTFORPRODUCTSANDCATEGORIES_TEXT . $mits_prod_content_counter . '</span>
        </td>
        <td>
          <div class="mits-content-dropdown-row">
            ' . mits_content_dropdown('mits_contentsites_coids[]', '') . '
            <span class="mits-content-tooltip" tabindex="0">
              <img src="images/icons/tooltip_icon.png" alt="Tooltip">
              <em>' . MITS_CONTENTFORPRODUCTSANDCATEGORIES_TOOLTIP . '<code>{$MITS_CONTENT_ID_' . $mits_prod_content_counter . '}<br>{$MITS_CONTENT_HEADING_' . $mits_prod_content_counter . '}<br>{$MITS_CONTENT_TEXT_' . $mits_prod_content_counter . '}</code></em>
            </span>
          </div>
        </td>
      </tr>
    ';
    $mits_content_dropdowns .= $mits_new_content_dropdown;

    if ($mits_prod_content_counter > 3) {
        ?>
      <div id="mits_content_for_category">
        <div class="main div_header mits_content_head">
          <?php echo MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_TITLE; ?>
          <div class="toggle_arrow"></div>
        </div>
        <div class="mits_content_dropdowns">
          <table class="tableInput border0" id="mits_contentforcategory">
            <?php echo $mits_content_dropdowns; ?>
          </table>
        </div>
      </div>
      <script>
        $(document).ready(function () {
          $("#mits_content_for_category .mits_content_dropdowns").hide();
          $("#mits_content_for_category .mits_content_head").click(function () {
            $("#mits_content_for_category .mits_content_dropdowns").slideToggle('slow');
            $(this).find(".toggle_arrow, .toggle_arrow_up").toggleClass("toggle_arrow toggle_arrow_up");
          });
        });
      </script>
        <?php
    } else {
        ?>
      <div id="mits_content_for_category">
        <div class="main div_header">
          <?php echo MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_TITLE; ?>
        </div>
        <div class="mits_content_dropdowns">
          <table class="tableInput border0" id="mits_contentforcategory">
            <?php echo $mits_content_dropdowns; ?>
          </table>
        </div>
      </div>
        <?php
    }
}
