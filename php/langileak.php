<?php
   $arauak = new DOMDocument();
   $arauak ->load("../XML/langileak.xsl");

   $datuak = new DOMDocument();
   $datuak->load("../XML/Datuak.xml");

   $proc = new XSLTProcessor();
   $proc->importStylesheet($arauak);

   echo $proc->transformToXML($datuak);
?>