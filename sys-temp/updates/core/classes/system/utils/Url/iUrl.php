<?php
 namespace UmiCms\System\Utils;interface iUrl {const QUERY_IDENTIFIER = '?';const FRAGMENT_IDENTIFIER = '#';const SCHEME_SUFFIX = '://';const COLON = ':';const PASSWORD_SUFFIX = '@';public function getScheme();public function setScheme($v41323917ef8089432959a3c33269debf);public function getHost();public function setHost($v67b3dba8bc6778101892eb77249db32e);public function getPort();public function setPort($v901555fb06e346cb065ceb9808dcfc25);public function getUser();public function setUser($vee11cbb19052e40b07aac0ca060c23ee);public function getPass();public function setPass($v1a1dc91c907325c69271ddf0c944bc72);public function getPath();public function setPath($vd6fe1d0be6347b8ef2427fa629c04485);public function getQuery();public function setQuery($v1b1cc7f086b3f074da452bc3129981eb);public function getQueryAsList();public function setQueryAsList(array $v1b1cc7f086b3f074da452bc3129981eb);public function getFragment();public function setFragment($v02e918fc72837d7c2689be88684dceb1);public function getUrl();public function __toString();public function merge(iUrl $v42aefbae01d2dfd981f7da7d823d689e);}