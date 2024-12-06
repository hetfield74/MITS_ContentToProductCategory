<?php
/**
 * --------------------------------------------------------------
 * File: MITS_ContentToProductCategory.php
 * Date: 25.04.2022
 * Time: 16:14
 *
 * Author: Hetfield
 * Copyright: (c) 2022 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

if (defined('MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_STATUS') && MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_STATUS == 'true') {
    $add_select_product[] = $add_select_search[] = $add_select_default[] = 'p.mits_contentsite_coid';
    $add_select_categories[] = 'c.mits_contentsite_coid';
}