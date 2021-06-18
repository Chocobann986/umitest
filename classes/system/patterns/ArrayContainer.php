<?php
 namespace UmiCms\System\Patterns;abstract class ArrayContainer implements iArrayContainer, \Countable {protected $array = [];public function __construct(array $vf1f713c9e000f5d3f280adbd124df4f5 = []) {$this->array = $vf1f713c9e000f5d3f280adbd124df4f5;}public function get($v3c6e0b8a9c15224a8228b9a98ca1531d) {if (!$this->isValidKey($v3c6e0b8a9c15224a8228b9a98ca1531d)) {return null;}return getArrayKey($this->array, $v3c6e0b8a9c15224a8228b9a98ca1531d);}public function isExist($v3c6e0b8a9c15224a8228b9a98ca1531d) {if (!$this->isValidKey($v3c6e0b8a9c15224a8228b9a98ca1531d)) {return false;}return array_key_exists($v3c6e0b8a9c15224a8228b9a98ca1531d, $this->array);}public function set($v3c6e0b8a9c15224a8228b9a98ca1531d, $v2063c1608d6e0baf80249c42e2be5804) {if (!$this->isValidKey($v3c6e0b8a9c15224a8228b9a98ca1531d)) {return $this;}$this->array[$v3c6e0b8a9c15224a8228b9a98ca1531d] = $v2063c1608d6e0baf80249c42e2be5804;return $this;}public function del($vd36a87418dcd06d8fbb68d2a1776284e) {$vd36a87418dcd06d8fbb68d2a1776284e = is_array($vd36a87418dcd06d8fbb68d2a1776284e) ? $vd36a87418dcd06d8fbb68d2a1776284e : [$vd36a87418dcd06d8fbb68d2a1776284e];foreach ($vd36a87418dcd06d8fbb68d2a1776284e as $v3c6e0b8a9c15224a8228b9a98ca1531d) {if (!$this->isValidKey($v3c6e0b8a9c15224a8228b9a98ca1531d)) {continue;}unset($this->array[$v3c6e0b8a9c15224a8228b9a98ca1531d]);}return $this;}public function getArrayCopy() {return $this->array;}public function count() {return umiCount($this->getArrayCopy(), true);}public function clear() {$this->array = [];return $this;}public function __get($v3c6e0b8a9c15224a8228b9a98ca1531d) {return $this->get($v3c6e0b8a9c15224a8228b9a98ca1531d);}public function __isset($v3c6e0b8a9c15224a8228b9a98ca1531d) {return $this->isExist($v3c6e0b8a9c15224a8228b9a98ca1531d);}public function __set($v3c6e0b8a9c15224a8228b9a98ca1531d, $v2063c1608d6e0baf80249c42e2be5804) {return $this->set($v3c6e0b8a9c15224a8228b9a98ca1531d, $v2063c1608d6e0baf80249c42e2be5804);}public function __unset($vd36a87418dcd06d8fbb68d2a1776284e) {return $this->del($vd36a87418dcd06d8fbb68d2a1776284e);}protected function isValidKey($v3c6e0b8a9c15224a8228b9a98ca1531d) {return (is_string($v3c6e0b8a9c15224a8228b9a98ca1531d) || is_int($v3c6e0b8a9c15224a8228b9a98ca1531d));}}