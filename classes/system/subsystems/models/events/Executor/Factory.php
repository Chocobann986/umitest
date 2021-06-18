<?php
 namespace UmiCms\System\Events\Executor;use \iServiceContainer;use UmiCms\System\Events\iHandler;use UmiCms\System\Events\iExecutor;use UmiCms\System\Events\Handler\iModule as iModuleHandler;use UmiCms\System\Events\Handler\iCustom as iCustomHandler;use UmiCms\System\Events\Executor\Module as ModuleExecutor;use UmiCms\System\Events\Executor\iModule as iModuleExecutor;use UmiCms\System\Events\Executor\Custom as CustomExecutor;use UmiCms\System\Events\Executor\iCustom as iCustomExecutor;class Factory implements iFactory {private $serviceContainer;public function __construct(iServiceContainer $v06d419f75cbecf6df5a44ea9471105ba) {$this->serviceContainer = $v06d419f75cbecf6df5a44ea9471105ba;}public function createForHandler(iHandler $vc1cbfe271a40788a00e8bf8574d94d4b) : iExecutor {if ($vc1cbfe271a40788a00e8bf8574d94d4b instanceof iModuleHandler) {return $this->createForModuleHandler($vc1cbfe271a40788a00e8bf8574d94d4b);}if ($vc1cbfe271a40788a00e8bf8574d94d4b instanceof iCustomHandler) {return $this->createForCustomHandler($vc1cbfe271a40788a00e8bf8574d94d4b);}throw new \ErrorException(sprintf('Unknown handler type given: "%s"', get_class($vc1cbfe271a40788a00e8bf8574d94d4b)));}private function createForModuleHandler(iModuleHandler $vc1cbfe271a40788a00e8bf8574d94d4b) : iModuleExecutor {$vb1925939f66c2e4625aadb18cabf1cea = new ModuleExecutor($vc1cbfe271a40788a00e8bf8574d94d4b);$vb1925939f66c2e4625aadb18cabf1cea = $this->serviceContainer    ->initService(iModuleExecutor::SERVICE_NAME, $vb1925939f66c2e4625aadb18cabf1cea);return $vb1925939f66c2e4625aadb18cabf1cea;}private function createForCustomHandler(iCustomHandler $vc1cbfe271a40788a00e8bf8574d94d4b) : iCustomExecutor {return new CustomExecutor($vc1cbfe271a40788a00e8bf8574d94d4b);}}