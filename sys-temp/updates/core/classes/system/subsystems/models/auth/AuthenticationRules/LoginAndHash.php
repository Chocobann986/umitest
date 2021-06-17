<?php
 namespace UmiCms\System\Auth\AuthenticationRules;use UmiCms\System\Selector\iFactory as SelectorFactory;use UmiCms\System\Protection\iHashComparator;class LoginAndHash extends Rule {private $login;private $hash;public function __construct($vd56b699830e77ba53855679cb1d252da, $v0800fc577294c34e0b28ad2839435945, SelectorFactory $vdff401a605e5f6984373466cddee7287, iHashComparator $v9cb170b1e9321537ce4ae3eaa340f9d4) {$this->login = (string) $vd56b699830e77ba53855679cb1d252da;$this->hash = (string) $v0800fc577294c34e0b28ad2839435945;$this->selectorFactory = $vdff401a605e5f6984373466cddee7287;$this->hashComparator = $v9cb170b1e9321537ce4ae3eaa340f9d4;}public function validate() {$vd56b699830e77ba53855679cb1d252da = $this->getLogin();try {$v7e5aadfde0b0d3a8a9e841ac0d976572 = $this->getQueryBuilder();$v7e5aadfde0b0d3a8a9e841ac0d976572->option('return')->value(['id', 'password']);$v7e5aadfde0b0d3a8a9e841ac0d976572->option('or-mode')->fields('login', 'e-mail');$v7e5aadfde0b0d3a8a9e841ac0d976572->where('login')->equals($vd56b699830e77ba53855679cb1d252da);$v7e5aadfde0b0d3a8a9e841ac0d976572->where('e-mail')->equals($vd56b699830e77ba53855679cb1d252da);$v7e5aadfde0b0d3a8a9e841ac0d976572->where('is_activated')->equals(true);$v7e5aadfde0b0d3a8a9e841ac0d976572->limit(0, 1);$v606f4a5eb3f20967cef8d0890d6391a9 = $v7e5aadfde0b0d3a8a9e841ac0d976572->result();}catch (\Exception $ve1671797c52e15f763380b45e841ec32) {return false;}if (umiCount($v606f4a5eb3f20967cef8d0890d6391a9) === 0) {return false;}$v28dde6c024074edca371bad1c9058126 = (string) $v606f4a5eb3f20967cef8d0890d6391a9[0]['password'];$v9cb170b1e9321537ce4ae3eaa340f9d4 = $this->getHashComparator();if (!$v9cb170b1e9321537ce4ae3eaa340f9d4->equals($v28dde6c024074edca371bad1c9058126, $this->getHash())) {return false;}return (int) $v606f4a5eb3f20967cef8d0890d6391a9[0]['id'];}private function getLogin() {return $this->login;}private function getHash() {return $this->hash;}}