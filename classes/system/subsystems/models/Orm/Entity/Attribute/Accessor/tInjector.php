<?php
 namespace UmiCms\System\Orm\Entity\Attribute\Accessor;use UmiCms\System\Orm\Entity\iAccessor;trait tInjector {private $v4209ae65645472477d5389fe6ba7c0fa;protected function getAttributeAccessor() {return $this->attributeAccessor;}protected function setAttributeAccessor(iAccessor $v9efcb42ee143be09c45d33ed2fba175b) {$this->attributeAccessor = $v9efcb42ee143be09c45d33ed2fba175b;return $this;}}