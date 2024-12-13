<?php
/**
 * --------------------------------------------------------------
 * File: MITS_ContentToProductCategory.php
 * Date: 06.12.2024
 * Time: 10:19
 *
 * Author: Hetfield
 * Copyright: (c) 2024 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */
?>
<style>
  #mits_content_for_product,
  #mits_content_for_category {
    margin: 20px auto;
    box-shadow: 0 0 5px 0 #ccc;
    padding: 8px 4px;
    background: #ffe;
  }
  #mits_content_for_product div.mits_head,
  #mits_content_for_category div.mits_head, {
    padding: 10px;
    font-weight: bold;
  }
  #mits_content_for_product .tableInput,
  #mits_content_for_category .tableInput {
    background: #ffe;
  }
  .mits-html-code {
    display: block;
    padding: 6px;
    background: #ffe;
    max-width: 100%;
    overflow: auto;
  }
  .mits_content_head{
    cursor:pointer;
  }
  .toggle_arrow {
    background: url("images/arrow_down.gif") center center no-repeat;
    float: right;
    width: 16px;
    height: 16px;
  }
  .toggle_arrow_up {
    background: url("images/arrow_up.gif") center center no-repeat;
    float: right;
    width: 16px;
    height: 16px;
  }
</style>
