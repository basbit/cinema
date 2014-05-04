<?php
/**
 * Film controller
 *
 * @author		baster
 */

class FilmController extends CController
{
    public function actions()
    {
		return array(
			"index" => "application.actions.FilmAction", // ��������� ��������
			"places" => "application.actions.PlacesAction", // �����
		);
    }
}