<?php

/**
 * Reject action
 *
 * @author		baster
 */

class RejectAction extends CAction
{
	public function run($code = null)
	{
        if(!$code)
            Yii::app()->System->json("Не передан параметр code", 1);

        $ticketsSerial = base64_decode($code);

        $tickets = explode("_", $ticketsSerial);

        $now = "2014-05-10 13:01:00";//date("Y-m-d H:i:s");

        $result = Yii::app()->DataBase->query("DELETE FROM tickets
                                            WHERE code IN ('".implode("','",$tickets)."')
                                            AND TIMESTAMPDIFF(SECOND,:tsStart,tsStart) > 3600",
                                            array("tsStart" => $now));

        if($result)
		    Yii::app()->System->json("Вы отказались от ".$result." билетов");
		else
            Yii::app()->System->json("К сожалению, Вы не можете отказаться от билетов т.к. до начала сеана осталось менее часа либо Вы уже отказались от них", 1);
	}
}

?>