<?php

$host = isset($_SERVER["HTTP_HOST"]) ? $_SERVER["HTTP_HOST"] : $_SERVER["SERVER_NAME"];

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..', 
	'name'=>'Cinema',
	"language" => "ru",
	"import" => array(
		"application.models.*",
		"application.components.*",
		"application.managers.*",
	),
	"defaultController" => "index",
    
	// application components
	'components'=>array(
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=cinema',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),
		"urlManager" => array(
			"urlFormat" => "path",
			"showScriptName" => false,
			"caseSensitive" => false,
			"rules" => array(
				"http://{$host}/<_c:\w+>/" => "<_c>/index",
				"http://{$host}/<_c:\w+>/<_a:\w+>" => "<_c>/<_a>",
			),
		),
		"errorHandler" => array(
			"errorAction" => "index/error",
		),
		"System" => array("class" => "System"),
		"DataBase" => array("class" => "DataBase"),
		"DataUrl" => array("class" => "DataUrl"),
	),
);