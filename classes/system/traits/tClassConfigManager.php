<?php
 trait tClassConfigManager {private static $v2245023265ae4cf87d02c8b6ba991139;private static $vf48e7c18fc823c3bb7afa0dadd597603;private static $vd85bb6d48b805b164b325801339d16ad = 'config';private static $v292b590b5ec33d99311e8a68bbc0d1b7 = 'classConfig';private static $v80fd92c019d4b7c2299492f4ad549e67 = 'ClassConfig';public static function setItemClass($va2f2ed4f8ebc2cbb4c21a29dc40ab61d) {self::$v80fd92c019d4b7c2299492f4ad549e67 = $va2f2ed4f8ebc2cbb4c21a29dc40ab61d;}public static function setConfig($v2245023265ae4cf87d02c8b6ba991139) {if (is_string($v2245023265ae4cf87d02c8b6ba991139)) {return self::setConfigByFile($v2245023265ae4cf87d02c8b6ba991139);}if (is_array($v2245023265ae4cf87d02c8b6ba991139)) {return self::setConfigByContent($v2245023265ae4cf87d02c8b6ba991139);}return false;}public static function getConfig() {if (self::$v2245023265ae4cf87d02c8b6ba991139 !== null) {return self::$v2245023265ae4cf87d02c8b6ba991139;}return self::getDefaultConfig();}protected static function getDefaultConfig() {if (self::$vf48e7c18fc823c3bb7afa0dadd597603 !== null) {return self::$vf48e7c18fc823c3bb7afa0dadd597603;}$va2f2ed4f8ebc2cbb4c21a29dc40ab61d = self::getClass();return self::$vf48e7c18fc823c3bb7afa0dadd597603 = self::createConfig($va2f2ed4f8ebc2cbb4c21a29dc40ab61d, self::getClassConfigContent($va2f2ed4f8ebc2cbb4c21a29dc40ab61d));}protected static function getConfigFromFile($vd6fe1d0be6347b8ef2427fa629c04485) {if (self::isReadableFile($vd6fe1d0be6347b8ef2427fa629c04485)) {return include_once $vd6fe1d0be6347b8ef2427fa629c04485;}throw new Exception(sprintf('Невозможно загрузить конфигурацию из файла %s', $vd6fe1d0be6347b8ef2427fa629c04485));}protected function setConfigByFile($v47826cacc65c665212b821e6ff80b9b0) {self::$v2245023265ae4cf87d02c8b6ba991139 = $this->getConfigFromFile($v47826cacc65c665212b821e6ff80b9b0);return true;}protected function setConfigByContent(array $v2245023265ae4cf87d02c8b6ba991139) {self::$v2245023265ae4cf87d02c8b6ba991139 = self::createConfig(self::getClass(), $v2245023265ae4cf87d02c8b6ba991139);return true;}protected static function getClassConfigContent($va2f2ed4f8ebc2cbb4c21a29dc40ab61d) {$v292b590b5ec33d99311e8a68bbc0d1b7 = self::$v292b590b5ec33d99311e8a68bbc0d1b7;if (!property_exists($va2f2ed4f8ebc2cbb4c21a29dc40ab61d, $v292b590b5ec33d99311e8a68bbc0d1b7)) {throw new Exception(sprintf('Не определено свойство %s для класса %s', $v292b590b5ec33d99311e8a68bbc0d1b7, $va2f2ed4f8ebc2cbb4c21a29dc40ab61d));}$v9a0364b9e99bb480dd25e1f0284c8555 = $va2f2ed4f8ebc2cbb4c21a29dc40ab61d::$$v292b590b5ec33d99311e8a68bbc0d1b7;if (!is_array($v9a0364b9e99bb480dd25e1f0284c8555)) {throw new Exception(sprintf('Конфигурация для класса %s не определена', $va2f2ed4f8ebc2cbb4c21a29dc40ab61d));}return $v9a0364b9e99bb480dd25e1f0284c8555;}private static function isReadableFile($v47826cacc65c665212b821e6ff80b9b0) {return is_file($v47826cacc65c665212b821e6ff80b9b0) && is_readable($v47826cacc65c665212b821e6ff80b9b0);}private static function getClassPath($va2f2ed4f8ebc2cbb4c21a29dc40ab61d) {$v607f7936d76c07c593f6942f4e88d28e = new ReflectionClass($va2f2ed4f8ebc2cbb4c21a29dc40ab61d);return $v607f7936d76c07c593f6942f4e88d28e->getFileName();}private static function getClass() {return get_called_class();}private static function createConfig($va2f2ed4f8ebc2cbb4c21a29dc40ab61d, $v2245023265ae4cf87d02c8b6ba991139) {return new self::$v80fd92c019d4b7c2299492f4ad549e67($va2f2ed4f8ebc2cbb4c21a29dc40ab61d, $v2245023265ae4cf87d02c8b6ba991139);}}