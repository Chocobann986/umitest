<?php
 namespace UmiCms\System\Trade\Offer;use UmiCms\System\Orm\iEntity;use UmiCms\System\Trade\iOffer;use UmiCms\System\Orm\Entity\Repository as AbstractRepository;class Repository extends AbstractRepository implements iRepository {const NEXT_ORDER_STEP = 100;public function save(iEntity $vd60db28d94d538bbb249dcc7f2273ab1) {if (!$this->isValidEntity($vd60db28d94d538bbb249dcc7f2273ab1)) {throw new \ErrorException('Incorrect entity given');}if (!$vd60db28d94d538bbb249dcc7f2273ab1->hasId() && !$vd60db28d94d538bbb249dcc7f2273ab1->hasOrder()) {$v88268c4937b86c4e794288845b28f9ce = $this->calculateOrder($vd60db28d94d538bbb249dcc7f2273ab1->getTypeId());$vd60db28d94d538bbb249dcc7f2273ab1->setOrder($v88268c4937b86c4e794288845b28f9ce);}parent::save($vd60db28d94d538bbb249dcc7f2273ab1);return $vd60db28d94d538bbb249dcc7f2273ab1;}private function calculateOrder($v5f694956811487225d15e973ca38fbab) {$vaab9e1de16f38176f86d7a92ba337a8d = $this->getTable();$v5f694956811487225d15e973ca38fbab = (int) $v5f694956811487225d15e973ca38fbab;$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
SELECT max(`order`) as `order` FROM `$vaab9e1de16f38176f86d7a92ba337a8d` WHERE `type_id` = $v5f694956811487225d15e973ca38fbab;
SQL;   $vfdb3edaa55b2188691aaf3feb74566f2 = $this->getConnection()    ->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a)    ->setFetchAssoc()    ->fetch();$vae3e3650003133da0771a2e25f39d61f = $vfdb3edaa55b2188691aaf3feb74566f2['order'] ?: 0;return $vae3e3650003133da0771a2e25f39d61f + self::NEXT_ORDER_STEP;}protected function isValidEntity($vf5e638cc78dd325906c1298a0c21fb6b) {return $vf5e638cc78dd325906c1298a0c21fb6b instanceof iOffer;}}