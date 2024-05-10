<?php
   // Cargar el documento XSL que procesará la solicitud
   $arauak = new DOMDocument();
   $arauak->load("../XML/filtratuArdurak.xsl");

   // Cargar el documento XML que contiene los datos
   $datuak = new DOMDocument();
   $datuak->load("../XML/Datuak.xml");

   // Crear el procesador XSLT
   $proc = new XSLTProcessor();
   $proc->importStylesheet($arauak);

   // Establecer el parámetro departamento con el valor recibido del formulario
   $ardura = isset($_GET['ardura']) ? $_GET['ardura'] : '';
   $proc->setParameter('', 'ardura', $ardura);

   // Procesar y mostrar el resultado
   echo $proc->transformToXML($datuak);
?>