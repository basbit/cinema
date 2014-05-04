<?php
/**
 * Ticket controller
 *
 * @author		baster
 */

class TicketController extends CController
{
    public function actions()
    {
        return array(
			"buy" => "application.actions.BuyAction", // ������ ������
			"reject" => "application.actions.RejectAction", // ���������� �� �������
        );
    }
}