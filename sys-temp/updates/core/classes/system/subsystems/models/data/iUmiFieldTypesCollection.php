<?php
 interface iUmiFieldTypesCollection extends iSingleton {public function addFieldType($vb068931cc450442b63f5b3d276ea4297, $v870b60148237c1452dfb337fdd19c314 = 'string', $v09ec737a9ab66d1d796304239d3f8a86 = false, $va4e397efa082dcccc62563f1f2d9513b = false);public function delFieldType($vb80bb7740288fda1f201890375a60c8f);public function getFieldType($vb80bb7740288fda1f201890375a60c8f);public function getFieldTypeByDataType($v870b60148237c1452dfb337fdd19c314, $v09ec737a9ab66d1d796304239d3f8a86 = false);public function isExists($vb80bb7740288fda1f201890375a60c8f);public function getFieldTypeByDataTypeStrict($v870b60148237c1452dfb337fdd19c314, $vce495ab8d79db0d37413d8e95b54e606);public function getBooleanType();public function getBooleanTypeId();public function getColorType();public function getColorTypeId();public function getCounterType();public function getCounterTypeId();public function getDateType();public function getDateTypeId();public function getDomainIdType();public function getDomainIdTypeId();public function getMultipleDomainIdType();public function getMultipleDomainIdTypeId();public function getFileType();public function getFileTypeId();public function getFloatType();public function getFloatTypeId();public function getImageType();public function getImageTypeId();public function getIntType();public function getIntTypeId();public function getObjectTypeIdType();public function getObjectTypeIdTypeId();public function getMultipleFileType();public function getMultipleFileTypeId();public function getMultipleImageType();public function getMultipleImageTypeId();public function getOfferIdType();public function getOfferIdTypeId();public function getMultipleOfferIdType();public function getMultipleOfferIdTypeId();public function getMultipleOptionType();public function getMultipleOptionTypeId();public function getPasswordType();public function getPasswordTypeId();public function getPriceType();public function getPriceTypeId();public function getObjectIdType();public function getObjectIdTypeId();public function getMultipleObjectIdType();public function getMultipleObjectIdTypeId();public function getStringType();public function getStringTypeId();public function getSwfFieldType();public function getSwfFieldTypeId();public function getMultiplePageType();public function getMultiplePageTypeId();public function getMultipleTagType();public function getMultipleTagTypeId();public function getSimpleTextType();public function getSimpleTextTypeId();public function getVideoType();public function getVideoTypeId();public function getHtmlTextType();public function getHtmlTextTypeId();public function getDomainIdListType();public function getDomainIdListTypeId();public function getLinkToObjectTypeType();public function getLinkToObjectTypeTypeId();public function getOfferIdListType();public function getOfferIdListTypeId();public function getOptionedType();public function getOptionedTypeId();public function getRelationType();public function getRelationTypeId();public function getMultipleRelationType();public function getMultipleRelationTypeId();public function getSymlinkType();public function getSymlinkTypeId();public function getTagsType();public function getTagsTypeId();public function getFieldTypesList();public function clearCache();}