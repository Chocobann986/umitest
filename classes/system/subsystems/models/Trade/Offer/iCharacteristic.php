<?php
 namespace UmiCms\System\Trade\Offer;use \iUmiField as iField;use \iUmiObject as iObject;use UmiCms\System\Orm\iEntity;use \iUmiObjectsCollection as iObjectFacade;interface iCharacteristic extends iEntity {public function __construct(iField $v06e3d36fa30cea095545139854ad1fb9, iObjectFacade $v51bee6c1b54168126341d69a43ba7429);public function getName();public function getTitle();public function getFieldType();public function getViewType();public function isMultiple();public function getGuideId();public function getValue();public function getRawValue();public function setValue($v2063c1608d6e0baf80249c42e2be5804);public function hasDataObject();public function getDataObjectId();public function setDataObject(iObject $v7beebf4251f2ace3d8e03527fe1bf86e);public function getField();public function getProperty();}