<?php
/**
 * --------------------------------------------------------------
 * File: 00_MITS_ContentToCategory.php
 * Date: 05.12.2024
 * Time: 20:17
 *
 * Author: Hetfield
 * Copyright: (c) 2024 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

if (defined('MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_STATUS') && MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_STATUS == 'true'
  && isset($category['mits_contentsite_coid']) && isset($category['mits_contentsite_coid'])
) {
    $mits_contentsites = explode(',', $category['mits_contentsite_coid']);
    if (is_array($mits_contentsites) && sizeof($mits_contentsites) > 0) {
        $mits_content_counter = 1;
        foreach ($mits_contentsites as $mits_prod_content) {
            $content_data = $main->getContentData($mits_prod_content, '', '', false);
            $mits_content_heading = isset($content_data['content_heading']) && $content_data['content_heading'] != '' ? $content_data['content_heading'] : $content_data['content_title'];
            if ($mits_content_counter == 1) {
                $default_smarty->assign('MITS_CONTENT_ID', $mits_prod_content);
                $default_smarty->assign('MITS_CONTENT_HEADING', $mits_content_heading);
                $default_smarty->assign('MITS_CONTENT_TEXT', $content_data['content_text']);
            }
            $default_smarty->assign('MITS_CONTENT_ID_' . $mits_content_counter, $mits_prod_content);
            $default_smarty->assign('MITS_CONTENT_HEADING_' . $mits_content_counter, $mits_content_heading);
            $default_smarty->assign('MITS_CONTENT_TEXT_' . $mits_content_counter, $content_data['content_text']);
            $mits_prod_content_data[$mits_content_counter]['MITS_CONTENT_ID'] = $mits_prod_content;
            $mits_prod_content_data[$mits_content_counter]['MITS_CONTENT_HEADING'] = $mits_content_heading;
            $mits_prod_content_data[$mits_content_counter]['MITS_CONTENT_TEXT'] = $content_data['content_text'];
            $mits_content_counter++;
        }
    }
}