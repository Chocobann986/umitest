<?php
 namespace UmiCms\System\Trade\Offer\Price\Type;use UmiCms\System\Orm\iEntity;use UmiCms\System\Trade\Offer\Price\iType;use UmiCms\System\Orm\Entity\iFacade as iAbstractFacade;use UmiCms\System\Trade\Offer\Price\Type\iCollection as iTypeCollection;interface iFacade extends iAbstractFacade {public function get($vb80bb7740288fda1f201890375a60c8f);public function getByName($vb068931cc450442b63f5b3d276ea4297);public function getList(array $v5a2576254d428ddc22a03fac145c8749);public function getDefault();public function setDefault(iType $v599dcce2998a6b40b1e38e8c6006cb0a);public function getCollectionBy($vb068931cc450442b63f5b3d276ea4297, $v2063c1608d6e0baf80249c42e2be5804);public function getCollectionByValueList($vb068931cc450442b63f5b3d276ea4297, array $v993fcb1e163e40a45771f626d3ea0f0f);public function mapCollection(array $va9e2e7908a1f06effc849966dcf44b1c);public function create(array $v6dd047148d685270458ecc44ee128a4d = []);public function save(iEntity $v78a5eb43deef9a7b5b9ce157b9d52ac4);public function delete($vb80bb7740288fda1f201890375a60c8f);public function isExists(int $vb80bb7740288fda1f201890375a60c8f) : bool;}