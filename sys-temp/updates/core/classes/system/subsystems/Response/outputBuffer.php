<?php
 use UmiCms\Service;abstract class outputBuffer implements iOutputBuffer {protected $buffer = '';protected $invokeTime;protected $options = [];private $eventsEnabled = true;private $charset = 'utf-8';private $contentType = 'text/html';private $status = '200 Ok';private $headerList = [];public function __construct() {$this->invokeTime = microtime(true);}abstract public function send();public function clear() {$this->buffer = '';return $this;}public function reset() {while (ob_get_level()) {ob_end_clean();}return $this;}public function length() {return mb_strlen($this->buffer);}public function content() {return $this->buffer;}public function push($v8d777f385d3dfec8815d20f7496026dc) {$this->buffer .= $v8d777f385d3dfec8815d20f7496026dc;return $this;}public function end() {$this->send();$this->stop();}public function stop() {exit('');}public function calltime() {return round(microtime(true) - $this->invokeTime, 6);}public function redirect($v572d4e421e5e6b9bc11d815e8a027112, $v9acb44549b41563697bb490144ec6258 = '301 Moved Permanently', $vafc83e97f17c79ad582675c662b8ee16 = 301) {$this->push(PHP_EOL . 'Redirected to address: ' . $v572d4e421e5e6b9bc11d815e8a027112 . PHP_EOL);$this->end();}public function status($v9acb44549b41563697bb490144ec6258 = false) {if ($v9acb44549b41563697bb490144ec6258) {$this->status = $v9acb44549b41563697bb490144ec6258;}return $this->status;}public function getStatusCode() {return (int) $this->status;}public function charset($vdbd153490a1c3720a970a611afc4371c = false) {if ($vdbd153490a1c3720a970a611afc4371c) {$this->charset = $vdbd153490a1c3720a970a611afc4371c;}return $this->charset;}public function contentType($vdf5feafab86601ea0e1e6fe6e20df6c5 = false) {if ($vdf5feafab86601ea0e1e6fe6e20df6c5) {$this->contentType = $vdf5feafab86601ea0e1e6fe6e20df6c5;}return $this->contentType;}public function isHtml() {return $this->contentType() === 'text/html';}public function option($v3c6e0b8a9c15224a8228b9a98ca1531d, $v2063c1608d6e0baf80249c42e2be5804 = null) {if ($v2063c1608d6e0baf80249c42e2be5804 === null) {return isset($this->options[$v3c6e0b8a9c15224a8228b9a98ca1531d]) ? $this->options[$v3c6e0b8a9c15224a8228b9a98ca1531d] : null;}return $this->options[$v3c6e0b8a9c15224a8228b9a98ca1531d] = $v2063c1608d6e0baf80249c42e2be5804;}public function issetHeader($vb068931cc450442b63f5b3d276ea4297) {if (!is_string($vb068931cc450442b63f5b3d276ea4297) || $vb068931cc450442b63f5b3d276ea4297 === '') {throw new wrongParamException('Header name must be not empty string');}return isset($this->headerList[$vb068931cc450442b63f5b3d276ea4297]);}public function setHeader($vb068931cc450442b63f5b3d276ea4297, $v2063c1608d6e0baf80249c42e2be5804) {if (!is_string($vb068931cc450442b63f5b3d276ea4297) || $vb068931cc450442b63f5b3d276ea4297 === '') {throw new wrongParamException('Header name must be not empty string');}if (!is_string($v2063c1608d6e0baf80249c42e2be5804) || $v2063c1608d6e0baf80249c42e2be5804 === '') {throw new wrongParamException('Header value must be not empty string');}$this->headerList[$vb068931cc450442b63f5b3d276ea4297] = $v2063c1608d6e0baf80249c42e2be5804;return $this;}public function unsetHeader($vb068931cc450442b63f5b3d276ea4297) {if (!is_string($vb068931cc450442b63f5b3d276ea4297) || $vb068931cc450442b63f5b3d276ea4297 === '') {throw new wrongParamException('Header name must be not empty string');}unset($this->headerList[$vb068931cc450442b63f5b3d276ea4297]);return $this;}public function getHeaderList() {return $this->headerList;}public function getDump() : string {$v9acb44549b41563697bb490144ec6258 = "Status => {$this->status(false)}\n";$vdf5feafab86601ea0e1e6fe6e20df6c5 = "Content Type => {$this->contentType(false)}\n";$vdbd153490a1c3720a970a611afc4371c = "Charset => {$this->charset(false)}\n";$vb9ef165b255673dde47bff07f4390fb1 = $v9acb44549b41563697bb490144ec6258 . $vdf5feafab86601ea0e1e6fe6e20df6c5 . $vdbd153490a1c3720a970a611afc4371c;if (!empty($this->getHeaderList())) {$v4340fd73e75df7a9d9e45902a59ba3a4 = "Headers:\n";foreach ($this->getHeaderList() as $v3c6e0b8a9c15224a8228b9a98ca1531d => $v2063c1608d6e0baf80249c42e2be5804) {$v4340fd73e75df7a9d9e45902a59ba3a4 .= $v3c6e0b8a9c15224a8228b9a98ca1531d . " => " . $v2063c1608d6e0baf80249c42e2be5804 . "\n";}$vb9ef165b255673dde47bff07f4390fb1 .= $v4340fd73e75df7a9d9e45902a59ba3a4;}if (!empty($this->content())) {$v9a0364b9e99bb480dd25e1f0284c8555 = "Content:\n{$this->content()}";$vb9ef165b255673dde47bff07f4390fb1 .= $v9a0364b9e99bb480dd25e1f0284c8555;}return $vb9ef165b255673dde47bff07f4390fb1;}public function isEventsEnabled() {if ($this->isFatalOccurred()) {return false;}return $this->eventsEnabled;}public function enableEvents() {$this->eventsEnabled = true;return $this;}public function disableEvents() {$this->eventsEnabled = false;return $this;}public function crash($vcb5e100e5a9a3e7f6d1fd97512215282, $v9acb44549b41563697bb490144ec6258 = 500) {$this->contentType('text/html');$this->charset('utf-8');$this->setHeader('X-Robots-Tag', 'none');$this->status($v9acb44549b41563697bb490144ec6258);$this->push(Service::get('ExceptionHandlerFactory')->create()->getErrorContent($vcb5e100e5a9a3e7f6d1fd97512215282));$this->end();}public static function contentGenerator($ve491ffdb30ee3d133975aa05783917b1 = null) {static $v36750de19bed237506726986ae09e0c9 = null;if ($ve491ffdb30ee3d133975aa05783917b1 === null) {return $v36750de19bed237506726986ae09e0c9;}return $v36750de19bed237506726986ae09e0c9 = $ve491ffdb30ee3d133975aa05783917b1;}protected function isFatalOccurred() {return $this->getStatusCode() == 500;}public function __call($vb068931cc450442b63f5b3d276ea4297, $vdbc11caa5bda99f77e6fb4dabd882e7d) {return null;}final public static function current($va2f2ed4f8ebc2cbb4c21a29dc40ab61d = false) {$vd1fc8eaf36937be0c3ba8cfe0a2c1bfe = Service::Response();if ($va2f2ed4f8ebc2cbb4c21a29dc40ab61d) {return $vd1fc8eaf36937be0c3ba8cfe0a2c1bfe->getBufferByClass($va2f2ed4f8ebc2cbb4c21a29dc40ab61d);}return $vd1fc8eaf36937be0c3ba8cfe0a2c1bfe->getCurrentBuffer();}}