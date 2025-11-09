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
    public string $code;
    public string $name;
    public string $version;
    public mixed $sort_order;
    public string $title;
    public string $description;
    public mixed $do_update;
    public bool $enabled;
    private bool $_check;

    public function __construct()
    {
        $this->code = 'MITS_ContentforProductsListing';
        $this->name = 'MODULE_PRODUCT_' . strtoupper($this->code);
        $this->version = '1.0.5';
        $this->sort_order = defined($this->name . '_SORT_ORDER') ? constant($this->name . '_SORT_ORDER') : 0;
        $this->enabled = defined($this->name . '_STATUS') && (constant($this->name . '_STATUS') == 'true');

        if (defined($this->name . '_VERSION') && $this->version != constant($this->name . '_VERSION')) {
            $this->do_update = (defined($this->name . '_UPDATE_AVAILABLE_TITLE')) ? constant($this->name . '_UPDATE_AVAILABLE_TITLE') : '';
        } else {
            $this->do_update = '';
        }

        $this->title = (defined($this->name . '_TITLE') ? constant($this->name . '_TITLE') : $this->code) . ' - v' . $this->version . $this->do_update;
        $this->description = '';
        if ($this->do_update != '') {
            $this->description .= '<a class="button btnbox but_green" style="text-align:center;" onclick="this.blur();" href="' . xtc_href_link(FILENAME_MODULES, 'set=' . $_GET['set'] . '&module=' . $this->code . '&action=update') . '">' . constant($this->name . '_UPDATE_MODUL') . '</a><br>';
        }
        $this->description .= defined($this->name . '_DESCRIPTION') ? constant($this->name . '_DESCRIPTION') . '<hr style="margin:10px 0">' : '';

        if (!$this->enabled) {
            $this->description .= '<div style="text-align:center;margin:30px 0"><a class="button but_red" style="text-align:center;" onclick="return confirmLink(\'' . constant($this->name . '_CONFIRM_DELETE_MODUL') . '\', \'\' ,this);" href="' . xtc_href_link(FILENAME_MODULES, 'set=product&module=' . $this->code . '&action=custom') . '">' . constant(
                $this->name . '_DELETE_MODUL'
              ) . '</a></div><br>';
        }
    }

    /**
     * @return true
     */
    public function check(): bool
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


    /**
     * @return void
     */
    public function update(): void
    {
        global $messageStack;

        $prodcode = 'MITS_ContentforProductsListing';
        $prodname = 'MODULE_PRODUCT_' . strtoupper($prodcode);

        xtc_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . $this->version . "' WHERE configuration_key = '" . $this->name . "_VERSION'");
        xtc_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . $this->version . "' WHERE configuration_key = '" . $prodname . "_VERSION'");

        if (!$this->columnExists(TABLE_PRODUCTS, 'mits_contentsite_coid')) {
            xtc_db_query("ALTER TABLE " . TABLE_PRODUCTS . " ADD mits_contentsite_coid VARCHAR(255) NULL");
        }

        if (!$this->columnExists(TABLE_CATEGORIES, 'mits_contentsite_coid')) {
            xtc_db_query("ALTER TABLE " . TABLE_CATEGORIES . " ADD mits_contentsite_coid VARCHAR(255) NULL");
        }

        $this->removeOldFiles();

        $messageStack->add_session(constant($this->name . '_UPDATE_FINISHED'), 'success');
    }

    /**
     * @return void
     */
    public function custom(): void
    {
        global $messageStack;

        $this->remove();

        xtc_db_query("ALTER TABLE " . TABLE_PRODUCTS . " DROP mits_contentsite_coid");
        xtc_db_query("ALTER TABLE " . TABLE_CATEGORIES . " DROP mits_contentsite_coid");

        $this->removeModulfiles();

        $messageStack->add_session(constant($this->name . '_DELETE_FINISHED'), 'success');
    }

    /**
     * @return string[]
     */
    public function keys(): array
    {
        defined($this->name . '_STATUS_TITLE') || define($this->name . '_STATUS_TITLE', TEXT_DEFAULT_STATUS_TITLE);
        defined($this->name . '_STATUS_DESC') || define($this->name . '_STATUS_DESC', TEXT_DEFAULT_STATUS_DESC);
        defined($this->name . '_SORT_ORDER_TITLE') || define($this->name . '_SORT_ORDER_TITLE', TEXT_DEFAULT_SORT_ORDER_TITLE);
        defined($this->name . '_SORT_ORDER_DESC') || define($this->name . '_SORT_ORDER_DESC', TEXT_DEFAULT_SORT_ORDER_DESC);

        $key = array(
          $this->name . '_STATUS',
          $this->name . '_SORT_ORDER',
        );

        return $key;
    }

    /**
     * @return void
     */
    public function install(): void
    {
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_STATUS', 'true', 6, 1,'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('" . $this->name . "_SORT_ORDER', '10', 6, 2, now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_VERSION', '" . $this->version . "', 6, 99, NULL, now())");

        if (!$this->columnExists(TABLE_PRODUCTS, 'mits_contentsite_coid')) {
            xtc_db_query("ALTER TABLE " . TABLE_PRODUCTS . " ADD mits_contentsite_coid VARCHAR(255) NULL");
        }

        if (!$this->columnExists(TABLE_CATEGORIES, 'mits_contentsite_coid')) {
            xtc_db_query("ALTER TABLE " . TABLE_CATEGORIES . " ADD mits_contentsite_coid VARCHAR(255) NULL");
        }
    }

    /**
     * @return void
     */
    public function remove(): void
    {
        xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key in ('" . implode("', '", $this->keys()) . "')");
        xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key LIKE '" . $this->name . "_%'");

        $cat_modul_code = 'MITS_contentToProdCat';
        if (defined('MODULE_CATEGORIES_' . strtoupper($cat_modul_code) . '_STATUS')) {
            $o_installed_array = explode(';', MODULE_CATEGORIES_INSTALLED);
            $installed_array = array();
            foreach ($o_installed_array as $value) {
                if ($value != $cat_modul_code . '.php') {
                    $installed_array[] = $value;
                }
            }
            xtc_db_perform(TABLE_CONFIGURATION, array('configuration_value' => implode(';', $installed_array)), 'update', "`configuration_key` = 'MODULE_CATEGORIES_INSTALLED'");
            xtc_redirect(xtc_href_link(FILENAME_MODULES, 'set=categories&module=' . $cat_modul_code . '&action=removeconfirm'));
        }
    }


    /**
     * @param $table
     * @param $column
     * @return bool
     */
    private function columnExists($table, $column): bool
    {
        $res = xtc_db_query("SHOW COLUMNS FROM {$table} LIKE '{$column}'");
        return xtc_db_num_rows($res) > 0;
    }


    /**
     * @return void
     */
    protected function removeOldFiles(): void
    {
        $old_files_array = array();

        if (count($old_files_array) > 0) {
            foreach ($old_files_array as $delete_file) {
                if (is_file($delete_file)) {
                    unlink($delete_file);
                }
            }
        }
    }


    /**
     * @return void
     */
    protected function removeModulfiles(): void
    {
        $remove_files_array = array(
          DIR_FS_DOCUMENT_ROOT . (defined('DIR_ADMIN') ? DIR_ADMIN : 'admin/') . 'includes/modules/categories/cat_mits_embedded_videos.php',
          DIR_FS_DOCUMENT_ROOT . (defined('DIR_ADMIN') ? DIR_ADMIN : 'admin/') . 'includes/extra/css/MITS_ContentToProductCategory.php',
          DIR_FS_DOCUMENT_ROOT . (defined('DIR_ADMIN') ? DIR_ADMIN : 'admin/') . 'includes/extra/functions/MITS_ContentToProductCategory.php',
          DIR_FS_DOCUMENT_ROOT . (defined('DIR_ADMIN') ? DIR_ADMIN : 'admin/') . 'includes/extra/modules/add_db_fields/MITS_ContentToProductCategory.php',
          DIR_FS_DOCUMENT_ROOT . (defined('DIR_ADMIN') ? DIR_ADMIN : 'admin/') . 'includes/extra/modules/new_category/00_MITS_ContentToCategory.php',
          DIR_FS_DOCUMENT_ROOT . (defined('DIR_ADMIN') ? DIR_ADMIN : 'admin/') . 'includes/extra/modules/new_product/00_MITS_ContentToProduct.php',
          DIR_FS_DOCUMENT_ROOT . 'lang/english/extra/admin/MITS_ContentToProductCategory.php',
          DIR_FS_DOCUMENT_ROOT . 'lang/german/extra/admin/MITS_ContentToProductCategory.php',
          DIR_FS_DOCUMENT_ROOT . 'images/merz-it-service.png',
          DIR_FS_DOCUMENT_ROOT . 'includes/extra/default/categories_content/MITS_ContentToCategory.php',
          DIR_FS_DOCUMENT_ROOT . 'includes/extra/default/categories_content/MITS_ContentToCategory.php',
          DIR_FS_DOCUMENT_ROOT . 'includes/extra/define_add_select/MITS_ContentToProductCategory.php',
          DIR_FS_DOCUMENT_ROOT . 'includes/extra/modules/product_info_end/MITS_ContentToProduct.php',
          DIR_FS_DOCUMENT_ROOT . 'includes/extra/modules/product_listing_begin/MITS_ContentToCategory.php',
          DIR_FS_DOCUMENT_ROOT . 'includes/modules/product/MITS_ContentforProductsListing.php',
        );

        foreach ($remove_files_array as $delete_file) {
            if (is_file($delete_file)) {
                unlink($delete_file);
            }
        }

    }

    /**
     * @param $productData
     * @param $array
     * @param $products_price
     * @return array|mixed
     */
    public function buildDataArray($productData, $array, $products_price): mixed
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
