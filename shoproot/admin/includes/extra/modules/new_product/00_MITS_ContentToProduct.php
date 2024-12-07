<?php
/**
 * --------------------------------------------------------------
 * File: 00_MITS_ContentToProduct.php
 * Date: 25.04.2022
 * Time: 13:11
 *
 * Author: Hetfield
 * Copyright: (c) 2022 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');

if (defined('MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_STATUS') && MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_STATUS == 'true') {

    $mits_content_dropdowns = '';
    $mits_prod_content_counter = 1;
    if (isset($pInfo->mits_contentsite_coid) && $pInfo->mits_contentsite_coid != '') {
        $mits_prod_content_array = explode(',', $pInfo->mits_contentsite_coid);
        if (is_array($mits_prod_content_array) && sizeof($mits_prod_content_array) > 0) {
            foreach ($mits_prod_content_array as $mits_prod_content) {
                $mits_content_dropdowns .= '
                  <tr>
                    <td style="width:260px;"><span>
                      ' . MITS_CONTENTFORPRODUCTSANDCATEGORIES_TEXT . $mits_prod_content_counter . '
                      </span>
                    </td>
                    <td>
                      <div style="padding:0 0 8px 0;">
                        ' . mits_content_dropdown('mits_contentsites_coids[]', $mits_prod_content) . '
                        <span class="tooltip">
                          <img src="images/icons/tooltip_icon.png" alt="Tooltip" style="border:0;">
                          <em>' . MITS_CONTENTFORPRODUCTSANDCATEGORIES_TOOLTIP . '<code>{$MITS_CONTENT_ID_' . $mits_prod_content_counter .'}<br>{$MITS_CONTENT_HEADING_' . $mits_prod_content_counter .'}<br>{$MITS_CONTENT_TEXT_' . $mits_prod_content_counter .'}</code></em>
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
      <tr>
        <td style="width:260px;">
          <span>
            ' . MITS_CONTENTFORPRODUCTSANDCATEGORIES_TEXT . $mits_prod_content_counter . '
          </span>
        </td>
        <td>
          <div style="padding:0 0 8px 0;">
            ' . mits_content_dropdown('mits_contentsites_coids[]', '') . '
            <span class="tooltip">
              <img src="images/icons/tooltip_icon.png" alt="Tooltip" style="border:0;">
              <em>' . MITS_CONTENTFORPRODUCTSANDCATEGORIES_TOOLTIP . '<code>{$MITS_CONTENT_ID_' . $mits_prod_content_counter .'}<br>{$MITS_CONTENT_HEADING_' . $mits_prod_content_counter .'}<br>{$MITS_CONTENT_TEXT_' . $mits_prod_content_counter .'}</code></em>
            </span>
          </div>
        </td>
      </tr>
    ';
    $mits_content_dropdowns .= $mits_new_content_dropdown;

    ?>
      <div id="mits_content_for_product">
        <div class="main div_header"><?php echo MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_TITLE; ?></div>
        <table class="tableInput border0" id="mits_contentforproduct">
          <?php echo $mits_content_dropdowns; ?>
        </table>
      </div>
    <?php
}
