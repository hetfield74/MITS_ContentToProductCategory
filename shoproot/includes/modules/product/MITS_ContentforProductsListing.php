<?php
/**
 * --------------------------------------------------------------
 * File: MITS_ContentforProductsandCategories.php
 * Date: 25.04.2022
 * Time: 12:06
 *
 * Author: Hetfield
 * Copyright: (c) 2022 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

class MITS_ContentforProductsListing
{
    public $code;
    public $name;
    public $version;
    public $sort_order;
    public $title;
    public $description;
    public $enabled = false;
    private $_check = null;

    function __construct()
    {
        $this->code = 'MITS_ContentforProductsListing';
        $this->name = 'MODULE_PRODUCT_' . strtoupper($this->code);
        $this->version = '1.0.3';
        $this->title = defined($this->name . '_TITLE') ? constant($this->name . '_TITLE') . ' - v' . $this->version : $this->code . ' - v' . $this->version;
        $this->description = defined($this->name . '_DESCRIPTION') ? constant($this->name . '_DESCRIPTION') : '';
        $this->enabled = defined($this->name . '_STATUS') && constant($this->name . '_STATUS') == 'true';
        $this->sort_order = defined($this->name . '_SORT_ORDER') ? constant($this->name . '_SORT_ORDER') : '';

        $version_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = '" . $this->name . "_VERSION'");
        if (xtc_db_num_rows($version_query)) {
            xtc_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . $this->version . "' WHERE configuration_key = '" . $this->name . "_VERSION'");
        } elseif (defined($this->name . '_STATUS')) {
            xtc_db_query(
              "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_VERSION', '" . $this->version . "', 6, 99, NULL, now())"
            );
        }
    }

    function check()
    {
        if (!isset($this->_check)) {
            if (defined($this->name . '_STATUS')) {
                $this->_check = true;
            } else {
                $check_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = '" . $this->name . "_STATUS'");
                $this->_check = xtc_db_num_rows($check_query);
            }
        }
        return $this->_check;
    }

    function keys()
    {
        defined($this->name . '_STATUS_TITLE') || define($this->name . '_STATUS_TITLE', TEXT_DEFAULT_STATUS_TITLE);
        defined($this->name . '_STATUS_DESC') || define($this->name . '_STATUS_DESC', TEXT_DEFAULT_STATUS_DESC);
        defined($this->name . '_SORT_ORDER_TITLE') || define($this->name . '_SORT_ORDER_TITLE', TEXT_DEFAULT_SORT_ORDER_TITLE);
        defined($this->name . '_SORT_ORDER_DESC') || define($this->name . '_SORT_ORDER_DESC', TEXT_DEFAULT_SORT_ORDER_DESC);

        return array(
          $this->name . '_STATUS',
          $this->name . '_SORT_ORDER',
        );
    }

    function install()
    {
        xtc_db_query(
          "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_STATUS', 'true', 6, 1,'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())"
        );
        xtc_db_query(
          "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('" . $this->name . "_SORT_ORDER', '10', 6, 2, now())"
        );
        xtc_db_query(
          "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_VERSION', '" . $this->version . "', 6, 99, NULL, now())"
        );
    }

    function remove()
    {
        xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key LIKE '" . $this->name . "_%'");
    }

    function buildDataArray($productData, $array, $products_price)
    {
        global $main;

        if (defined($this->name . '_STATUS') && constant($this->name . '_STATUS') == 'true'
          && isset($array['mits_contentsite_coid']) && isset($array['mits_contentsite_coid'])
        ) {
            $productContent = array();
            $mits_contentsites = explode(',', $array['mits_contentsite_coid']);
            if (is_array($mits_contentsites) && sizeof($mits_contentsites) > 0) {
                $mits_content_counter = 1;
                $mit_get_cactive = defined('MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_ONLY_ACTIVE') && MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_ONLY_ACTIVE == 'true' ? true : false;
                foreach ($mits_contentsites as $mits_prod_content) {
                    $mits_content_data = $main->getContentData($mits_prod_content, '', '', $mit_get_cactive);
                    if (is_array($mits_content_data) && sizeof($mits_content_data) > 0) {
                        $mits_content_heading = isset($mits_content_data['content_heading']) && $mits_content_data['content_heading'] != '' ? $mits_content_data['content_heading'] : $mits_content_data['content_title'];
                        if ($mits_content_counter == 1) {
                            $productContent['MITS_CONTENT_ID'] = $mits_prod_content;
                            $productContent['MITS_CONTENT_HEADING'] = $mits_content_heading;
                            $productContent['MITS_CONTENT_TEXT'] = $mits_content_data['content_text'];
                        }
                        $productContent['MITS_CONTENT_ID_' . $mits_content_counter] = $mits_prod_content;
                        $productContent['MITS_CONTENT_HEADING_' . $mits_content_counter] = $mits_content_heading;
                        $productContent['MITS_CONTENT_TEXT_' . $mits_content_counter] = $mits_content_data['content_text'];
                        $mits_prod_content_data[$mits_content_counter]['MITS_CONTENT_ID'] = $mits_prod_content;
                        $mits_prod_content_data[$mits_content_counter]['MITS_CONTENT_HEADING'] = $mits_content_heading;
                        $mits_prod_content_data[$mits_content_counter]['MITS_CONTENT_TEXT'] = $mits_content_data['content_text'];
                        $productContent['mits_content_data'] = $mits_prod_content_data;
                    }
                    $mits_content_counter++;
                }
            }
            $productData = array_merge($productData, $productContent);
        }

        return $productData;
    }

}
