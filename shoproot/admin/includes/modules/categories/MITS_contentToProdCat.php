<?php
/**
 * --------------------------------------------------------------
 * File: MITS_contentToProdCat.php
 * Date: 07.08.2022
 * Time: 18:29
 *
 * Author: Hetfield
 * Copyright: (c) 2020 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

class MITS_contentToProdCat
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
        $this->code = 'MITS_contentToProdCat';
        $this->name = 'MODULE_CATEGORIES_' . strtoupper($this->code);
        $this->version = '1.0.1';
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
            if (defined($this->name . '_STATUS') && !defined('RUN_MODE_ADMIN')) {
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
          $this->name . '_ONLY_ACTIVE',
        );
    }

    function install()
    {
        xtc_db_query(
          "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_STATUS', 'true','6', '1','xtc_cfg_select_option(array(\'true\', \'false\'), ', now())"
        );
        xtc_db_query(
          "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('" . $this->name . "_SORT_ORDER', '10','6', '3', now())"
        );
        xtc_db_query(
          "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_VERSION', '" . $this->version . "', 6, 99, NULL, now())"
        );
        xtc_db_query(
          "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_ONLY_ACTIVE', 'false','6', '1','xtc_cfg_select_option(array(\'true\', \'false\'), ', now())"
        );
        xtc_db_query("ALTER TABLE " . TABLE_PRODUCTS . " ADD mits_contentsite_coid VARCHAR(255) NULL");
        xtc_db_query("ALTER TABLE " . TABLE_CATEGORIES . " ADD mits_contentsite_coid VARCHAR(255) NULL");
    }

    function remove()
    {
        xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key LIKE '" . $this->name . "_%'");
        //xtc_db_query("ALTER TABLE " . TABLE_PRODUCTS . " DROP mits_contentsite_coid");
        //xtc_db_query("ALTER TABLE " . TABLE_CATEGORIES . " DROP mits_contentsite_coid");
    }

    function insert_product_before($sql_data_array, $products_data)
    {
        if (isset($products_data['mits_contentsites_coids']) && !empty($products_data['mits_contentsites_coids'])) {
            $mits_contentsites_coids = array_filter($products_data['mits_contentsites_coids'], function($value) {
                return !is_null($value) && !empty($value);
            });
            $content_id_string = implode(',', $mits_contentsites_coids);
            $content_id_string = str_replace(',,', ',', $content_id_string);
            $sql_data_array['mits_contentsite_coid'] = xtc_db_input($content_id_string);
        }

        return $sql_data_array;
    }

    function insert_category_before($sql_data_array, $categories_data)
    {
        if (isset($categories_data['mits_contentsites_coids']) && !empty($categories_data['mits_contentsites_coids'])) {
            $mits_contentsites_coids = array_filter($categories_data['mits_contentsites_coids'], function($value) {
                return !is_null($value) && !empty($value);
            });
            $content_id_string = implode(',', $mits_contentsites_coids);
            $content_id_string = str_replace(',,', ',', $content_id_string);
            $sql_data_array['mits_contentsite_coid'] = xtc_db_input($content_id_string);
        }

        return $sql_data_array;
    }

}