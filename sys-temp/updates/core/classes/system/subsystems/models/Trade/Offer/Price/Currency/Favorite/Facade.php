<?php
 namespace UmiCms\System\Trade\Offer\Price\Currency\Favorite;use UmiCms\System\Trade\Offer\Price\Currency\Favorite as AbstractFavorite;class Facade extends AbstractFavorite implements iFacade {private $userFavoriteCurrency;private $customerFavoriteCurrency;public function __construct(iUser $v029964ac37579c326b40e503f5bda8d2, iCustomer $v8ef49596146d2b44b3ad280a53a9c6f9) {$this->setUserFavoriteCurrency($v029964ac37579c326b40e503f5bda8d2)    ->setCustomerFavoriteCurrency($v8ef49596146d2b44b3ad280a53a9c6f9);}public function getId() {return $this->getCustomerFavoriteCurrency()->getId() ?: $this->getUserFavoriteCurrency()->getId();}public function setId($vb80bb7740288fda1f201890375a60c8f)  {return $this->getUserFavoriteCurrency()->setId($vb80bb7740288fda1f201890375a60c8f) ?: $this->getCustomerFavoriteCurrency()->setId($vb80bb7740288fda1f201890375a60c8f);}private function setUserFavoriteCurrency(iUser $v029964ac37579c326b40e503f5bda8d2) {$this->userFavoriteCurrency = $v029964ac37579c326b40e503f5bda8d2;return $this;}private function getUserFavoriteCurrency() {return $this->userFavoriteCurrency;}private function setCustomerFavoriteCurrency(iCustomer $v8ef49596146d2b44b3ad280a53a9c6f9) {$this->customerFavoriteCurrency = $v8ef49596146d2b44b3ad280a53a9c6f9;return $this;}private function getCustomerFavoriteCurrency() {return $this->customerFavoriteCurrency;}}