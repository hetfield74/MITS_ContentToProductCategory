<?php
/**
 * --------------------------------------------------------------
 * File: MITS_ContentToProductCategory.php
 * Date: 06.12.2024
 * Time: 10:23
 *
 * Author: Hetfield
 * Copyright: (c) 2024 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

function mits_content_dropdown($dropdownname, $actual_coID = '')
{
    $content_array = array(array('id' => '', 'text' => TEXT_NONE));
    $content_query = xtc_db_query(
      "SELECT content_group, 
                  content_title 
             FROM " . TABLE_CONTENT_MANAGER . " 
            WHERE languages_id = " . (int)$_SESSION['languages_id'] . "
         GROUP BY content_group"
    );
    while ($content = xtc_db_fetch_array($content_query)) {
        $content_array[] = array(
          'id'   => $content['content_group'],
          'text' => $content['content_title'] . ' (coID: ' . $content['content_group'] . ')'
        );
    }
    return xtc_draw_pull_down_menu($dropdownname, $content_array, $actual_coID, 'style="width: 95%"');
}
