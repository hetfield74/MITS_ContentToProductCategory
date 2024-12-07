<?php
/**
 * --------------------------------------------------------------
 * File: MITS_ContentToProductCategory.php
 * Date: 06.12.2024
 * Time: 10:04
 *
 * Author: Hetfield
 * Copyright: (c) 2024 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

$lang_array = array(
  'MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_TITLE'              => 'MITS Content f&uuml;r Artikel und Kategorien  <span style="white-space:nowrap;">&copy; by <span style="padding:2px;background:#ffe;color:#6a9;font-weight:bold;">Hetfield (MerZ IT-SerVice)</span></span>',
  'MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_DESCRIPTION'        => '
    <a href="https://www.merz-it-service.de/" target="_blank">
      <img src="' . (ENABLE_SSL === true ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG . DIR_WS_IMAGES . 'merz-it-service.png" border="0" alt="MerZ IT-SerVice" style="display:block;max-width:100%;height:auto;">
    </a><br>
    <p>Das Modul erm&ouml;glicht das einfache Hinzuf&uuml;gen von beliebig vielen Content-Seiten bei Artikeln und Kategorien. So k&ouml;nnen sie bequem in der Bearbeitungsmaske von Artikeln und Kategorien die Seiten aus dem Content-Manager per Dropdown zuweisen. Die Ausgabe erfolgt &uuml;ber verschiedene Smarty-Variablen, die je nach Wunsch in die entsprechenden Template-Vorlagen integriert werden.</p>
    <p>Es steht z.B. ein Smarty-Array zur Verf&uuml;gung, um die Content-Seiten dynamisch und unabh&auml;ngig von der Anzahl der zugewiesenen Content-Seiten anzeigen zu lassen, z.B. als zus&auml;tzliche Tab-Reiter in der Artikeldetailansicht.</p>
    <pre><code class="mits-html-code">
{if isset($mits_content_data) && count($mits_content_data) > 0}
  {foreach item=content_data from=$mits_content_data}
    &lt;h3&gt;{$content_data.MITS_CONTENT_HEADING}&lt;/h3&gt;
    &lt;div class="cat_description cf"&gt;{$content_data.MITS_CONTENT_TEXT}&lt;/div&gt;
  {/foreach}
{/if}
    </code></pre>    
    <p>Es werden aber auch nummerierte Smarty-Variablen erzeugt, um so z.B. die verschiedenen Content-Seiten an unterschiedlichen Positionen platzieren zu k&ouml;nnen.</p>
    <pre><code class="mits-html-code">
{if isset($MITS_CONTENT_HEADING_1) && $MITS_CONTENT_HEADING_1 != \'\'}
  &lt;h3&gt;{$MITS_CONTENT_HEADING_1}&lt;/h3&gt;
{/if}
{if isset($MITS_CONTENT_TEXT_1) && $MITS_CONTENT_TEXT_1 != \'\'}
&lt;div class="pd_description"&gt;{$MITS_CONTENT_TEXT_1}&lt;/div&gt;
{/if}
    </code></pre>
    <div style="text-align:center;">
      <small>Nur auf Github gibt es immer die aktuellste Version des Moduls!</small><br />
      <a style="background:#6a9;color:#444" target="_blank" href="https://github.com/hetfield74/MITS_ContentToProductsAndCategories" class="button" onclick="this.blur();">MITS Content f&uuml;r Artikel und Kategorien on Github</a>
    </div>
    <p>Bei Fragen, Problemen oder W&uuml;nschen zu diesem Modul oder auch zu anderen Anliegen rund um die modified eCommerce Shopsoftware nehmen Sie einfach Kontakt zu uns auf:</p> 
    <div style="text-align:center;"><a style="background:#6a9;color:#444" target="_blank" href="https://www.merz-it-service.de/Kontakt.html" class="button" onclick="this.blur();">Kontaktseite auf MerZ-IT-SerVice.de</strong></a></div>',
  'MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_STATUS_TITLE'       => 'Modul aktivieren?',
  'MODULE_CATEGORIES_MITS_CONTENTTOPRODCAT_STATUS_DESC'        => 'Das Modul MITS Content f&uuml;r Artikel und Kategorien aktivieren',
  'MITS_CONTENTFORPRODUCTSANDCATEGORIES_TEXT'                  => 'Content-Seite Nr.',
  'MITS_CONTENTFORPRODUCTSANDCATEGORIES_TOOLTIP'               => 'Im Template verf&uuml;gbare Smarty-Variablen:<br>',
  'MODULE_PRODUCT_MITS_CONTENTFORPRODUCTSLISTING_TITLE'        => 'MITS Content f&uuml;r Artikel und Kategorien  <span style="white-space:nowrap;">&copy; by <span style="padding:2px;background:#ffe;color:#6a9;font-weight:bold;">Hetfield (MerZ IT-SerVice)</span></span>',
  'MODULE_PRODUCT_MITS_CONTENTFORPRODUCTSLISTING_DESCRIPTION'  => '
    <a href="https://www.merz-it-service.de/" target="_blank">
      <img src="' . (ENABLE_SSL === true ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG . DIR_WS_IMAGES . 'merz-it-service.png" border="0" alt="MerZ IT-SerVice" style="display:block;max-width:100%;height:auto;">
    </a><br>
    <p>Diese Klassenerweiterung ist eine Erweiterung zum Modul <b>MITS Content f&uuml;r Artikel und Kategorien</b> und erm&ouml;glicht die Anzeige der Content-Seiten auch in den Artikellisten der Kategorien.</p>
    <div style="text-align:center;">
      <small>Nur auf Github gibt es immer die aktuellste Version des Moduls!</small><br />
      <a style="background:#6a9;color:#444" target="_blank" href="https://github.com/hetfield74/MITS_ContentToProductsAndCategories" class="button" onclick="this.blur();">MITS Content f&uuml;r Artikel und Kategorien on Github</a>
    </div>
    <p>Bei Fragen, Problemen oder W&uuml;nschen zu diesem Modul oder auch zu anderen Anliegen rund um die modified eCommerce Shopsoftware nehmen Sie einfach Kontakt zu uns auf:</p> 
    <div style="text-align:center;"><a style="background:#6a9;color:#444" target="_blank" href="https://www.merz-it-service.de/Kontakt.html" class="button" onclick="this.blur();">Kontaktseite auf MerZ-IT-SerVice.de</strong></a></div>',
  'MODULE_PRODUCT_MITS_CONTENTFORPRODUCTSLISTING_STATUS_TITLE' => 'Modul aktivieren?',
  'MODULE_PRODUCT_MITS_CONTENTFORPRODUCTSLISTING_STATUS_DESC'  => 'Das Modul MITS Content f&uuml;r Artikel und Kategorien aktivieren',
);

foreach ($lang_array as $key => $val) {
    defined($key) || define($key, $val);
}
