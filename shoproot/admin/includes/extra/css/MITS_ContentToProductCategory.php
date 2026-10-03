<?php
/**
 * --------------------------------------------------------------
 * File: MITS_ContentToProductCategory.php
 * Date: 02.10.2026
 *
 * Author: Hetfield
 * Copyright: (c) 2026 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */
?>
<style>
  #mits_content_for_product,
  #mits_content_for_category {
    --mits-ctp-primary: #66aa99;
    --mits-ctp-primary-dark: #4f8e7e;
    --mits-ctp-soft: #edf7f4;
    --mits-ctp-soft2: #f7fbfa;
    --mits-ctp-line: #d4e7e0;
    --mits-ctp-line-strong: #b9d6cb;
    --mits-ctp-heading: #30534b;
    --mits-ctp-text: #444;
    --mits-ctp-muted: #6d7b77;
    --mits-ctp-shadow: rgba(76, 110, 101, .10);

    margin: 20px 0;
    border: 1px solid var(--mits-ctp-line);
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 8px 22px var(--mits-ctp-shadow);
    color: var(--mits-ctp-text);
    font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    font-size: 14px;
    line-height: 1.45;
    overflow: visible;
  }

  #mits_content_for_product *,
  #mits_content_for_category * {
    box-sizing: border-box;
  }

  #mits_content_for_product .div_header,
  #mits_content_for_category .div_header {
    margin: 0;
    padding: 14px 16px;
    border-radius: 15px;
    background: linear-gradient(135deg, var(--mits-ctp-soft2) 0%, var(--mits-ctp-soft) 100%);
    color: var(--mits-ctp-heading);
    font-size: 15px;
    font-weight: 700;
  }

  #mits_content_for_product .mits_content_head,
  #mits_content_for_category .mits_content_head {
    cursor: pointer;
    user-select: none;
  }

  #mits_content_for_product .mits_content_dropdowns,
  #mits_content_for_category .mits_content_dropdowns {
    padding: 0 16px 14px;
    overflow: visible;
  }

  #mits_content_for_product .tableInput,
  #mits_content_for_category .tableInput {
    width: 100%;
    margin: 0;
    border: 0;
    border-collapse: collapse;
    background: #fff;
  }

  #mits_content_for_product .mits-content-row + .mits-content-row,
  #mits_content_for_category .mits-content-row + .mits-content-row {
    border-top: 1px solid var(--mits-ctp-line);
  }

  #mits_content_for_product .mits-content-row > td,
  #mits_content_for_category .mits-content-row > td {
    padding: 10px 8px;
    background: #fff;
    vertical-align: middle;
  }

  #mits_content_for_product .mits-content-label-cell,
  #mits_content_for_category .mits-content-label-cell {
    width: 260px;
    color: var(--mits-ctp-heading);
    font-weight: 600;
  }

  #mits_content_for_product .mits-content-dropdown-row,
  #mits_content_for_category .mits-content-dropdown-row {
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;
    min-width: 0;
    overflow: visible;
  }

  #mits_content_for_product .mits-content-select,
  #mits_content_for_category .mits-content-select {
    flex: 1 1 auto;
    width: 100%;
    min-width: 0;
    max-width: 560px;
    min-height: 38px;
    padding: 7px 10px;
    border: 1px solid var(--mits-ctp-line-strong);
    border-radius: 10px;
    background: #fff;
    color: var(--mits-ctp-text);
    font: inherit;
  }

  #mits_content_for_product .mits-content-select:focus,
  #mits_content_for_category .mits-content-select:focus {
    border-color: var(--mits-ctp-primary-dark);
    box-shadow: 0 0 0 3px rgba(102, 170, 153, .16);
    outline: none;
  }

  .mits-html-code {
    display: block;
    max-width: 100%;
    overflow: auto;
    padding: 8px 10px;
    border: 1px solid var(--mits-ctp-line, #d4e7e0);
    border-radius: 8px;
    background: var(--mits-ctp-soft, #edf7f4);
    color: var(--mits-ctp-heading, #30534b);
  }

  #mits_content_for_product .mits-content-tooltip,
  #mits_content_for_category .mits-content-tooltip {
    position: relative;
    z-index: 20;
    display: inline-flex;
    flex: 0 0 auto;
    align-items: center;
    justify-content: center;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    cursor: help;
    outline: none;
  }

  #mits_content_for_product .mits-content-tooltip > img,
  #mits_content_for_category .mits-content-tooltip > img {
    display: block;
    width: 18px;
    height: 18px;
    max-width: 18px;
    max-height: 18px;
    border: 0;
    object-fit: contain;
    opacity: .85;
  }

  #mits_content_for_product .mits-content-tooltip:hover > img,
  #mits_content_for_product .mits-content-tooltip:focus > img,
  #mits_content_for_category .mits-content-tooltip:hover > img,
  #mits_content_for_category .mits-content-tooltip:focus > img {
    opacity: 1;
  }

  #mits_content_for_product .mits-content-tooltip > em,
  #mits_content_for_category .mits-content-tooltip > em {
    position: absolute;
    z-index: 10050;
    top: 50%;
    left: calc(100% + 10px);
    display: none;
    width: max-content;
    min-width: 260px;
    max-width: 420px;
    padding: 12px 14px;
    border: 1px solid var(--mits-ctp-line);
    border-radius: 12px;
    background: #fff;
    box-shadow: 0 8px 22px var(--mits-ctp-shadow);
    color: var(--mits-ctp-text);
    font-style: normal;
    font-weight: 400;
    line-height: 1.45;
    text-align: left;
    white-space: normal;
    transform: translateY(-50%);
  }

  #mits_content_for_product .mits-content-tooltip:hover > em,
  #mits_content_for_product .mits-content-tooltip:focus > em,
  #mits_content_for_product .mits-content-tooltip:focus-within > em,
  #mits_content_for_category .mits-content-tooltip:hover > em,
  #mits_content_for_category .mits-content-tooltip:focus > em,
  #mits_content_for_category .mits-content-tooltip:focus-within > em {
    display: block;
  }

  #mits_content_for_product .mits-content-tooltip > em::before,
  #mits_content_for_category .mits-content-tooltip > em::before {
    content: "";
    position: absolute;
    top: 50%;
    left: -6px;
    width: 10px;
    height: 10px;
    border-left: 1px solid var(--mits-ctp-line);
    border-bottom: 1px solid var(--mits-ctp-line);
    background: #fff;
    transform: translateY(-50%) rotate(45deg);
  }

  #mits_content_for_product .mits-content-tooltip code,
  #mits_content_for_category .mits-content-tooltip code {
    display: block;
    margin-top: 8px;
    padding: 8px 10px;
    border: 1px solid var(--mits-ctp-line);
    border-radius: 8px;
    background: var(--mits-ctp-soft);
    color: var(--mits-ctp-heading);
    font-family: ui-monospace, SFMono-Regular, Consolas, "Liberation Mono", monospace;
    font-size: 12px;
    line-height: 1.5;
    overflow-wrap: anywhere;
  }

  #mits_content_for_product .toggle_arrow,
  #mits_content_for_product .toggle_arrow_up,
  #mits_content_for_category .toggle_arrow,
  #mits_content_for_category .toggle_arrow_up {
    position: relative;
    float: right;
    width: 20px;
    height: 20px;
    margin-left: 8px;
    background: none;
  }

  #mits_content_for_product .toggle_arrow::before,
  #mits_content_for_product .toggle_arrow_up::before,
  #mits_content_for_category .toggle_arrow::before,
  #mits_content_for_category .toggle_arrow_up::before {
    content: "";
    position: absolute;
    top: 5px;
    left: 6px;
    width: 7px;
    height: 7px;
    border-right: 2px solid var(--mits-ctp-primary-dark);
    border-bottom: 2px solid var(--mits-ctp-primary-dark);
  }

  #mits_content_for_product .toggle_arrow::before,
  #mits_content_for_category .toggle_arrow::before {
    transform: rotate(45deg);
  }

  #mits_content_for_product .toggle_arrow_up::before,
  #mits_content_for_category .toggle_arrow_up::before {
    top: 8px;
    transform: rotate(-135deg);
  }

  @media (max-width: 700px) {
    #mits_content_for_product,
    #mits_content_for_category {
      margin: 14px 0;
      border-radius: 14px;
    }

    #mits_content_for_product .mits_content_dropdowns,
    #mits_content_for_category .mits_content_dropdowns {
      padding: 0 12px 12px;
    }

    #mits_content_for_product .mits-content-row,
    #mits_content_for_product .mits-content-row > td,
    #mits_content_for_category .mits-content-row,
    #mits_content_for_category .mits-content-row > td {
      display: block;
      width: 100% !important;
    }

    #mits_content_for_product .mits-content-label-cell,
    #mits_content_for_category .mits-content-label-cell {
      padding-bottom: 2px;
    }

    #mits_content_for_product .mits-content-row > td:last-child,
    #mits_content_for_category .mits-content-row > td:last-child {
      padding-top: 4px;
    }

    #mits_content_for_product .mits-content-select,
    #mits_content_for_category .mits-content-select {
      max-width: none;
    }

    #mits_content_for_product .mits-content-tooltip > em,
    #mits_content_for_category .mits-content-tooltip > em {
      top: calc(100% + 10px);
      right: 0;
      left: auto;
      width: min(320px, calc(100vw - 32px));
      min-width: 0;
      max-width: calc(100vw - 32px);
      transform: none;
    }

    #mits_content_for_product .mits-content-tooltip > em::before,
    #mits_content_for_category .mits-content-tooltip > em::before {
      top: -6px;
      right: 4px;
      left: auto;
      transform: rotate(135deg);
    }
  }
</style>
