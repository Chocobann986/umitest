<?php
 namespace UmiCms\System\Events;class EventPointFactory implements iEventPointFactory {public function create($vb80bb7740288fda1f201890375a60c8f, $v15d61712450a686a7f365adf4fef581f = 'process', array $v20cf12be6809c539cfed17c272627718 = []) {$v70e8822b2e035fa3777d666207aeafa8 = new \umiEventPoint($vb80bb7740288fda1f201890375a60c8f);return $v70e8822b2e035fa3777d666207aeafa8->setMode($v15d61712450a686a7f365adf4fef581f)    ->setModules($v20cf12be6809c539cfed17c272627718);}}