<?php
 header("Content-type: text/html; charset=utf-8");
 include "standalone.php";
 
 /*
  Документация: работа с объектами. Получение объектов и свойств.
 */

 OutputBuffer::current('HTTPOutputBuffer');
 
 //Получаем id текущего пользователя
 $permissions = permissionsCollection::getInstance();
 $currentUserId = $permissions->getUserId();
 echo "Id текущего пользователя: \"", $currentUserId, "\"<br />\n";
 
 //Получаем объект, который соответствует текущему пользователю
 $objects = umiObjectsCollection::getInstance();
 $userObject = $objects->getObject($currentUserId);
 
 //Проверяем, получился ли у нас объект
 if($userObject instanceof umiObject) {
  echo "Логин текущего пользователя: \"", $userObject->getValue("login"), "\"<br />\n";
  echo "Имя текущего пользователя: \"", $userObject->getValue("fname"), "\"<br /><br />\n";
  echo "Id типа данных объекта текущего пользователя: \"", $userObject->getTypeId(), "\"<br />\n";
 } else {
  echo "Ошибка. Объекта с таким id не существует.<br />\n";
 }
?>