<?php
 namespace UmiCms\System\Trade\Offer;use UmiCms\System\Trade\iOffer;use UmiCms\System\Orm\Composite\iEntity;use UmiCms\System\Trade\Offer\Price\iType;use UmiCms\System\Trade\Offer\Price\iCurrency;use UmiCms\System\Trade\Offer\Price\Currency\iFacade as iCurrencyFacade;interface iPrice extends iEntity {public function getValue(iCurrency $v1af0389838508d7016a9841eb6273962 = null);public function setValue($v2063c1608d6e0baf80249c42e2be5804, iCurrency $v1af0389838508d7016a9841eb6273962 = null);public function getOfferId();public function setOfferId($vb80bb7740288fda1f201890375a60c8f);public function getCurrencyId();public function setCurrencyId($vb80bb7740288fda1f201890375a60c8f);public function getTypeId();public function setTypeId($vb80bb7740288fda1f201890375a60c8f);public function isMain();public function setMain($v327a6c4304ad5938eaf0efb6cc3e53dc = true);public function getOffer();public function setOffer(iOffer $vd60db28d94d538bbb249dcc7f2273ab1);public function getCurrency();public function setCurrency(iCurrency $v1af0389838508d7016a9841eb6273962);public function getType();public function setType(iType $v599dcce2998a6b40b1e38e8c6006cb0a);public function setCurrencyFacade(iCurrencyFacade $v00c169d5e8a598d3908199ef8c64c279);}