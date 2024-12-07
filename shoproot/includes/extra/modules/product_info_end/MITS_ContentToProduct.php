<?php
/**
 * --------------------------------------------------------------
 * File: MITS_ContentToProduct.php
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
  && isset($product->data['mits_contentsite_coid']) && isset($product->data['mits_contentsite_coid'])
) {
    $mits_contentsites = explode(',', $product->data['mits_contentsite_coid']);
    if (is_array($mits_contentsites) && sizeof($mits_contentsites) > 0) {
        $mits_content_counter = 1;
        foreach ($mits_contentsites as $mits_prod_content) {
            $mits_content_data = $main->getContentData($mits_prod_content, '', '', false);
            if (is_array($mits_content_data) && sizeof($mits_content_data) > 0) {
                $mits_content_heading = isset($mits_content_data['content_heading']) && $mits_content_data['content_heading'] != '' ? $mits_content_data['content_heading'] : $mits_content_data['content_title'];
                if ($mits_content_counter == 1) {
                    $info_smarty->assign('MITS_CONTENT_ID', $mits_prod_content);
                    $info_smarty->assign('MITS_CONTENT_HEADING', $mits_content_heading);
                    $info_smarty->assign('MITS_CONTENT_TEXT', $mits_content_data['content_text']);
                }
                $info_smarty->assign('MITS_CONTENT_ID_' . $mits_content_counter, $mits_prod_content);
                $info_smarty->assign('MITS_CONTENT_HEADING_' . $mits_content_counter, $mits_content_heading);
                $info_smarty->assign('MITS_CONTENT_TEXT_' . $mits_content_counter, $mits_content_data['content_text']);
                $mits_prod_content_data[$mits_content_counter]['MITS_CONTENT_ID'] = $mits_prod_content;
                $mits_prod_content_data[$mits_content_counter]['MITS_CONTENT_HEADING'] = $mits_content_heading;
                $mits_prod_content_data[$mits_content_counter]['MITS_CONTENT_TEXT'] = $mits_content_data['content_text'];
                $info_smarty->assign('mits_content_data', $mits_prod_content_data);
            }
            $mits_content_counter++;
        }
    }
}