<?php
 namespace UmiCms\System\Events;abstract class Handler implements iHandler {protected $eventId;protected $isCritical = false;protected $priority = 5;public function setEventId(string $vb80bb7740288fda1f201890375a60c8f) : iHandler {$this->eventId = $vb80bb7740288fda1f201890375a60c8f;return $this;}public function getEventId() : ?string {return $this->eventId;}public function setIsCritical($v12adfdc02f1648be7a61845ae7ff4691 = false) : iHandler {$this->isCritical = (bool) $v12adfdc02f1648be7a61845ae7ff4691;return $this;}public function getIsCritical() : bool {return $this->isCritical;}public function setPriority($vb988295c268025b49dfb3df26171ddc3 = 5) : iHandler {$vb988295c268025b49dfb3df26171ddc3 = (int) $vb988295c268025b49dfb3df26171ddc3;if ($vb988295c268025b49dfb3df26171ddc3 < 0 || $vb988295c268025b49dfb3df26171ddc3 > 9) {throw new \coreException('EventListener priority can only be between 0 ... 9');}$this->priority = $vb988295c268025b49dfb3df26171ddc3;return $this;}public function getPriority() : int {return $this->priority;}public function isAllowed(array $vfc5364bf9dbfa34954526becad136d4b) : bool {return true;}}