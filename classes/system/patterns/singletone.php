<?php
 abstract class singleton {private static $instances = [];abstract protected function __construct();public static function getInstance($v4a8a08f09d37b73795649038408b5f33 = null) {if (!isset(singleton::$instances[$v4a8a08f09d37b73795649038408b5f33])) {singleton::$instances[$v4a8a08f09d37b73795649038408b5f33] = new $v4a8a08f09d37b73795649038408b5f33;}return singleton::$instances[$v4a8a08f09d37b73795649038408b5f33];}public function __clone() {throw new coreException('Singletone clonning is not permitted.');}public static function setInstance($v7123a699d77db6479a1d8ece2c4f1c16, $v6f66e878c62db60568a3487869695820 = null) {if ($v6f66e878c62db60568a3487869695820 === null) {throw new coreException('Unknown class name for set instance.');}return singleton::$instances[$v6f66e878c62db60568a3487869695820] = $v7123a699d77db6479a1d8ece2c4f1c16;}protected function translateLabel($vd304ba20e96d87411588eeabac850e34) {$v341be97d9aff90c9978347f66f945b77 = startsWith($vd304ba20e96d87411588eeabac850e34, 'i18n::') ? getLabel(mb_substr($vd304ba20e96d87411588eeabac850e34, 6)) : getLabel($vd304ba20e96d87411588eeabac850e34);return $v341be97d9aff90c9978347f66f945b77 === null ? $vd304ba20e96d87411588eeabac850e34 : $v341be97d9aff90c9978347f66f945b77;}protected function disableCache() {return null;}}