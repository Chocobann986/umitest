<?php
 namespace UmiCms\System\Response\Buffer;use UmiCms\System\Request\Mode\iDetector as ModeDetector;class Detector implements iDetector {private $modeDetector;public function __construct(ModeDetector $v4076631aa75ae111b33f593b0558da6a) {$this->modeDetector = $v4076631aa75ae111b33f593b0558da6a;}public function detect() {if ($this->getModeDetector()->isCli()) {return self::DEFAULT_CLI_BUFFER;}if (isCronCliMode()) {return self::DEFAULT_CLI_BUFFER;}return self::DEFAULT_HTTP_BUFFER;}private function getModeDetector() {return $this->modeDetector;}}