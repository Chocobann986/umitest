<?php
 namespace UmiCms\System\Cache\Browser;use UmiCms\System\Cache\Browser\Engine\iFactory;use UmiCms\System\Cache\State\iValidator;interface iFacade {public function __construct(\iConfiguration $vccd1066343c95877b75b79d47c36bebe, iFactory $v8975779010887ca687ad040a39ee1e14, iValidator $v01fd74d4554ac01959006884f7e27a2c);public function process();public function isEnabled();public function enable();public function disable();public function setEngine($vb068931cc450442b63f5b3d276ea4297);public function getEngineName();}