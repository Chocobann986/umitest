<?php
 namespace UmiCms\System\Trade\Offer\Price;use UmiCms\System\Orm\iEntity;use UmiCms\System\Trade\Offer\iPrice;use UmiCms\System\Orm\Entity\Map\Sort;use UmiCms\System\Orm\Entity\Map\Filter;use UmiCms\System\Orm\Entity\iCollection as iAbstractCollection;interface iCollection extends iAbstractCollection {public function getList();public function get($vb80bb7740288fda1f201890375a60c8f);public function getFirst();public function getListBy($vb068931cc450442b63f5b3d276ea4297, $v2063c1608d6e0baf80249c42e2be5804, $vd4a6347717091debb166e768f315fcec = Filter::COMPARE_TYPE_EQUALS);public function getSortedList($vb068931cc450442b63f5b3d276ea4297, $v196ff468dd22ac429da86fe7084fd6b5 = Sort::SORT_TYPE_ASC);public function getFirstBy($vb068931cc450442b63f5b3d276ea4297, $v2063c1608d6e0baf80249c42e2be5804, $vd4a6347717091debb166e768f315fcec = Filter::COMPARE_TYPE_EQUALS);public function getMain();public function push(iEntity $v78a5eb43deef9a7b5b9ce157b9d52ac4);public function pushList(array $vc78b1adccdb092ff5a20e3244519e626);public function pull($vb80bb7740288fda1f201890375a60c8f);public function filterByType($vb80bb7740288fda1f201890375a60c8f);public function filterByCurrency($vb80bb7740288fda1f201890375a60c8f);public function filterByOffer($vb80bb7740288fda1f201890375a60c8f);public function extractOfferId();public function extractUniqueOfferId();public function extractTypeId();public function extractUniqueTypeId();public function extractCurrencyId();public function extractUniqueCurrencyId();public function getByTypeId($v5f694956811487225d15e973ca38fbab);}