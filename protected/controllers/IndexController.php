<?php
/**
 * Cinema controller
 *
 * @author		baster
 */

class IndexController extends CController
{
    public function actions()
    {
		return array(
			"index" => "application.actions.IndexAction", // ��������� ��������
		);
    }
}