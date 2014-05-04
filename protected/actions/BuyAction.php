<?php

/**
 * Buy ticket action
 *
 * @author		baster
 */

class BuyAction extends CAction
{
	public function run($id= null, $places = null, $row = null)
	{
        if(!$id || !$places || !$row)
            Yii::app()->System->json("Не переданы параметры id, places и row", 1);

        $place = array();
        $code = null;
        $codes = null;
        $lastId = null;
        $busyPlace = null;

        if(@explode(",",$places))
            $place = explode(",",$places);
        else
            Yii::app()->System->json("Не верно задан параметр places", 1);

        $shedule = Yii::app()->DataBase->entity("SELECT * FROM shedule WHERE id = :id", array(":id" => $id));

        $conditionP[] = "cinemaId = :cinemaId AND hallId = :hallId";

        $paramsP[":cinemaId"] = $shedule->cinemaId;
        $paramsP[":hallId"] = $shedule->hallId;

        $palcesId = Yii::app()->DataBase->column("SELECT id FROM places
                                               WHERE rowId = :row AND placeId IN ('".implode("','",$place)."')
                                                AND ".implode(" AND ", $conditionP),
                                               array_merge($paramsP,array(":row" => $row)));

        $conditionT[] = "filmId = :filmId AND sheduleId = :sheduleId AND placeId IN ('".implode("','",$palcesId)."')";
        $paramsT[":filmId"] = $shedule->filmId;
        $paramsT[":sheduleId"] = $shedule->id;

        $busyPlace = Yii::app()->DataBase->cell("SELECT placeId FROM tickets
                                                 WHERE ".implode(" AND ", array_merge($conditionP,$conditionT))." LIMIT 1",
                                                   array_merge($paramsP,$paramsT));

        if($busyPlace)
            Yii::app()->System->json("Некоторые места, из покупаемых Вами, уже заняты", 1);

        if($palcesId)
        {
            foreach($palcesId as $palceId)
            {
                $salt = microtime();
                $code = md5($shedule->id.$shedule->cinemaId.$shedule->hallId.$shedule->filmId.$palceId.$salt);
                $codes[] = $code;
                $condition[] = "(:cinemaId_".$palceId.",:hallId_".$palceId.",
                :filmId_".$palceId.",:sheduleId_".$palceId.",:placeId_".$palceId.",:code_".$palceId.",:tsStart_".$palceId.")";

                $params[":cinemaId_".$palceId] = $shedule->cinemaId;
                $params[":hallId_".$palceId] = $shedule->hallId;
                $params[":filmId_".$palceId] = $shedule->filmId;
                $params[":sheduleId_".$palceId] = $shedule->id;
                $params[":placeId_".$palceId] = $palceId;
                $params[":code_".$palceId] = $code;
                $params[":tsStart_".$palceId] = $shedule->shedule;
            }

            $lastId = Yii::app()->DataBase->query("INSERT INTO tickets (cinemaId, hallId, filmId, sheduleId, placeId, code, tsStart)
                                                    VALUES ".implode(",",$condition), $params);
        }

        if($lastId)
            Yii::app()->System->json(base64_encode(implode("__",$codes)));
        else
            Yii::app()->System->json(null, 1);
	}
	
}

?>