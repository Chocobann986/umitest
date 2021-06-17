<?php
 namespace UmiCms\Manifest\Migrate\Object\Type\Hierarchy;use UmiCms\Service;use UmiCms\System\Data\Object\Type\Hierarchy\Relation\iMigration;use UmiCms\System\Data\Object\Type\Hierarchy\Relation\iRepository;class FillRelationTableAction extends \IterableAction {const LIMIT = 150;public function execute() {$v7a86c157ee9713c34fbd7a1ee40f0c5a = $this->getOffset();$vcdf2f9a75b780b60fc57b2514f71ef49 = \umiObjectTypesCollection::getInstance()    ->getIdList(self::LIMIT, $v7a86c157ee9713c34fbd7a1ee40f0c5a);$vb439f9bbe0a4c866b54c7399f0d21e37 = $this->getMigration();foreach ($vcdf2f9a75b780b60fc57b2514f71ef49 as $v5f694956811487225d15e973ca38fbab) {$vb439f9bbe0a4c866b54c7399f0d21e37->migrate($v5f694956811487225d15e973ca38fbab);}$this->setOffset(self::LIMIT + $v7a86c157ee9713c34fbd7a1ee40f0c5a);if (isEmptyArray($vcdf2f9a75b780b60fc57b2514f71ef49)) {$this->setIsReady();$this->resetState();}$this->saveState();return $this;}public function rollback() {$this->getRepository()    ->deleteAll();return $this;}protected function getStartState() {return [    'offset' => 0   ];}private function getOffset() {$v7a86c157ee9713c34fbd7a1ee40f0c5a = $this->getStatePart('offset');return is_numeric($v7a86c157ee9713c34fbd7a1ee40f0c5a) ? $v7a86c157ee9713c34fbd7a1ee40f0c5a : 0;}private function setOffset($v7a86c157ee9713c34fbd7a1ee40f0c5a) {return $this->setStatePart('offset', $v7a86c157ee9713c34fbd7a1ee40f0c5a);}private function getMigration() {return Service::get('ObjectTypeHierarchyRelationMigration');}private function getRepository() {return Service::get('ObjectTypeHierarchyRelationRepository');}}