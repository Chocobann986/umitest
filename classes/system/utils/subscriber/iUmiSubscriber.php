<?php
 interface iUmiSubscriber {public function isRegisteredUser();public function getDispatches();public function releaseWasSent($vb80bb7740288fda1f201890375a60c8f);public function getSentReleaseIdList();public function putReleaseToSentList($vb80bb7740288fda1f201890375a60c8f);public function getFullName();public function getEmail();public static function getSubscriberByUserId($v8e44f0089b076e18a718eb9ca3d94674);}