<?php
 namespace UmiCms\Classes\System\Utils\Mail\Settings\Smtp;use UmiCms\Classes\System\Utils\Settings\Factory as SettingsFactory;class Factory extends SettingsFactory implements iFactory {protected function getCommon() {return new Common($this->getRegistry());}protected function getCustom($v72ee76c5c29383b7c9f9225c1fa4d10b = null, $vf585b7f018bb4ced15a03683a733e50b = null) {return new Custom($v72ee76c5c29383b7c9f9225c1fa4d10b, $vf585b7f018bb4ced15a03683a733e50b, $this->getRegistry());}}