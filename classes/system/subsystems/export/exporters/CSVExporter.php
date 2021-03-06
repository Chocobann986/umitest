<?php
 use UmiCms\Service;class csvExporter extends umiExporter {const VALUE_LIMITER = '"';const OPTIONED_PARTS = ['int', 'varchar', 'text', 'float'];protected $entityIdList = [];protected $entityIdListFilePath;protected $sourceName;protected $nameList = [];protected $titleList = [];protected $typeList = [];protected $exporter;protected $shouldFlushToBuffer;private $csvFilePath;private $propertyDelimiter = ';';private $valueDelimiter = ',';private $partDelimiter = '|';private $subPartDelimiter = ':';private $fileName;public function __construct($v599dcce2998a6b40b1e38e8c6006cb0a) {parent::__construct($v599dcce2998a6b40b1e38e8c6006cb0a);ini_set('mbstring.substitute_character', 'none');}public function setOutputBuffer() {$v7f2db423a49b305459147332fb01cf87 = Service::Response()    ->getCurrentBuffer();$v7f2db423a49b305459147332fb01cf87->charset($this->encoding);$v7f2db423a49b305459147332fb01cf87->contentType('text/plain');return $v7f2db423a49b305459147332fb01cf87;}public function setDelimiter($v528d3a0db57c788c744aed5a2ee9f5c8) {if ($v528d3a0db57c788c744aed5a2ee9f5c8) {$this->propertyDelimiter = (string) $v528d3a0db57c788c744aed5a2ee9f5c8;}}public function setFileName($vb068931cc450442b63f5b3d276ea4297) {if (!is_string($vb068931cc450442b63f5b3d276ea4297) || $vb068931cc450442b63f5b3d276ea4297 === '') {throw new InvalidArgumentException('Invalid file name given');}$this->fileName = $vb068931cc450442b63f5b3d276ea4297;return $this;}public function getFileExt() {return 'csv';}public function export($v6f017b01ac7b836b216574ebb3f5d73c, $vd1051e3a7d64c17a9cba77188937d2cd) {$this->initialize();$this->loadEntityIdList($v6f017b01ac7b836b216574ebb3f5d73c, $vd1051e3a7d64c17a9cba77188937d2cd);$this->doOneIteration();$this->updateEntityIdList();$this->determineCompleteness();if ($this->getIsCompleted()) {$this->writeFinalCsvFile();}return false;}public function isStarted() {$this->initialize();return file_exists($this->entityIdListFilePath);}protected function loadEntityIdList($v6f017b01ac7b836b216574ebb3f5d73c, $vd1051e3a7d64c17a9cba77188937d2cd) {$this->entityIdList = [];if (file_exists($this->entityIdListFilePath)) {$this->entityIdList = unserialize(file_get_contents($this->entityIdListFilePath));return;}if (empty($v6f017b01ac7b836b216574ebb3f5d73c)) {$v8be74552df93e31bbdd6b36ed74bdb6a = new selector('pages');$v8be74552df93e31bbdd6b36ed74bdb6a->where('hierarchy')->page(0)->level(0);$v8be74552df93e31bbdd6b36ed74bdb6a->option('no-length')->value(true);$v6f017b01ac7b836b216574ebb3f5d73c = (array) $v8be74552df93e31bbdd6b36ed74bdb6a->result();}$ve3e6b3e6e1222c8df2b778e64a3b00d7 = $this->getEntityIdList($v6f017b01ac7b836b216574ebb3f5d73c);foreach ($ve3e6b3e6e1222c8df2b778e64a3b00d7 as $vb80bb7740288fda1f201890375a60c8f) {$this->entityIdList[$vb80bb7740288fda1f201890375a60c8f] = $vb80bb7740288fda1f201890375a60c8f;}$v8809c46f76a0df955db9d55a98530e23 = $this->getEntityIdList($vd1051e3a7d64c17a9cba77188937d2cd);foreach ($v8809c46f76a0df955db9d55a98530e23 as $vb80bb7740288fda1f201890375a60c8f) {unset($this->entityIdList[$vb80bb7740288fda1f201890375a60c8f]);}}protected function getEntityIdList($v6f017b01ac7b836b216574ebb3f5d73c) {$v475d6424dac268bb5fffd0235530c333 = umiHierarchy::getInstance();$v490989c86f3332dc089a7b994bd654c7 = [];foreach ($v6f017b01ac7b836b216574ebb3f5d73c as $v9603a224b40d7b67210b78f2e390d00f) {if (!$v9603a224b40d7b67210b78f2e390d00f instanceof iUmiHierarchyElement) {$v9603a224b40d7b67210b78f2e390d00f = $v475d6424dac268bb5fffd0235530c333->getElement($v9603a224b40d7b67210b78f2e390d00f, true, true);}if (!$v9603a224b40d7b67210b78f2e390d00f instanceof iUmiHierarchyElement) {continue;}$v53eaf2ccc6a17c161589fabc2352eb5b = $v9603a224b40d7b67210b78f2e390d00f->getId();$v490989c86f3332dc089a7b994bd654c7[] = $v53eaf2ccc6a17c161589fabc2352eb5b;$vdec63a3b8e3ac60a41c0fb905dac80d3 = $v475d6424dac268bb5fffd0235530c333->getChildrenList($v53eaf2ccc6a17c161589fabc2352eb5b);foreach ($vdec63a3b8e3ac60a41c0fb905dac80d3 as $vb80bb7740288fda1f201890375a60c8f) {$v490989c86f3332dc089a7b994bd654c7[] = $vb80bb7740288fda1f201890375a60c8f;}}return $v490989c86f3332dc089a7b994bd654c7;}private function initialize() {$this->shouldFlushToBuffer = (getRequest('as_file') === '0');$v7bac894702f1b766d0de9c5acb5364f8 = $this->getFileName() ?: getRequest('param0');$this->sourceName = "{$v7bac894702f1b766d0de9c5acb5364f8}.{$this->getFileExt()}";$v26d679243d771f70af4dd8478ce0c4e9 = $this->getExportPath();if (!is_dir($v26d679243d771f70af4dd8478ce0c4e9)) {mkdir($v26d679243d771f70af4dd8478ce0c4e9, 0777, true);}$this->csvFilePath = $v26d679243d771f70af4dd8478ce0c4e9 . $this->sourceName;$this->entityIdListFilePath = $this->csvFilePath . 'array';if (file_exists($this->csvFilePath) && !file_exists($this->entityIdListFilePath)) {unlink($this->csvFilePath);}}private function getFileName() {return $this->fileName;}private function doOneIteration() {$this->initializeExporter();$vfdc3bdefb79cec8eb8211d2499e04704 = $this->exporter->execute();$this->loadHeaders();$vca3a34ad419c2f783bc2dbda90d53c41 = $this->getPropertyList($vfdc3bdefb79cec8eb8211d2499e04704);$this->saveHeaders();$this->appendRowsToCsvFile($vca3a34ad419c2f783bc2dbda90d53c41);}protected function initializeExporter() {$this->exporter = $this->createXmlExporter($this->sourceName, $this->getLimit());$this->exporter->ignoreRelationsExcept(['options']);$v490989c86f3332dc089a7b994bd654c7 = $this->entityIdList;if (!$this->shouldFlushToBuffer) {$v490989c86f3332dc089a7b994bd654c7 = array_slice($v490989c86f3332dc089a7b994bd654c7, 0, $this->getLimit() + 1);}$this->exporter->addElements($v490989c86f3332dc089a7b994bd654c7);}protected function getLimit() {if ($this->shouldFlushToBuffer) {return false;}return parent::getLimit();}protected function getPropertyList(DOMDocument $vfdc3bdefb79cec8eb8211d2499e04704) {$vca3a34ad419c2f783bc2dbda90d53c41 = [];$v3d788fa62d7c185a1bee4c9147ee1091 = new DOMXPath($vfdc3bdefb79cec8eb8211d2499e04704);$vf734e07300ef77aa940623b4895f07bd = $v3d788fa62d7c185a1bee4c9147ee1091->query('//pages/page');foreach ($vf734e07300ef77aa940623b4895f07bd as $v36c4536996ca5615dcf9911f068786dc) {$vca3a34ad419c2f783bc2dbda90d53c41[] = $this->getEntityPropertyList($v36c4536996ca5615dcf9911f068786dc);}return $vca3a34ad419c2f783bc2dbda90d53c41;}protected function getEntityPropertyList(DOMElement $vf5e638cc78dd325906c1298a0c21fb6b) {$vca3a34ad419c2f783bc2dbda90d53c41 = $this->getSystemProperties($vf5e638cc78dd325906c1298a0c21fb6b);$vc4d0f9d0bcfa937675892b4cfd81a671 = $vf5e638cc78dd325906c1298a0c21fb6b->getElementsByTagName('property');foreach ($vc4d0f9d0bcfa937675892b4cfd81a671 as $v96b8eeb9e337bd8704b337b404d62688) {$vb068931cc450442b63f5b3d276ea4297 = $v96b8eeb9e337bd8704b337b404d62688->getAttribute('name');$v2063c1608d6e0baf80249c42e2be5804 = $this->getPropertyValue($v96b8eeb9e337bd8704b337b404d62688);$v6a992d5529f459a44fee58c733255e86 = array_search($vb068931cc450442b63f5b3d276ea4297, $this->nameList);if (!$v6a992d5529f459a44fee58c733255e86) {$v6a992d5529f459a44fee58c733255e86 = $this->appendPropertyToHeaders($v96b8eeb9e337bd8704b337b404d62688);}$vca3a34ad419c2f783bc2dbda90d53c41[$v6a992d5529f459a44fee58c733255e86] = $v2063c1608d6e0baf80249c42e2be5804;}return $this->normalizeProperties($vca3a34ad419c2f783bc2dbda90d53c41);}protected function getSystemProperties(DOMElement $vf5e638cc78dd325906c1298a0c21fb6b) {$vb80bb7740288fda1f201890375a60c8f = $vf5e638cc78dd325906c1298a0c21fb6b->getAttribute('id');$vb068931cc450442b63f5b3d276ea4297 = $vf5e638cc78dd325906c1298a0c21fb6b->getElementsByTagName('name')->item(0)->nodeValue;$v5f694956811487225d15e973ca38fbab = $vf5e638cc78dd325906c1298a0c21fb6b->getAttribute('type-id');$v367e854225a0810977297b3bedb2f309 = $vf5e638cc78dd325906c1298a0c21fb6b->getAttribute('is-active');$v3200a31fc05da4e9d5a0465c36822e2f = '';if ($vf5e638cc78dd325906c1298a0c21fb6b->getElementsByTagName('template')->length) {$v3200a31fc05da4e9d5a0465c36822e2f = $vf5e638cc78dd325906c1298a0c21fb6b->getElementsByTagName('template')     ->item(0)     ->getAttribute('id');}$vbfa030fe63bacd523dd70a76cfaed98a = $vf5e638cc78dd325906c1298a0c21fb6b->hasAttribute('parentId') ? $vf5e638cc78dd325906c1298a0c21fb6b->getAttribute('parentId') : 0;$v0330da281541887f65b0a60066351c91 = $vf5e638cc78dd325906c1298a0c21fb6b->getAttribute('alt-name');return [    $vb80bb7740288fda1f201890375a60c8f,    $vb068931cc450442b63f5b3d276ea4297,    $v5f694956811487225d15e973ca38fbab,    $v367e854225a0810977297b3bedb2f309,    $v3200a31fc05da4e9d5a0465c36822e2f,    $vbfa030fe63bacd523dd70a76cfaed98a,    $v0330da281541887f65b0a60066351c91   ];}protected function loadSystemHeaders() {$this->nameList = [    'id',    'name',    'type-id',    'is-active',    'template-id',    'parent-id',    'alt-name'   ];$this->titleList = [    getLabel('csv-property-id', 'exchange'),    getLabel('csv-property-name', 'exchange'),    getLabel('csv-property-type-id', 'exchange'),    getLabel('csv-property-is-active', 'exchange'),    getLabel('csv-property-template-id', 'exchange'),    getLabel('csv-property-parent-id', 'exchange'),    getLabel('csv-property-alt-name', 'exchange'),   ];$this->typeList = [    'native',    'native',    'native',    'native',    'native',    'native',    'native',   ];}protected function updateEntityIdList() {$v5eea05ab0d82b078d8a475d469cc3645 = array_keys($this->exporter->getExportedElements());$this->entityIdList = array_diff($this->entityIdList, $v5eea05ab0d82b078d8a475d469cc3645);if (!$this->shouldFlushToBuffer) {$this->saveEntityIdList();}}protected function saveEntityIdList() {if (umiCount($this->entityIdList)) {file_put_contents($this->entityIdListFilePath, serialize($this->entityIdList));}elseif (file_exists($this->entityIdListFilePath)) {unlink($this->entityIdListFilePath);}}private function loadHeaders() {$v78b145c82f40fdfd1c994f0e9f1dd689 = $this->getTemporaryFile();if ($v78b145c82f40fdfd1c994f0e9f1dd689->isReadable()) {list(     $this->nameList,     $this->titleList,     $this->typeList     ) = unserialize($v78b145c82f40fdfd1c994f0e9f1dd689->getContent());}else {$this->loadSystemHeaders();}}private function getTemporaryFile() {return new umiFile($this->getTemporaryFilePath());}private function getTemporaryFilePath() {return "{$this->csvFilePath}.tmp";}private function getPropertyType(DOMElement $v1a8db4c996d8ed8289da5f957879ab94) {$v599dcce2998a6b40b1e38e8c6006cb0a = $v1a8db4c996d8ed8289da5f957879ab94->getAttribute('type');if ($v599dcce2998a6b40b1e38e8c6006cb0a == 'relation') {if ($v1a8db4c996d8ed8289da5f957879ab94->hasAttribute('multiple') && $v1a8db4c996d8ed8289da5f957879ab94->getAttribute('multiple') == 'multiple') {$v599dcce2998a6b40b1e38e8c6006cb0a = 'multiple-relation';}}return $v599dcce2998a6b40b1e38e8c6006cb0a;}private function getPropertyValue(DOMElement $v1a8db4c996d8ed8289da5f957879ab94) {switch ($this->getPropertyType($v1a8db4c996d8ed8289da5f957879ab94)) {case 'relation' :    case 'multiple-relation' : {return $this->getRelationValue($v1a8db4c996d8ed8289da5f957879ab94);}case 'tags' : {return $v1a8db4c996d8ed8289da5f957879ab94->getElementsByTagName('combined')->item(0)->nodeValue;}case 'symlink' : {return $this->getSymlinkValue($v1a8db4c996d8ed8289da5f957879ab94);}case 'multiple_image' : {return $this->getMultipleImageValue($v1a8db4c996d8ed8289da5f957879ab94);}case 'multiple_file' : {return $this->getMultipleFileValue($v1a8db4c996d8ed8289da5f957879ab94);}case 'optioned' : {return $this->getOptionedValue($v1a8db4c996d8ed8289da5f957879ab94);}case 'domain_id' :    case 'domain_id_list' : {return $this->getDomainValue($v1a8db4c996d8ed8289da5f957879ab94);}case 'lang_id' :    case 'lang_id_list' : {return $this->getLangValue($v1a8db4c996d8ed8289da5f957879ab94);}case 'price_type_id' : {return $this->getPriceValue($v1a8db4c996d8ed8289da5f957879ab94);}default : {return $v1a8db4c996d8ed8289da5f957879ab94->getElementsByTagName('value')->item(0)->nodeValue;}}}private function getRelationValue(DOMElement $v1a8db4c996d8ed8289da5f957879ab94) {$va8998c31a141924d06220074fcdc6925 = [];$vf390d9ed4004a4e088e29464c661f362 = $v1a8db4c996d8ed8289da5f957879ab94->getElementsByTagName('value')->item(0);foreach ($vf390d9ed4004a4e088e29464c661f362->getElementsByTagName('item') as $v399a75af3a8a951a74e76f096d19233b) {$va8998c31a141924d06220074fcdc6925[] = $v399a75af3a8a951a74e76f096d19233b->getAttribute('name');}return $this->joinMultipleValues($va8998c31a141924d06220074fcdc6925);}private function getDomainValue(DOMElement $v1a8db4c996d8ed8289da5f957879ab94) {$vf390d9ed4004a4e088e29464c661f362 = $v1a8db4c996d8ed8289da5f957879ab94->getElementsByTagName('value')->item(0);$vad5658491d1cbf0909b631e0cc6d938d = [];foreach ($vf390d9ed4004a4e088e29464c661f362->getElementsByTagName('domain') as $v204aadf644884156d194b4fccb7a101a) {$vad5658491d1cbf0909b631e0cc6d938d[] = $v204aadf644884156d194b4fccb7a101a->getAttribute('id');}return $this->joinMultipleValues($vad5658491d1cbf0909b631e0cc6d938d);}private function getLangValue(DOMElement $v1a8db4c996d8ed8289da5f957879ab94) : string {$vf390d9ed4004a4e088e29464c661f362 = $v1a8db4c996d8ed8289da5f957879ab94->getElementsByTagName('value')->item(0);$vf032f38a0a5e72a1ea0c68c0d749420d = [];foreach ($vf390d9ed4004a4e088e29464c661f362->getElementsByTagName('lang') as $va24bcccab40205d7e681050e137f6c99) {$vf032f38a0a5e72a1ea0c68c0d749420d[] = $va24bcccab40205d7e681050e137f6c99->getAttribute('id');}return $this->joinMultipleValues($vf032f38a0a5e72a1ea0c68c0d749420d);}private function getPriceValue(DOMElement $v1a8db4c996d8ed8289da5f957879ab94) : string {$vf390d9ed4004a4e088e29464c661f362 = $v1a8db4c996d8ed8289da5f957879ab94->getElementsByTagName('value')->item(0);$va1d142944e9cba6406475f5dfcd47acc = [];foreach ($vf390d9ed4004a4e088e29464c661f362->getElementsByTagName('price') as $vf9c7b97d3a988fd98bfac3ce0b9b9fe2) {$va1d142944e9cba6406475f5dfcd47acc[] = $vf9c7b97d3a988fd98bfac3ce0b9b9fe2->getAttribute('id');}return $this->joinMultipleValues($va1d142944e9cba6406475f5dfcd47acc);}private function joinMultipleValues($vf09cc7ee3a9a93273f4b80601cafb00c) {return implode($this->valueDelimiter, $vf09cc7ee3a9a93273f4b80601cafb00c);}private function getSymlinkValue(DOMElement $v1a8db4c996d8ed8289da5f957879ab94) {$vbf516925bb37a8544c8ee19a24e15c05 = [];$vf390d9ed4004a4e088e29464c661f362 = $v1a8db4c996d8ed8289da5f957879ab94->getElementsByTagName('value')->item(0);foreach ($vf390d9ed4004a4e088e29464c661f362->getElementsByTagName('page') as $v77f3c48f175369c446fbe421012437c2) {$vbf516925bb37a8544c8ee19a24e15c05[] = $v77f3c48f175369c446fbe421012437c2->getAttribute('id');}return $this->joinMultipleValues($vbf516925bb37a8544c8ee19a24e15c05);}private function getMultipleImageValue(DOMElement $v1a8db4c996d8ed8289da5f957879ab94) {return $this->getMultipleFieldValue($v1a8db4c996d8ed8289da5f957879ab94, $this->getMultipleFileParts(umiImageFile::ATTRIBUTE_LIST));}private function getMultipleFileValue(DOMElement $v1a8db4c996d8ed8289da5f957879ab94) {return $this->getMultipleFieldValue(    $v1a8db4c996d8ed8289da5f957879ab94,    $this->getMultipleFileParts(umiFile::ATTRIBUTE_LIST)   );}private function getMultipleFileParts(array $v73dd6a55a335c14650672e5e6afbfbc6) {array_unshift($v73dd6a55a335c14650672e5e6afbfbc6, 'path');return $v73dd6a55a335c14650672e5e6afbfbc6;}private function getMultipleFieldValue(DOMElement $v1a8db4c996d8ed8289da5f957879ab94, $v78f0805fa8ffadabda721fdaf85b3ca9) {$v421c6d4b77d20cf11887369c1f9afb63 = [];foreach ($v1a8db4c996d8ed8289da5f957879ab94->getElementsByTagName('value') as $vf390d9ed4004a4e088e29464c661f362) {$v92e849f0601bac63516394431fed2027 = [];foreach ($v78f0805fa8ffadabda721fdaf85b3ca9 as $vfdaa6579f11df4e8b3c095f7589e36d2) {$v92e849f0601bac63516394431fed2027[] = $this->makePart($vfdaa6579f11df4e8b3c095f7589e36d2, $vf390d9ed4004a4e088e29464c661f362->getAttribute($vfdaa6579f11df4e8b3c095f7589e36d2));}$v421c6d4b77d20cf11887369c1f9afb63[] = $this->joinMultipleParts($v92e849f0601bac63516394431fed2027);}return $this->joinMultipleValues($v421c6d4b77d20cf11887369c1f9afb63);}private function makePart($vb068931cc450442b63f5b3d276ea4297, $v2063c1608d6e0baf80249c42e2be5804) {return "{$vb068931cc450442b63f5b3d276ea4297}{$this->subPartDelimiter}{$v2063c1608d6e0baf80249c42e2be5804}";}private function joinMultipleParts($v78f0805fa8ffadabda721fdaf85b3ca9) {return implode($this->partDelimiter, $v78f0805fa8ffadabda721fdaf85b3ca9);}private function getOptionedValue($v1a8db4c996d8ed8289da5f957879ab94) {$v93da65a9fd0004d9477aeac024e08e15 = [];foreach ($v1a8db4c996d8ed8289da5f957879ab94->getElementsByTagName('option') as $vc3660ff61995c9ac9ac147882e39bb2e) {$v93da65a9fd0004d9477aeac024e08e15[] = $this->getOption($vc3660ff61995c9ac9ac147882e39bb2e);}return $this->joinMultipleValues($v93da65a9fd0004d9477aeac024e08e15);}private function getOption(DOMElement $vc3660ff61995c9ac9ac147882e39bb2e) {$v16b2b26000987faccb260b9d39df1269 = '';$vee6278ff125d6d0144e62695c0e35f2f = $vc3660ff61995c9ac9ac147882e39bb2e->getElementsByTagName('object');if ($vee6278ff125d6d0144e62695c0e35f2f->length > 0) {$v16b2b26000987faccb260b9d39df1269 = $vee6278ff125d6d0144e62695c0e35f2f->item(0)->getAttribute('id');}$va6eb4816205178e88dad66a16a19ff45 = '';$v93df78318b2494c10566a2c4c069084d = $vc3660ff61995c9ac9ac147882e39bb2e->getElementsByTagName('page');if ($v93df78318b2494c10566a2c4c069084d->length > 0) {$va6eb4816205178e88dad66a16a19ff45 = $v93df78318b2494c10566a2c4c069084d->item(0)->getAttribute('id');}$v78f0805fa8ffadabda721fdaf85b3ca9 = [    $this->makePart('object-id', $v16b2b26000987faccb260b9d39df1269),    $this->makePart('page-id', $va6eb4816205178e88dad66a16a19ff45)   ];foreach (self::OPTIONED_PARTS as $vfdaa6579f11df4e8b3c095f7589e36d2) {$v2063c1608d6e0baf80249c42e2be5804 = '';if ($vc3660ff61995c9ac9ac147882e39bb2e->hasAttribute($vfdaa6579f11df4e8b3c095f7589e36d2)) {$v2063c1608d6e0baf80249c42e2be5804 = $vc3660ff61995c9ac9ac147882e39bb2e->getAttribute($vfdaa6579f11df4e8b3c095f7589e36d2);}$v78f0805fa8ffadabda721fdaf85b3ca9[] = $this->makePart($vfdaa6579f11df4e8b3c095f7589e36d2, $v2063c1608d6e0baf80249c42e2be5804);}return $this->joinMultipleParts($v78f0805fa8ffadabda721fdaf85b3ca9);}private function appendPropertyToHeaders(DOMElement $v1a8db4c996d8ed8289da5f957879ab94) {$vb068931cc450442b63f5b3d276ea4297 = $v1a8db4c996d8ed8289da5f957879ab94->getAttribute('name');$vd5d3db1765287eef77d7927cc956f50a = $v1a8db4c996d8ed8289da5f957879ab94->getElementsByTagName('title')->item(0)->nodeValue;$v599dcce2998a6b40b1e38e8c6006cb0a = $this->getPropertyType($v1a8db4c996d8ed8289da5f957879ab94);$this->nameList[] = $vb068931cc450442b63f5b3d276ea4297;$v6a992d5529f459a44fee58c733255e86 = (int) array_search($vb068931cc450442b63f5b3d276ea4297, $this->nameList);$this->titleList[$v6a992d5529f459a44fee58c733255e86] = $vd5d3db1765287eef77d7927cc956f50a;$this->typeList[$v6a992d5529f459a44fee58c733255e86] = $v599dcce2998a6b40b1e38e8c6006cb0a;return $v6a992d5529f459a44fee58c733255e86;}private function normalizeProperties($vca3a34ad419c2f783bc2dbda90d53c41) {foreach (array_keys($this->nameList) as $v6a992d5529f459a44fee58c733255e86) {if (array_key_exists($v6a992d5529f459a44fee58c733255e86, $vca3a34ad419c2f783bc2dbda90d53c41)) {$vca3a34ad419c2f783bc2dbda90d53c41[$v6a992d5529f459a44fee58c733255e86] = str_replace(      self::VALUE_LIMITER,      str_repeat(self::VALUE_LIMITER, 2),      $vca3a34ad419c2f783bc2dbda90d53c41[$v6a992d5529f459a44fee58c733255e86]     );}else {$vca3a34ad419c2f783bc2dbda90d53c41[$v6a992d5529f459a44fee58c733255e86] = '';}}ksort($vca3a34ad419c2f783bc2dbda90d53c41);return $vca3a34ad419c2f783bc2dbda90d53c41;}private function saveHeaders() {$v78b145c82f40fdfd1c994f0e9f1dd689 = $this->getTemporaryFile();$v78b145c82f40fdfd1c994f0e9f1dd689->putContent(serialize([    $this->nameList,    $this->titleList,    $this->typeList,   ]));}private function appendRowsToCsvFile($vca3a34ad419c2f783bc2dbda90d53c41) {$vb1e3840c73bd1d04e68740c009214532 = fopen($this->csvFilePath, 'a');foreach ($vca3a34ad419c2f783bc2dbda90d53c41 as $v97803fd35518c3d5a9c2c8d13e72649c) {$vf1965a857bc285d26fe22023aa5ab50d = $this->makeRow($v97803fd35518c3d5a9c2c8d13e72649c);fwrite($vb1e3840c73bd1d04e68740c009214532, $vf1965a857bc285d26fe22023aa5ab50d);}fclose($vb1e3840c73bd1d04e68740c009214532);}private function makeRow(array $vca3a34ad419c2f783bc2dbda90d53c41) {$v528d3a0db57c788c744aed5a2ee9f5c8 = self::VALUE_LIMITER . $this->propertyDelimiter . self::VALUE_LIMITER;$vf1965a857bc285d26fe22023aa5ab50d = self::VALUE_LIMITER . implode($v528d3a0db57c788c744aed5a2ee9f5c8, $vca3a34ad419c2f783bc2dbda90d53c41) . self::VALUE_LIMITER . PHP_EOL;return mb_convert_encoding($vf1965a857bc285d26fe22023aa5ab50d, $this->encoding, self::SOURCE_ENCODING);}private function determineCompleteness() {$this->completed = (umiCount($this->entityIdList) === 0);}private function writeFinalCsvFile() {$v326d80402937806ee3bae32d611f46ba = (array) unserialize($this->getTemporaryFile()->getContent());$v42af7230c5ddf8d265743ac4a058047a = fopen($this->getTemporaryFilePath(), 'w');foreach ($v326d80402937806ee3bae32d611f46ba as $vca3a34ad419c2f783bc2dbda90d53c41) {$vf1965a857bc285d26fe22023aa5ab50d = $this->makeRow($vca3a34ad419c2f783bc2dbda90d53c41);fwrite($v42af7230c5ddf8d265743ac4a058047a, $vf1965a857bc285d26fe22023aa5ab50d);}$vb1e3840c73bd1d04e68740c009214532 = fopen($this->csvFilePath, 'r');while (!feof($vb1e3840c73bd1d04e68740c009214532)) {$vf1965a857bc285d26fe22023aa5ab50d = $this->findNextRowInCsvFile($vb1e3840c73bd1d04e68740c009214532);fwrite($v42af7230c5ddf8d265743ac4a058047a, $vf1965a857bc285d26fe22023aa5ab50d);}fclose($v42af7230c5ddf8d265743ac4a058047a);fclose($vb1e3840c73bd1d04e68740c009214532);unlink($this->csvFilePath);rename($this->getTemporaryFilePath(), $this->csvFilePath);chmod($this->csvFilePath, 0777);}private function findNextRowInCsvFile($v8c7dd922ad47494fc02c388e12c00eac) {$vf81a20fe8d8fe604339c0f1e29f4e1b5 = '';do {$vf81a20fe8d8fe604339c0f1e29f4e1b5 .= (string) fgets($v8c7dd922ad47494fc02c388e12c00eac);}while (!feof($v8c7dd922ad47494fc02c388e12c00eac) && !$this->isValidRow($vf81a20fe8d8fe604339c0f1e29f4e1b5));return $vf81a20fe8d8fe604339c0f1e29f4e1b5;}private function isValidRow($vf1965a857bc285d26fe22023aa5ab50d) {return mb_substr_count($vf1965a857bc285d26fe22023aa5ab50d, self::VALUE_LIMITER) % 2 == 0;}}