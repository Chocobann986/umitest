<?php
 namespace UmiCms\System\Trade\Offer\Price\Currency;use UmiCms\System\Trade\Offer\Price\iCurrency;class Collection implements iCollection {private $list = [];public function getBy($vb068931cc450442b63f5b3d276ea4297, $v2063c1608d6e0baf80249c42e2be5804) {foreach ($this->getAll() as $v1af0389838508d7016a9841eb6273962) {switch ($vb068931cc450442b63f5b3d276ea4297) {case iCurrency::ID : {$vf215811ca1c7659966f45643d1e11609 = $v1af0389838508d7016a9841eb6273962->getId();break;}case iCurrency::NAME : {$vf215811ca1c7659966f45643d1e11609 = $v1af0389838508d7016a9841eb6273962->getName();break;}default : {$vf215811ca1c7659966f45643d1e11609 = $v1af0389838508d7016a9841eb6273962->getValue($vb068931cc450442b63f5b3d276ea4297);}}if ($vf215811ca1c7659966f45643d1e11609 === $v2063c1608d6e0baf80249c42e2be5804) {return $v1af0389838508d7016a9841eb6273962;}}throw new \privateException(sprintf('Currency with "%s" = "%s" not found', $vb068931cc450442b63f5b3d276ea4297, $v2063c1608d6e0baf80249c42e2be5804));}public function getAll() {return $this->list;}public function load(iCurrency $v1af0389838508d7016a9841eb6273962) {$this->list[$v1af0389838508d7016a9841eb6273962->getId()] = $v1af0389838508d7016a9841eb6273962;return $this;}public function loadList(array $vd4800b2094077e3751d7ea14924de3bb) {foreach ($vd4800b2094077e3751d7ea14924de3bb as $v1af0389838508d7016a9841eb6273962) {$this->load($v1af0389838508d7016a9841eb6273962);}return $this;}public function isLoaded($vb80bb7740288fda1f201890375a60c8f) {if (!is_string($vb80bb7740288fda1f201890375a60c8f) && !is_int($vb80bb7740288fda1f201890375a60c8f)) {return false;}return isset($this->list[$vb80bb7740288fda1f201890375a60c8f]);}public function unload($vb80bb7740288fda1f201890375a60c8f) {if ($this->isLoaded($vb80bb7740288fda1f201890375a60c8f)) {unset($this->list[$vb80bb7740288fda1f201890375a60c8f]);}return $this;}}