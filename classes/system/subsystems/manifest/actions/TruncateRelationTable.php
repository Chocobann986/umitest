<?php
 namespace UmiCms\Manifest\Migrate\Object\Type\Hierarchy;use UmiCms\Service;use UmiCms\System\Data\Object\Type\Hierarchy\Relation\iRepository;class TruncateRelationTableAction extends \Action {public function execute() {$this->getRepository()    ->deleteAll();return $this;}public function rollback() {return $this;}private function getRepository() {return Service::get('ObjectTypeHierarchyRelationRepository');}}