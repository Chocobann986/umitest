<?php
 namespace UmiCms\System\Data\Object\Type\Hierarchy\Relation;use UmiCms\System\Data\Object\Type\Hierarchy\iRelation;interface iRepository {public function __construct(\IConnection $v4717d53ebfdfea8477f780ec66151dcb, iFactory $v9549dd6065d019211460c59a86dd6536);public function getChildList($v0b6849d57acb5403d1e63cce49f86ed5);public function getChildListWithDomain($v0b6849d57acb5403d1e63cce49f86ed5, $v72ee76c5c29383b7c9f9225c1fa4d10b);public function getNearestChildIdList($v0b6849d57acb5403d1e63cce49f86ed5);public function getNearestChildIdListWithDomain($v0b6849d57acb5403d1e63cce49f86ed5, $v72ee76c5c29383b7c9f9225c1fa4d10b);public function getNearestAncestorId($vf4f40123eb510dd3290125b38f4eb898);public function getChildListByAncestorIdList(array $v5a2576254d428ddc22a03fac145c8749);public function getAncestorList($vf4f40123eb510dd3290125b38f4eb898);public function createRecursively($v0b6849d57acb5403d1e63cce49f86ed5, $vf4f40123eb510dd3290125b38f4eb898);public function create($v0b6849d57acb5403d1e63cce49f86ed5, $vf4f40123eb510dd3290125b38f4eb898, $vc9e9a848920877e76685b2e4e76de38d);public function deleteInvolving($v5f694956811487225d15e973ca38fbab);public function deleteAll();}