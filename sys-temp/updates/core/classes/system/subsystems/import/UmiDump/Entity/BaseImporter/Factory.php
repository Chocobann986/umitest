<?php
 namespace UmiCms\System\Import\UmiDump\Entity\BaseImporter;use UmiCms\System\Import\UmiDump\Helper\Entity\iSourceIdBinder;class Factory implements iFactory {public function create(\DOMXPath $v3643b86326b2ffcc0a085b4dd3a4309b, iSourceIdBinder $vb508148712cb53958c7e3d25ec86d72a) {return new \xmlEntityImporter($v3643b86326b2ffcc0a085b4dd3a4309b, $vb508148712cb53958c7e3d25ec86d72a);}}