<?php
	/** Установщик модуля */

	/** @var array $INFO реестр модуля */
	$INFO = [
		'name' => 'repair_tickets', // Имя модуля
		'config' => '1', // У модуля есть настройки
		'default_method' => 'page', // Метод по умолчанию в клиентской части
		'default_method_admin' => 'pages', // Метод по умолчанию в административной части
		'paging/' => 'Настройки постраничного вывода', // Группа настроек
		'paging/pages' => 25, // Настройка количества выводимых страниц
		'paging/objects' => 25, // Настройка количества выводимых объектов
	];

	/** @var array $COMPONENTS файлы модуля */
	$COMPONENTS = [
		'./classes/components/repair_tickets/admin.php',
		'./classes/components/repair_tickets/class.php',
		'./classes/components/repair_tickets/customAdmin.php',
		'./classes/components/repair_tickets/customMacros.php',
		'./classes/components/repair_tickets/i18n.php',
		'./classes/components/repair_tickets/i18n.en.php',
		'./classes/components/repair_tickets/install.php',
		'./classes/components/repair_tickets/lang.php',
		'./classes/components/repair_tickets/macros.php',
		'./classes/components/repair_tickets/permissions.php',
	];

