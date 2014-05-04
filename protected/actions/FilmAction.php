<?php

/**
 * Film action
 *
 * @author		baster
 */

class FilmAction extends CAction
{
	public function run($name = null, $id = null)
	{
        if(!$name && !$id )
            Yii::app()->System->json("Не переданы параметры name или id", 1);

        if($id)
        {
            $condition[] = "f.id = :id";
            $params[":id"] = $id;
        }
        elseif($name)
        {
            $condition[] = "f.name LIKE :name";
            $params[":name"] = $name;
        }

        $cinemas = Yii::app()->DataBase->get("SELECT CONCAT(c.id, '_', h.id, '_', f.id, '_', s.id) as id,
		                                            c.id as cinemaId,
		                                            c.name as cinema,
		                                            c.alias as alias,
		                                            h.hall as hall,
		                                            h.id as hallId,
		                                            s.shedule as sedule,
		                                            f.name as film,
		                                            f.id as filmId,
		                                            f.description as description
		                                        FROM cinema c
		                                        LEFT JOIN hall h ON c.id = h.cinemaId
		                                        INNER JOIN shedule s ON c.id = s.cinemaId
		                                        INNER JOIN films f ON s.filmId = f.id
		                                        WHERE ".implode(" AND ", $condition)." ORDER BY f.id DESC, s.shedule ASC", $params);

        if(!$cinemas)
            Yii::app()->System->json(null, 1);
        else
            Yii::app()->System->json($cinemas);
	}
	
}

?>