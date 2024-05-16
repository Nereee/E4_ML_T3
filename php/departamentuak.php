<?php
   $arauak = new DOMDocument();
   $arauak ->load("../Datuak/departamentuak.xsl");

   $datuak = new DOMDocument();
   $datuak->load("../Datuak/Datuak.xml");

   $proc = new XSLTProcessor();
   $proc->importStylesheet($arauak);

   echo $proc->transformToXML($datuak);
?>