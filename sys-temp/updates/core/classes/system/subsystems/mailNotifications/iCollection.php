<?php
 namespace UmiCms\System\MailNotification;use UmiCms\System\Hierarchy\Domain\iDetector as DomainDetector;use UmiCms\System\Hierarchy\Language\iDetector as LanguageDetector;use UmiCms\System\iMailNotification;interface iCollection extends \iUmiCollection {public function getByName($vb068931cc450442b63f5b3d276ea4297);public function getByModule($v22884db148f0ffb0d830ba431102b0b5);public function getCurrentByName($vb068931cc450442b63f5b3d276ea4297);public function setDomainDetector(DomainDetector $v21aed3df2077b5d91ce46bf123446731);public function setLanguageDetector(LanguageDetector $v21aed3df2077b5d91ce46bf123446731);}