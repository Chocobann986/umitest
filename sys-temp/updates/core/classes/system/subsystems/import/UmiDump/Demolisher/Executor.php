<?php
 namespace UmiCms\System\Import\UmiDump\Demolisher;use UmiCms\System\Import\UmiDump\Demolisher\Type\iFactory;class Executor implements iExecutor, iFileSystem {private $parser;private $factory;private $rootPath;private $sourceId;private $log = [];public function __construct(iFactory $v9549dd6065d019211460c59a86dd6536) {$this->factory = $v9549dd6065d019211460c59a86dd6536;}public function run(\DOMXPath $v3643b86326b2ffcc0a085b4dd3a4309b) {$this->setParser($v3643b86326b2ffcc0a085b4dd3a4309b);foreach ($this->getManifest() as $vb068931cc450442b63f5b3d276ea4297 => $vfa11901883035fbe7d80836be38ff5cf) {foreach ($vfa11901883035fbe7d80836be38ff5cf as $v3d788fa62d7c185a1bee4c9147ee1091) {if ($this->nodeExists($v3d788fa62d7c185a1bee4c9147ee1091)) {$this->execute($vb068931cc450442b63f5b3d276ea4297);continue 2;}}}$vdc1d71bbb5c4d2a5e936db79ef10c19f = $this->getLog();$this->clearLog();return $vdc1d71bbb5c4d2a5e936db79ef10c19f;}public function setRootPath($vd6fe1d0be6347b8ef2427fa629c04485) {$this->rootPath = $vd6fe1d0be6347b8ef2427fa629c04485;return $this;}public function setSourceId($vb80bb7740288fda1f201890375a60c8f) {$this->sourceId = (int) $vb80bb7740288fda1f201890375a60c8f;return $this;}private function getSourceId() {return $this->sourceId;}private function setParser(\DOMXPath $v3643b86326b2ffcc0a085b4dd3a4309b) {$this->parser = $v3643b86326b2ffcc0a085b4dd3a4309b;return $this;}private function getManifest() {return [    'File' => [     '/umidump/files/file'    ],    'Directory' => [     '/umidump/directories/directory'    ],    'Field' => [     '/umidump/types/type/fieldgroups/group/field',     '/umidump/pages/page/properties/group/property',     '/umidump/objects/object/properties/group/property'    ],    'FieldGroup' => [     '/umidump/types/type/fieldgroups/group',     '/umidump/pages/page/properties/group',     '/umidump/objects/object/properties/group'    ],    'Permission' => [     '/umidump/permissions/permission'    ],    'Object' => [     '/umidump/objects/object'    ],    'ObjectType' => [     '/umidump/types/type'    ],    'Page' => [     '/umidump/pages/page'    ],    'Domain' => [     '/umidump/domains/domain'    ],    'Template' => [     '/umidump/templates/template'    ],    'Language' => [     '/umidump/langs/lang'    ],    'Registry' => [     '/umidump/registry/key'    ],    'Entity' => [     '/umidump/entities/entity'    ],    'Restriction' => [     '/umidump/restrictions/restriction'    ]   ];}private function nodeExists($v3d788fa62d7c185a1bee4c9147ee1091) {return $this->getParser()     ->query($v3d788fa62d7c185a1bee4c9147ee1091)->length > 0;}private function execute($vb068931cc450442b63f5b3d276ea4297) {try {$v01785e53d949d6df885f78b3939831f2 = $this->getFactory()     ->create($vb068931cc450442b63f5b3d276ea4297);if ($v01785e53d949d6df885f78b3939831f2 instanceof iFileSystem) {$v01785e53d949d6df885f78b3939831f2->setRootPath($this->getRootPath());}$v01785e53d949d6df885f78b3939831f2->setSourceId($this->getSourceId());$vdc1d71bbb5c4d2a5e936db79ef10c19f = $v01785e53d949d6df885f78b3939831f2->run($this->getParser());$this->mergeLog($vdc1d71bbb5c4d2a5e936db79ef10c19f);}catch (\Exception $v42552b1f133f9f8eb406d4f306ea9fd1) {$this->pushLog($v42552b1f133f9f8eb406d4f306ea9fd1->getMessage());}}private function getParser() {return $this->parser;}private function getFactory() {return $this->factory;}private function getLog() {return $this->log;}private function mergeLog(array $vdc1d71bbb5c4d2a5e936db79ef10c19f) {$this->log = array_merge($this->log, $vdc1d71bbb5c4d2a5e936db79ef10c19f);return $this;}private function clearLog() {$this->log = [];return $this;}private function pushLog($v78e731027d8fd50ed642340b7c9a63b3) {$this->log[] = $v78e731027d8fd50ed642340b7c9a63b3;return $this;}private function getRootPath() {return $this->rootPath;}}