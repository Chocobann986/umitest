<?php
 class CommonAtomicOperationCallback implements iAtomicOperationCallback {private $log = [];public function onBeforeExecute(iAtomicOperation $vf7235a61fdc3adc78d866fd8085d44db) {switch (true) {case $vf7235a61fdc3adc78d866fd8085d44db instanceof iManifest : {$v78e731027d8fd50ed642340b7c9a63b3 = getLabel('manifest-start');break;}case $vf7235a61fdc3adc78d866fd8085d44db instanceof iTransaction : {$v78e731027d8fd50ed642340b7c9a63b3 = getLabel('manifest-transaction-start') . $this->prepareTitle($vf7235a61fdc3adc78d866fd8085d44db->getTitle());break;}case $vf7235a61fdc3adc78d866fd8085d44db instanceof iAction : {$v78e731027d8fd50ed642340b7c9a63b3 = getLabel('manifest-action-start') . $this->prepareTitle($vf7235a61fdc3adc78d866fd8085d44db->getTitle());break;}default : {$v78e731027d8fd50ed642340b7c9a63b3 = 'Unknown execute start';}}$this->log($v78e731027d8fd50ed642340b7c9a63b3);}public function onAfterExecute(iAtomicOperation $vf7235a61fdc3adc78d866fd8085d44db) {switch (true) {case $vf7235a61fdc3adc78d866fd8085d44db instanceof iManifest : {$v78e731027d8fd50ed642340b7c9a63b3 = getLabel('manifest-finish');break;}case $vf7235a61fdc3adc78d866fd8085d44db instanceof iTransaction : {$v78e731027d8fd50ed642340b7c9a63b3 = getLabel('manifest-transaction-finish') . $this->prepareTitle($vf7235a61fdc3adc78d866fd8085d44db->getTitle());break;}case $vf7235a61fdc3adc78d866fd8085d44db instanceof iAction : {$v78e731027d8fd50ed642340b7c9a63b3 = getLabel('manifest-action-finish') . $this->prepareTitle($vf7235a61fdc3adc78d866fd8085d44db->getTitle());break;}default : {$v78e731027d8fd50ed642340b7c9a63b3 = 'Unknown execute finish';}}$this->log($v78e731027d8fd50ed642340b7c9a63b3);}public function onBeforeRollback(iAtomicOperation $vf7235a61fdc3adc78d866fd8085d44db) {switch (true) {case $vf7235a61fdc3adc78d866fd8085d44db instanceof iManifest : {$v78e731027d8fd50ed642340b7c9a63b3 = getLabel('manifest-rollback-start');break;}case $vf7235a61fdc3adc78d866fd8085d44db instanceof iTransaction : {$v78e731027d8fd50ed642340b7c9a63b3 = getLabel('transaction-rollback-start') . $this->prepareTitle($vf7235a61fdc3adc78d866fd8085d44db->getTitle());break;}case $vf7235a61fdc3adc78d866fd8085d44db instanceof iAction : {$v78e731027d8fd50ed642340b7c9a63b3 = getLabel('action-rollback-start') . $this->prepareTitle($vf7235a61fdc3adc78d866fd8085d44db->getTitle());break;}default : {$v78e731027d8fd50ed642340b7c9a63b3 = 'Unknown rollback start';}}$this->log($v78e731027d8fd50ed642340b7c9a63b3, true);}public function onAfterRollback(iAtomicOperation $vf7235a61fdc3adc78d866fd8085d44db) {switch (true) {case $vf7235a61fdc3adc78d866fd8085d44db instanceof iManifest : {$v78e731027d8fd50ed642340b7c9a63b3 = getLabel('manifest-rollback-end');break;}case $vf7235a61fdc3adc78d866fd8085d44db instanceof iTransaction : {$v78e731027d8fd50ed642340b7c9a63b3 = getLabel('transaction-rollback-end') . $this->prepareTitle($vf7235a61fdc3adc78d866fd8085d44db->getTitle());break;}case $vf7235a61fdc3adc78d866fd8085d44db instanceof iAction : {$v78e731027d8fd50ed642340b7c9a63b3 = getLabel('action-rollback-end') . $this->prepareTitle($vf7235a61fdc3adc78d866fd8085d44db->getTitle());break;}default : {$v78e731027d8fd50ed642340b7c9a63b3 = 'Unknown rollback finish';}}$this->log($v78e731027d8fd50ed642340b7c9a63b3, true);}public function onException(iAtomicOperation $vf7235a61fdc3adc78d866fd8085d44db, Exception $v42552b1f133f9f8eb406d4f306ea9fd1) {$this->log(getLabel('manifest-exception') . ': ' . $v42552b1f133f9f8eb406d4f306ea9fd1->getMessage(), true);}public function getLog() {return $this->log;}protected function log($v78e731027d8fd50ed642340b7c9a63b3, $v81ae42f244763331c3caaced7f5a1dc0 = false) {$this->log[] = $v78e731027d8fd50ed642340b7c9a63b3;}protected function prepareTitle($vd5d3db1765287eef77d7927cc956f50a) {return sprintf(' "%s"', $vd5d3db1765287eef77d7927cc956f50a);}}