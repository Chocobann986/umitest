<?php
 use UmiCms\System\Cache\iEngineFactory;use UmiCms\System\Cache\Key\iGenerator;use UmiCms\System\Cache\Key\Validator\iFactory;use UmiCms\System\Request\Mode\iDetector;interface iCacheFrontend {const DEFAULT_TIME_TO_LIVE = 86400;public function __construct(   iEngineFactory $v8975779010887ca687ad040a39ee1e14,   iGenerator $vcdb937aef8a3c67a6d81d2ea354d3cc5,   iConfiguration $vccd1066343c95877b75b79d47c36bebe,   iFactory $v21693c3c9c4c71448df6686ceb8786de,   iDetector $v4076631aa75ae111b33f593b0558da6a  );public function isCacheEnabled();public function save(iUmiEntinty $vf5e638cc78dd325906c1298a0c21fb6b, $v7549538db7966adaeed3235f19ba26dd = null, $vcd91e7679d575a2c548bd2c889c23b9e = self::DEFAULT_TIME_TO_LIVE);public function load($vb1b26d9d245655a2cf8422f066203b2a, $v7549538db7966adaeed3235f19ba26dd = null);public function saveSql($v1b1cc7f086b3f074da452bc3129981eb, $result, $vcd91e7679d575a2c548bd2c889c23b9e = self::DEFAULT_TIME_TO_LIVE);public function loadSql($v1b1cc7f086b3f074da452bc3129981eb);public function saveData($v3c6e0b8a9c15224a8228b9a98ca1531d, $v2063c1608d6e0baf80249c42e2be5804, $vcd91e7679d575a2c548bd2c889c23b9e = self::DEFAULT_TIME_TO_LIVE);public function loadData($v3c6e0b8a9c15224a8228b9a98ca1531d);public function setDisabled($v327a6c4304ad5938eaf0efb6cc3e53dc = true);public function del($v3c6e0b8a9c15224a8228b9a98ca1531d, $v7549538db7966adaeed3235f19ba26dd = null);public function deleteSql($v1b1cc7f086b3f074da452bc3129981eb);public function flush();public function getCacheEngineList();public function getCacheEngineName();public function switchCacheEngine($vb068931cc450442b63f5b3d276ea4297);}