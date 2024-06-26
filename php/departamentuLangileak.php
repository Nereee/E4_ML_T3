<?php
   // Cargar el documento XSL que procesará la solicitud
   $arauak = new DOMDocument();
   $arauak->load("../Datuak/departamentuLangileak.xsl");

   // Cargar el documento XML que contiene los datos
   $datuak = new DOMDocument();
   $datuak->load("../Datuak/Datuak.xml");

   // Crear el procesador XSLT
   $proc = new XSLTProcessor();
   $proc->importStylesheet($arauak);

   // Establecer el parámetro departamento con el valor recibido del formulario
   $departamento = isset($_GET['departamento']) ? $_GET['departamento'] : '';
   $proc->setParameter('', 'departamento', $departamento);

   // Procesar y mostrar el resultado
   echo $proc->transformToXML($datuak);
?>
