<?php
 class selectorType {protected static $typeClasses = ['object-type', 'hierarchy-type'];public $objectTypeIds;public $hierarchyTypeIds;protected $typeClass;public function __construct($v2dda916891cbd0bf046213df34800783) {$this->setTypeClass($v2dda916891cbd0bf046213df34800783);}public function name($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce) {if (!$vea9f6aca279138c58f705c8d4cb4b8ce && $v22884db148f0ffb0d830ba431102b0b5 == 'content') {$vea9f6aca279138c58f705c8d4cb4b8ce = 'page';}$vb4c6fdbf208f0b52aa890f557924560b = umiTypesHelper::getInstance();switch ($this->typeClass) {case 'object-type': {$vb4c6fdbf208f0b52aa890f557924560b->getFieldsByHierarchyTypeName($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce);$vacf567c9c3d6cf7c6e2cc0ce108e0631 = $vb4c6fdbf208f0b52aa890f557924560b->getHierarchyTypeIdByName($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce);if (!$vacf567c9c3d6cf7c6e2cc0ce108e0631) {throw new selectorException(__METHOD__ . ": Hierarchy type ($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce) not found");}$vb362c8a2bf496fcf6326e4880501fc24 = $vb4c6fdbf208f0b52aa890f557924560b->getObjectTypesIdsByHierarchyTypeId($vacf567c9c3d6cf7c6e2cc0ce108e0631);if (!is_array($vb362c8a2bf496fcf6326e4880501fc24) || umiCount($vb362c8a2bf496fcf6326e4880501fc24) == 0) {throw new selectorException(       __METHOD__ . ": Object types ids by hierarchy type ($vacf567c9c3d6cf7c6e2cc0ce108e0631) not found"      );}$this->setObjectTypeIds($vb362c8a2bf496fcf6326e4880501fc24);break;}case 'hierarchy-type': {$vb4c6fdbf208f0b52aa890f557924560b->getFieldsByHierarchyTypeName($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce);$vacf567c9c3d6cf7c6e2cc0ce108e0631 = $vb4c6fdbf208f0b52aa890f557924560b->getHierarchyTypeIdByName($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce);if (!$vacf567c9c3d6cf7c6e2cc0ce108e0631) {throw new selectorException(__METHOD__ . ": Hierarchy type ($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce) not found");}$this->setHierarchyTypeIds($vacf567c9c3d6cf7c6e2cc0ce108e0631);break;}}}public function id($vb80bb7740288fda1f201890375a60c8f) {if (!is_numeric($vb80bb7740288fda1f201890375a60c8f) && is_string($vb80bb7740288fda1f201890375a60c8f)) {$this->guid($vb80bb7740288fda1f201890375a60c8f);return;}if (!is_array($vb80bb7740288fda1f201890375a60c8f)) {$vb80bb7740288fda1f201890375a60c8f = [$vb80bb7740288fda1f201890375a60c8f];}$vb80bb7740288fda1f201890375a60c8f = array_map('intval', $vb80bb7740288fda1f201890375a60c8f);$vb4c6fdbf208f0b52aa890f557924560b = umiTypesHelper::getInstance();switch ($this->typeClass) {case 'object-type': {$vb4c6fdbf208f0b52aa890f557924560b->getFieldsByObjectTypeIds($vb80bb7740288fda1f201890375a60c8f);$this->setObjectTypeIds($vb80bb7740288fda1f201890375a60c8f);break;}case 'hierarchy-type': {$vb4c6fdbf208f0b52aa890f557924560b->getFieldsByHierarchyTypeId($vb80bb7740288fda1f201890375a60c8f);$this->setHierarchyTypeIds($vb80bb7740288fda1f201890375a60c8f);break;}}}public function guid($v1e0ca5b1252f1f6b1e0ac91be7e7219e) {if ($this->typeClass != 'object-type') {throw new selectorException('Select by guid is allowed only for object-type');}$vb4c6fdbf208f0b52aa890f557924560b = umiTypesHelper::getInstance();$vb4c6fdbf208f0b52aa890f557924560b->getFieldsByObjectTypeGuid($v1e0ca5b1252f1f6b1e0ac91be7e7219e);$vedd732576deff36586bca5dc47bac0b9 = $v1e0ca5b1252f1f6b1e0ac91be7e7219e;if (!is_array($v1e0ca5b1252f1f6b1e0ac91be7e7219e)) {$v1e0ca5b1252f1f6b1e0ac91be7e7219e = [$v1e0ca5b1252f1f6b1e0ac91be7e7219e];}$vb362c8a2bf496fcf6326e4880501fc24 = [];foreach ($v1e0ca5b1252f1f6b1e0ac91be7e7219e as $v2063c1608d6e0baf80249c42e2be5804) {$v5f694956811487225d15e973ca38fbab = $vb4c6fdbf208f0b52aa890f557924560b->getObjectTypeIdByGuid($v2063c1608d6e0baf80249c42e2be5804);if (is_numeric($v5f694956811487225d15e973ca38fbab)) {$vb362c8a2bf496fcf6326e4880501fc24[] = $v5f694956811487225d15e973ca38fbab;}}if (!is_array($vb362c8a2bf496fcf6326e4880501fc24) || umiCount($vb362c8a2bf496fcf6326e4880501fc24) == 0) {throw new selectorException(__METHOD__ . ": Object types ids by guid ({$vedd732576deff36586bca5dc47bac0b9}) not found");}$this->setObjectTypeIds($vb362c8a2bf496fcf6326e4880501fc24);}public function setTypeClass($v2dda916891cbd0bf046213df34800783) {if (in_array($v2dda916891cbd0bf046213df34800783, self::$typeClasses)) {$this->typeClass = $v2dda916891cbd0bf046213df34800783;}else {throw new selectorException(     "Unknown type class \"{$v2dda916891cbd0bf046213df34800783}\". These types are only supported: " .     implode(', ', self::$typeClasses)    );}}public function getFieldsId($v972bf3f05d14ffbdb817bef60638ff00) {if ($this->objectTypeIds === null && $this->hierarchyTypeIds === null) {throw new selectorException("Object and hierarchy type prop can't be empty both");}$vb4c6fdbf208f0b52aa890f557924560b = umiTypesHelper::getInstance();$v5bf771c31a2488978f269aface6f7a45 = [];if ($this->objectTypeIds !== null) {$v1d9ca8ac8fadf7458b35864a0c1d929c = $vb4c6fdbf208f0b52aa890f557924560b->getFieldsByObjectTypeIds($this->objectTypeIds);foreach ($this->objectTypeIds as $vb80bb7740288fda1f201890375a60c8f) {if (isset($v1d9ca8ac8fadf7458b35864a0c1d929c[$vb80bb7740288fda1f201890375a60c8f][$v972bf3f05d14ffbdb817bef60638ff00])) {$v5bf771c31a2488978f269aface6f7a45[] = $v1d9ca8ac8fadf7458b35864a0c1d929c[$vb80bb7740288fda1f201890375a60c8f][$v972bf3f05d14ffbdb817bef60638ff00];}}}if ($this->hierarchyTypeIds !== null) {foreach ($this->hierarchyTypeIds as $vacf567c9c3d6cf7c6e2cc0ce108e0631) {$vb362c8a2bf496fcf6326e4880501fc24 = $vb4c6fdbf208f0b52aa890f557924560b->getObjectTypesIdsByHierarchyTypeId($vacf567c9c3d6cf7c6e2cc0ce108e0631);$v1d9ca8ac8fadf7458b35864a0c1d929c = $vb4c6fdbf208f0b52aa890f557924560b->getFieldsByObjectTypeIds($vb362c8a2bf496fcf6326e4880501fc24);foreach ($vb362c8a2bf496fcf6326e4880501fc24 as $vb80bb7740288fda1f201890375a60c8f) {if (isset($v1d9ca8ac8fadf7458b35864a0c1d929c[$vb80bb7740288fda1f201890375a60c8f][$v972bf3f05d14ffbdb817bef60638ff00])) {$v5bf771c31a2488978f269aface6f7a45[] = $v1d9ca8ac8fadf7458b35864a0c1d929c[$vb80bb7740288fda1f201890375a60c8f][$v972bf3f05d14ffbdb817bef60638ff00];}}}}$v5bf771c31a2488978f269aface6f7a45 = array_unique($v5bf771c31a2488978f269aface6f7a45);$v5dd67387c8a5c3b1ee8a5d22936011f6 = umiCount($v5bf771c31a2488978f269aface6f7a45);if ($v5dd67387c8a5c3b1ee8a5d22936011f6 === 0) {return false;}return array_values($v5bf771c31a2488978f269aface6f7a45);}protected function setObjectTypeIds($vb362c8a2bf496fcf6326e4880501fc24) {if (!is_array($vb362c8a2bf496fcf6326e4880501fc24)) {$vb362c8a2bf496fcf6326e4880501fc24 = [$vb362c8a2bf496fcf6326e4880501fc24];}if ($this->objectTypeIds === null) {$this->objectTypeIds = $vb362c8a2bf496fcf6326e4880501fc24;}else {$this->objectTypeIds = array_unique(array_merge($this->objectTypeIds, $vb362c8a2bf496fcf6326e4880501fc24));}}protected function setHierarchyTypeIds($vda80b9ab86c2d00b85de0cf003cb3e6e) {if (!is_array($vda80b9ab86c2d00b85de0cf003cb3e6e)) {$vda80b9ab86c2d00b85de0cf003cb3e6e = [$vda80b9ab86c2d00b85de0cf003cb3e6e];}if ($this->hierarchyTypeIds === null) {$this->hierarchyTypeIds = $vda80b9ab86c2d00b85de0cf003cb3e6e;}else {$this->hierarchyTypeIds = array_unique(array_merge($this->hierarchyTypeIds, $vda80b9ab86c2d00b85de0cf003cb3e6e));}}}