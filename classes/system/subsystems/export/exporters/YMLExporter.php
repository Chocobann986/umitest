<?php
 use UmiCms\Service;class YMLExporter extends umiExporter {public function setOutputBuffer() {$v7f2db423a49b305459147332fb01cf87 = Service::Response()    ->getCurrentBuffer();$v7f2db423a49b305459147332fb01cf87->charset($this->encoding);$v7f2db423a49b305459147332fb01cf87->contentType('text/xml');return $v7f2db423a49b305459147332fb01cf87;}public function export($v6f017b01ac7b836b216574ebb3f5d73c, $vd1051e3a7d64c17a9cba77188937d2cd) {$vb80bb7740288fda1f201890375a60c8f = getRequest('param0');$v100664c6e2c0333b19a729f2f3ddb7dd = $this->getExportPath();if (!file_exists($v100664c6e2c0333b19a729f2f3ddb7dd . $vb80bb7740288fda1f201890375a60c8f . 'el')) {$v24190bd07f7169496f08b7d03e8ec88a = getLabel('label-errors-no-information');$v78e731027d8fd50ed642340b7c9a63b3 = <<<HTML
<a href="$v24190bd07f7169496f08b7d03e8ec88a" target="blank">$v24190bd07f7169496f08b7d03e8ec88a</a>
HTML;    throw new publicException($v78e731027d8fd50ed642340b7c9a63b3);}$v2a05e4f9b3949ba2c0b7d413a0863c3f = unserialize(file_get_contents($v100664c6e2c0333b19a729f2f3ddb7dd . $vb80bb7740288fda1f201890375a60c8f . 'el'));$v0f635d0e0f3874fff8b581c132e6c7a7 = $v100664c6e2c0333b19a729f2f3ddb7dd . $vb80bb7740288fda1f201890375a60c8f . '.xml';if (file_exists($v0f635d0e0f3874fff8b581c132e6c7a7)) {unlink($v0f635d0e0f3874fff8b581c132e6c7a7);}$v5486a4ee42bf560955c9377cdc6928f2 = date('Y-m-d H:i');$v84bea1f0fd2ce16f7e562a9f06ef03d3 = $this->encoding;$v9206631b064c4d9eb6b77f94c1a8d2d7 = <<<XML
<?xml version="1.0" encoding="$v84bea1f0fd2ce16f7e562a9f06ef03d3"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="$v5486a4ee42bf560955c9377cdc6928f2">
	<shop>
XML;   file_put_contents($v0f635d0e0f3874fff8b581c132e6c7a7, $v9206631b064c4d9eb6b77f94c1a8d2d7);if (file_exists($v100664c6e2c0333b19a729f2f3ddb7dd . 'shop' . $vb80bb7740288fda1f201890375a60c8f)) {file_put_contents($v0f635d0e0f3874fff8b581c132e6c7a7, file_get_contents($v100664c6e2c0333b19a729f2f3ddb7dd . 'shop' . $vb80bb7740288fda1f201890375a60c8f), FILE_APPEND);}file_put_contents($v0f635d0e0f3874fff8b581c132e6c7a7, '<platform>UMI.CMS</platform>', FILE_APPEND);if (file_exists($v100664c6e2c0333b19a729f2f3ddb7dd . 'currencies')) {file_put_contents($v0f635d0e0f3874fff8b581c132e6c7a7, file_get_contents($v100664c6e2c0333b19a729f2f3ddb7dd . 'currencies'), FILE_APPEND);}if (file_exists($v100664c6e2c0333b19a729f2f3ddb7dd . 'categories' . $vb80bb7740288fda1f201890375a60c8f)) {file_put_contents($v0f635d0e0f3874fff8b581c132e6c7a7, '<categories>', FILE_APPEND);$vb0b5ccb4a195a07fd3eed14affb8695f = unserialize(file_get_contents($v100664c6e2c0333b19a729f2f3ddb7dd . 'categories' . $vb80bb7740288fda1f201890375a60c8f));$v8e12715af3c7054ebe3e15076a08bb9f = new umiEventPoint('yml_export_categories');$v8e12715af3c7054ebe3e15076a08bb9f->setMode('before');$v8e12715af3c7054ebe3e15076a08bb9f->setParam('id', $vb80bb7740288fda1f201890375a60c8f);$v8e12715af3c7054ebe3e15076a08bb9f->addRef('categories', $vb0b5ccb4a195a07fd3eed14affb8695f);def_module::setEventPoint($v8e12715af3c7054ebe3e15076a08bb9f);foreach ($vb0b5ccb4a195a07fd3eed14affb8695f as $v88be62ccbc2801ce90084c1356d22820 => $vb068931cc450442b63f5b3d276ea4297) {file_put_contents($v0f635d0e0f3874fff8b581c132e6c7a7, $vb068931cc450442b63f5b3d276ea4297, FILE_APPEND);}file_put_contents($v0f635d0e0f3874fff8b581c132e6c7a7, '</categories>', FILE_APPEND);}if (file_exists($v100664c6e2c0333b19a729f2f3ddb7dd . 'delivery-options' . $vb80bb7740288fda1f201890375a60c8f)) {file_put_contents($v0f635d0e0f3874fff8b581c132e6c7a7, file_get_contents($v100664c6e2c0333b19a729f2f3ddb7dd . 'delivery-options' . $vb80bb7740288fda1f201890375a60c8f), FILE_APPEND);}file_put_contents($v0f635d0e0f3874fff8b581c132e6c7a7, '<offers>', FILE_APPEND);foreach ($v2a05e4f9b3949ba2c0b7d413a0863c3f as $v7ac41b7f1504a8782ee40cd469d95431) {$v47826cacc65c665212b821e6ff80b9b0 = $v100664c6e2c0333b19a729f2f3ddb7dd . $v7ac41b7f1504a8782ee40cd469d95431 . '.txt';if (is_file($v47826cacc65c665212b821e6ff80b9b0)) {file_put_contents($v0f635d0e0f3874fff8b581c132e6c7a7, file_get_contents($v47826cacc65c665212b821e6ff80b9b0), FILE_APPEND);}}file_put_contents($v0f635d0e0f3874fff8b581c132e6c7a7, '</offers></shop></yml_catalog>', FILE_APPEND);$result = file_get_contents($v0f635d0e0f3874fff8b581c132e6c7a7);if (mb_convert_case($v84bea1f0fd2ce16f7e562a9f06ef03d3, MB_CASE_LOWER) === 'windows-1251') {return mb_convert_encoding($result, 'CP1251', 'UTF-8');}return $result;}protected function getExportPath() {return SYS_TEMP_PATH . '/yml/';}}