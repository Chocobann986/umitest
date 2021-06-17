<?php
 namespace UmiCms\System\Response;use UmiCms\System\Response\Buffer\iCollection;use UmiCms\System\Response\Buffer\iDetector;use UmiCms\System\Response\Buffer\iFactory;class Facade implements iFacade {private $factory;private $detector;private $collection;public function __construct(   iFactory $v9549dd6065d019211460c59a86dd6536,   iDetector $v21aed3df2077b5d91ce46bf123446731,   iCollection $vdb6d9b451b818ccc9a449383f2f0c450  ) {$this->factory = $v9549dd6065d019211460c59a86dd6536;$this->detector = $v21aed3df2077b5d91ce46bf123446731;$this->collection = $vdb6d9b451b818ccc9a449383f2f0c450;}public function getCurrentBuffer() {$va2f2ed4f8ebc2cbb4c21a29dc40ab61d = $this->getDetector()    ->detect();return $this->getBufferByClass($va2f2ed4f8ebc2cbb4c21a29dc40ab61d);}public function getBuffer($vb068931cc450442b63f5b3d276ea4297) {if (!is_string($vb068931cc450442b63f5b3d276ea4297) || $vb068931cc450442b63f5b3d276ea4297 === '') {throw new \coreException('Incorrect buffer name given');}$va2f2ed4f8ebc2cbb4c21a29dc40ab61d = $this->getClass($vb068931cc450442b63f5b3d276ea4297);return $this->getBufferByClass($va2f2ed4f8ebc2cbb4c21a29dc40ab61d);}public function getBufferByClass($va2f2ed4f8ebc2cbb4c21a29dc40ab61d) {$vdb6d9b451b818ccc9a449383f2f0c450 = $this->getCollection();if (!$vdb6d9b451b818ccc9a449383f2f0c450->exists($va2f2ed4f8ebc2cbb4c21a29dc40ab61d)) {$v7f2db423a49b305459147332fb01cf87 = $this->getFactory()     ->create($va2f2ed4f8ebc2cbb4c21a29dc40ab61d);$vdb6d9b451b818ccc9a449383f2f0c450->set($v7f2db423a49b305459147332fb01cf87);}return $vdb6d9b451b818ccc9a449383f2f0c450->get($va2f2ed4f8ebc2cbb4c21a29dc40ab61d);}public function getHttpBuffer() {return $this->getBuffer(self::HTTP);}public function getCliBuffer() {return $this->getBuffer(self::CLI);}public function getHttpDocBuffer() {return $this->getBuffer(self::HTTP_DOC);}public function printJson($v8d777f385d3dfec8815d20f7496026dc, $v9acb44549b41563697bb490144ec6258 = '200 OK') {$v7f2db423a49b305459147332fb01cf87 = $this->getCurrentBuffer();$v7f2db423a49b305459147332fb01cf87->calltime();$v7f2db423a49b305459147332fb01cf87->status($v9acb44549b41563697bb490144ec6258);$v7f2db423a49b305459147332fb01cf87->contentType('application/json');$v7f2db423a49b305459147332fb01cf87->charset('utf-8');$v7f2db423a49b305459147332fb01cf87->option('generation-time', false);$v7f2db423a49b305459147332fb01cf87->push(json_encode($v8d777f385d3dfec8815d20f7496026dc));$v7f2db423a49b305459147332fb01cf87->end();}public function printXml(\DOMDocument $vfdc3bdefb79cec8eb8211d2499e04704, $v9acb44549b41563697bb490144ec6258 = '200 OK') {$this->printXmlAsString($vfdc3bdefb79cec8eb8211d2499e04704->saveXML());}public function printXmlAsString($v0f635d0e0f3874fff8b581c132e6c7a7, $v9acb44549b41563697bb490144ec6258 = '200 OK') {$v7f2db423a49b305459147332fb01cf87 = $this->getCurrentBuffer();$v7f2db423a49b305459147332fb01cf87->calltime();$v7f2db423a49b305459147332fb01cf87->status($v9acb44549b41563697bb490144ec6258);$v7f2db423a49b305459147332fb01cf87->contentType('text/xml');$v7f2db423a49b305459147332fb01cf87->charset('utf-8');$v7f2db423a49b305459147332fb01cf87->option('generation-time', false);$v7f2db423a49b305459147332fb01cf87->push($v0f635d0e0f3874fff8b581c132e6c7a7);$v7f2db423a49b305459147332fb01cf87->end();}public function printHtml($vfc35fdc70d5fc69d269883a822c7a53e, $v9acb44549b41563697bb490144ec6258 = '200 OK') {$v7f2db423a49b305459147332fb01cf87 = $this->getCurrentBuffer();$v7f2db423a49b305459147332fb01cf87->calltime();$v7f2db423a49b305459147332fb01cf87->status($v9acb44549b41563697bb490144ec6258);$v7f2db423a49b305459147332fb01cf87->contentType('text/html');$v7f2db423a49b305459147332fb01cf87->charset('utf-8');$v7f2db423a49b305459147332fb01cf87->option('generation-time', true);$v7f2db423a49b305459147332fb01cf87->push($vfc35fdc70d5fc69d269883a822c7a53e);$v7f2db423a49b305459147332fb01cf87->end();}public function pushImage(\iUmiFile $v78805a221a988e79ef3f42d7c5bfd418, $v9acb44549b41563697bb490144ec6258 = '200 OK') {$v7f2db423a49b305459147332fb01cf87 = $this->getCurrentBuffer();$v7f2db423a49b305459147332fb01cf87->status($v9acb44549b41563697bb490144ec6258);$v7f2db423a49b305459147332fb01cf87->setHeader('Content-Length', (string) $v78805a221a988e79ef3f42d7c5bfd418->getSize());$v7f2db423a49b305459147332fb01cf87->contentType($v78805a221a988e79ef3f42d7c5bfd418->getMimeType());$v7f2db423a49b305459147332fb01cf87->option('generation-time', false);$v7f2db423a49b305459147332fb01cf87->push($v78805a221a988e79ef3f42d7c5bfd418->getContent());$v7f2db423a49b305459147332fb01cf87->end();}public function download(\iUmiFile $v8c7dd922ad47494fc02c388e12c00eac) {$this->validateFile($v8c7dd922ad47494fc02c388e12c00eac);$v8c7dd922ad47494fc02c388e12c00eac->download();}public function downloadAndDelete(\iUmiFile $v8c7dd922ad47494fc02c388e12c00eac) {$this->validateFile($v8c7dd922ad47494fc02c388e12c00eac);$v8c7dd922ad47494fc02c388e12c00eac->download(true);}public function isCorrect() {return $this->getCurrentBuffer()->getStatusCode() == 200;}private function validateFile(\iUmiFile $v8c7dd922ad47494fc02c388e12c00eac) {if ($v8c7dd922ad47494fc02c388e12c00eac->getIsBroken()) {throw new \InvalidArgumentException(sprintf('Broken file given: "%s"', $v8c7dd922ad47494fc02c388e12c00eac->getFilePath(true)));}}private function getClass($vb068931cc450442b63f5b3d276ea4297) {return sprintf('%sOutputBuffer', $vb068931cc450442b63f5b3d276ea4297);}private function getFactory() {return $this->factory;}private function getDetector() {return $this->detector;}private function getCollection() {return $this->collection;}public function getUpdateTime() {return 0;}}