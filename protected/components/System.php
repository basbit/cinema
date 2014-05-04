<?php

/**
 * System component
 *
 * @author		baster
 */

class System extends CApplicationComponent
{
	public $config = null;

	public function init()
	{
		parent::init();
	}

	public function request($value)
	{
		$res = Yii::app()->request->getParam($value);

		return $res;
	}

	public function json($text, $error = null, $href = null)
	{
		echo CJSON::encode(array("text" => $text,"error" => $error,"href" => $href));

		Yii::app()->end();
	}


	public function out($var, $isExit = false)
	{
		if (Yii::app()->request->isAjaxRequest)
		{
			$this->json(false, $var);
			Yii::app()->end();
		}

		else
		{
			print_r("<pre>");
			print_r($var);
			print_r("</pre>");
		}

		if ($isExit)
			Yii::app()->end();
	}

}

?>
