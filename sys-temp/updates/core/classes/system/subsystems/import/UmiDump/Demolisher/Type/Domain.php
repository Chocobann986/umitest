<?php
 namespace UmiCms\System\Import\UmiDump\Demolisher\Type;use UmiCms\System\Import\UmiDump\Demolisher;class Domain extends Demolisher {private $domainCollection;public function __construct(\iDomainsCollection $v0d771fa031fb27561ed207afa6cf9983) {$this->domainCollection = $v0d771fa031fb27561ed207afa6cf9983;}protected function execute() {$vb508148712cb53958c7e3d25ec86d72a = $this->getSourceIdBinder();$v52195dae0174459c5f066fa0df053c26 = $this->getSourceId();$v0d771fa031fb27561ed207afa6cf9983 = $this->getDomainCollection();foreach ($this->getDomainExtIdList() as $v1fad63c9b56ba99b63a65cbfd3b3672a) {$vb80bb7740288fda1f201890375a60c8f = $vb508148712cb53958c7e3d25ec86d72a->getNewDomainIdRelation($v52195dae0174459c5f066fa0df053c26, $v1fad63c9b56ba99b63a65cbfd3b3672a);if ($vb80bb7740288fda1f201890375a60c8f === false || $vb508148712cb53958c7e3d25ec86d72a->isDomainRelatedToAnotherSource($v52195dae0174459c5f066fa0df053c26, $vb80bb7740288fda1f201890375a60c8f)) {$this->pushLog(sprintf('Domain "%s" was ignored', $v1fad63c9b56ba99b63a65cbfd3b3672a));continue;}$v0d771fa031fb27561ed207afa6cf9983->delDomain($vb80bb7740288fda1f201890375a60c8f);$this->pushLog(sprintf('Domain "%s" was deleted', $vb80bb7740288fda1f201890375a60c8f));}}private function getDomainExtIdList() {return $this->getNodeValueList('/umidump/domains/domain/@id');}private function getDomainCollection() {return $this->domainCollection;}}