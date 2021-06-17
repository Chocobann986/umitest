<?php
 namespace UmiCms\System\Cache\Key;abstract class Validator implements iValidator {private $configuration;public function __construct(\iConfiguration $vccd1066343c95877b75b79d47c36bebe) {$this->configuration = $vccd1066343c95877b75b79d47c36bebe;}abstract public function isValid($v3c6e0b8a9c15224a8228b9a98ca1531d);protected function isOnBlackList($v3c6e0b8a9c15224a8228b9a98ca1531d) {return $this->isKeyOnList($this->getBlackList(), $v3c6e0b8a9c15224a8228b9a98ca1531d);}protected function isOnWhiteList($v3c6e0b8a9c15224a8228b9a98ca1531d) {return $this->isKeyOnList($this->getWhiteList(), $v3c6e0b8a9c15224a8228b9a98ca1531d);}private function isKeyOnList(array $v10ae9fc7d453b0dd525d0edf2ede7961, $v3c6e0b8a9c15224a8228b9a98ca1531d) {foreach ($v10ae9fc7d453b0dd525d0edf2ede7961 as $v1043bfc77febe75fafec0c4309faccf1) {if (is_string($v1043bfc77febe75fafec0c4309faccf1) && contains($v3c6e0b8a9c15224a8228b9a98ca1531d, $v1043bfc77febe75fafec0c4309faccf1)) {return true;}}return false;}private function getBlackList() {$v2245023265ae4cf87d02c8b6ba991139 = $this->getConfiguration();$vb67ab710cb8fd73af64825a46b759bb8 = (array) $v2245023265ae4cf87d02c8b6ba991139->get('cache', 'not-allowed-methods');$ve8c4154b878e2b52b86c8c44c819f0d0 = (array) $v2245023265ae4cf87d02c8b6ba991139->get('cache', 'not-allowed-streams');$v9bc2f4961852ba37099d9052dd8ac59e = (array) $v2245023265ae4cf87d02c8b6ba991139->get('cache', 'blacklist');$va0bc9791616492b14e330a7e0ef35512 = array_merge($vb67ab710cb8fd73af64825a46b759bb8, $ve8c4154b878e2b52b86c8c44c819f0d0, $v9bc2f4961852ba37099d9052dd8ac59e);$va0bc9791616492b14e330a7e0ef35512 = array_unique($va0bc9791616492b14e330a7e0ef35512);return $this->filterList($va0bc9791616492b14e330a7e0ef35512);}private function getWhiteList() {$v4ccfaf724b7a75442e150dca4bb7b758 = (array) $this->getConfiguration()    ->get('cache', 'whitelist');$v4ccfaf724b7a75442e150dca4bb7b758 = array_unique($v4ccfaf724b7a75442e150dca4bb7b758);return $this->filterList($v4ccfaf724b7a75442e150dca4bb7b758);}private function filterList(array $v10ae9fc7d453b0dd525d0edf2ede7961) {return array_filter($v10ae9fc7d453b0dd525d0edf2ede7961, function ($v2063c1608d6e0baf80249c42e2be5804) {if (!is_string($v2063c1608d6e0baf80249c42e2be5804)) {return false;}$v13f055fdc29cde00f77f4ff0bcb09d49 = trim($v2063c1608d6e0baf80249c42e2be5804);return mb_strlen($v13f055fdc29cde00f77f4ff0bcb09d49) > 0;});}private function getConfiguration() {return $this->configuration;}}