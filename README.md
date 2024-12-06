# MITS Content Artikel und Kategorien für modified eCommerce Shopsoftware
(c) Copyright 2022 by Hetfield - MerZ IT-SerVice

- Author: 	Hetfield - https://www.merz-it-service.de
- Version: 	ab modified eCommerce Shopsoftware ab der Version 2.0.7.0

<hr />

Das Modul ermöglicht das einfache Hinzufügen von beliebig vielen Content-Seiten bei Artikeln und Kategorien. 
So können sie bequem in der Bearbeitungsmaske von Artikeln und Kategorien die Seiten aus dem Content-Manager per Dropdown zuweisen. 
Die Ausgabe erfolgt über verschiedene Smarty-Variablen, die je nach Wunsch in die entsprechenden Template-Vorlagen integriert werden.

<hr />

## Lizenzinformationen:

Diese Erweiterung ist unter der GNU/GPL lizensiert. Eine Kopie der Lizenz liegt diesem Modul bei
oder kann unter der URL http://www.gnu.org/licenses/gpl-2.0.txt heruntergeladen werden. Die
Copyrighthinweise müssen erhalten bleiben, bzw. mit eingebaut werden. Zuwiderhandlungen verstoßen
gegen das Urheberrecht und die GPL und werden zivil- und strafrechtlich verfolgt!

<hr />

## Anleitung für das Modul MITS Content für Artikel und Kategorien

### Installation

Systemvoraussetzung: Funktionsfähige modified eCommerce Shopsoftware ab der Version 2.0.7.0

Vor der Installation des Moduls sichern sie bitte komplett ihre aktuelle Shopinstallation (Dateien und Datenbank)!
Für eventuelle Schäden übernehmen wir keine Haftung!
Die Installation und Nutzung des Moduls **MITS Content für Artikel und Kategorien** erfolgt auf eigene Gefahr!

Die Installation des Modul **MITS Content für Artikel und Kategorien** ist ziemlich einfach.

1. Führen Sie zuerst eine komplette Sicherung des Shops durch. Sichern Sie dabei die Datenbank und alle Dateien Ihrer Shopinstallation. 

2. Falls der admin-Order des Shops unbenannt wurde, dann entsprechend auch den Ordner *admin* im Verzeichnis shoproot des Moduls vor dem Hochladen ebenfalls entsprechend umbenennen!

3. Kopieren Sie anschließend einfach alle Dateien in dem Verzeichnis *shoproot* aus dem Modulpaket  in das Hauptverzeichnis ihrer bestehenden modified eCommerce Shopsoftware Installation. 
   Es werden dabei keine Dateien überschrieben!

4. Wechseln sie in den Administrationsbereich und rufen sie den Menüpunkt Module -> Klassenerweiterungen Module auf und wechseln Sie in den Reiter *Kategorien* (categories).

5. Markieren sie dort den Eintrag 
   ***MITS Content für Artikel und Kategorien © by Hetfield (MerZ IT-SerVice)*** / *MITS_contentToProdCat*
   und klicken sie dann auf der rechten Seite auf den Button Installieren. Das Modul wird nun komplett installiert. 
       
6. Konfigurieren sie nun das Modul nach ihren Wünschen. Die verschiedenen Einstellmöglichkeiten sind im Modul erklärt.

7. OPTIONAL: Rufen Sie den Menüpunkt Module -> Klassenerweiterungen Module auf und wechseln Sie in den Reiter *Artikel* (product).

8. Markieren sie dort den Eintrag 
   ***MITS Content für Artikel und Kategorien © by Hetfield (MerZ IT-SerVice)*** / *MITS_ContentforProductsListing*
   und klicken sie dann auf der rechten Seite auf den Button Installieren. 
   Das Klassenerweiterungs-Modul wird nun komplett installiert.
       
9. Erweitern sie ihre Template-Vorlagen nach ihren eigenen Bedürfnissen. 
   Diese finden sie im innerhalb der Ordnerstruktur ihres Templates innnerhalb des Ordners module in den folgenden Unterordnern:
   categorie_listing, product_info und product_listing (optional für Artikellisten auch im Ordner includes die entsprechenden Artikel-Vorlagen).
   Sie können die Content-Seiten entsprechend der Nummerierung mit folgender Smarty-Syntax einzeln in den Templatevorlagen beliebig platzieren.
  
       {if isset($MITS_CONTENT_HEADING_1) && $MITS_CONTENT_HEADING_1 != ''}<h3>{$MITS_CONTENT_HEADING_1}</li>{/if}
       {if isset($MITS_CONTENT_TEXT_1) && $MITS_CONTENT_TEXT_1 != ''}<div class="pd_description">{$MITS_CONTENT_TEXT_1}</div>{/if}

       {if isset($MITS_CONTENT_HEADING_2) && $MITS_CONTENT_HEADING_2 != ''}<h3>{$MITS_CONTENT_HEADING_2}</h3>{/if}		
       {if isset($MITS_CONTENT_TEXT_2) && $MITS_CONTENT_TEXT_2 != ''}<div class="pd_description">{$MITS_CONTENT_TEXT_2}</div>{/if}

   ... usw.
 
   Möglich ist auch folgende Variante, bei der direkt Content-Seiten dynamisch aus einem Array aufgelistet werden:

       {if isset($mits_content_data) && count($mits_content_data) > 0}
         {foreach item=content_data from=$mits_content_data}
           <h3>{$content_data.MITS_CONTENT_HEADING}</h3>
           <div class="cat_description cf">{$content_data.MITS_CONTENT_TEXT}</div>
         {/foreach}
       {/if}

   Dies ist z.B. sinnvoll in der Artikeldetailansicht, um die Tabreiter dynamisch damit zu befüllen.

10. Fertig!

<hr />

Wir hoffen, das Modul **MITS Content für Artikel und Kategorien** für die modified eCommerce Shopsoftware gefällt ihnen!
Benötigen sie Unterstützung bei der individuellen Anpassung des Moduls oder haben sie eventuell doch Probleme beim Einbau?
Gerne können sie unseren kostenpflichtigen Support in Anspruch nehmen.
Kontaktieren sie uns einfach unter <a href="https://www.merz-it-service.de/Kontakt.html">info(at)merz-it-service.de</a>

<hr />

<img src="https://www.merz-it-service.de/images/logo.png" alt="MerZ IT-SerVice" title="MerZ IT-SerVice" />

**MerZ IT-SerVice** Nicole Grewe - Am Berndebach 35a - D-57439 Attendorn
Telefon: 0 27 22 - 63 13 63 - Telefax: 0 27 22 - 63 14 00
E-Mail: <a href="https://www.merz-it-service.de/Kontakt.html">Info(at)MerZ-IT-SerVice.de</a> - Internet: <a href="https://www.merz-it-service.de">www.MerZ-IT-SerVice.de</a>

<hr />
