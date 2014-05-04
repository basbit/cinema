<?php

/**
 * Places action
 *
 * @author		baster
 */

class PlacesAction extends CAction
{

    public function run($id = null)
    {
        if(!$id )
            Yii::app()->System->json("Не переданы параметры id", 1);

        list($cinemaId, $hallId, $filmId, $sheduleId) = explode("_", $id);

        if(!$cinemaId ||  !$hallId || !$filmId || !$sheduleId)
            Yii::app()->System->json("Неверный параметр", 1);
        else
        {
            $condition[] = "cinemaId = :cinemaId AND hallId = :hallId";
            $params[":cinemaId"] = $cinemaId;
            $params[":hallId"] = $hallId;
        }

        $palces = Yii::app()->DataBase->get("SELECT * FROM places WHERE ".implode(" AND ", $condition), $params, true);

        $condition[] = "filmId = :filmId AND sheduleId = :sheduleId";
        $params[":filmId"] = $filmId;
        $params[":sheduleId"] = $sheduleId;

        $tickets = Yii::app()->DataBase->get("SELECT placeId as id, id as tid,
                                                    cinemaId,
                                                    hallId,
                                                    filmId,
                                                    sheduleId,
                                                    code,
                                                    tsSell
                                            FROM tickets WHERE ".implode(" AND ", $condition), $params, true);

        $restPlaces = array_diff_key($palces, $tickets);


        if(!$restPlaces)
            Yii::app()->System->json(null, 1);
        else
            Yii::app()->System->json($restPlaces);
    }
	
}

?>