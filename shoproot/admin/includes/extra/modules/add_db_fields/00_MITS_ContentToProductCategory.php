<?php
/**
 * --------------------------------------------------------------
 * File: 00_MITS_ContentToProductCategory.php
 * Date: 25.04.2022
 * Time: 13:19
 *
 * Author: Hetfield
 * Copyright: (c) 2022 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

defined( '_VALID_XTC' ) or die( 'Direct Access to this location is not allowed.' );

if (defined('MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_STATUS') && MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_STATUS == 'true') {
    $add_products_fields[] = 'mits_contentsite_coid';
}
