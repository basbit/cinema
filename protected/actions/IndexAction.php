<?php

/**
 * Cinema action
 *
 * @author		baster
 */

class IndexAction extends CAction
{

	public function run($name = null, $alias = null, $id = null, $hall = null)
	{
		if(!$name && !$id && !$alias)
			Yii::app()->System->json("Не переданы параметры name или id или alias", 1);

        if($id)
        {
            $condition[] = "c.id = :id";
            $params[":id"] = $id;
        }
        elseif($name)
        {
            $condition[] = "c.name LIKE :name";
            $params[":name"] = $name;
        }
        elseif($alias)
        {
            $condition[] = "c.alias = :alias";
            $params[":alias"] = $alias;
        }

        if($hall)
        {
            $condition[] = "h.hall = :hall";
            $params[":hall"] = $hall;
        }

		$cinemas = Yii::app()->DataBase->get("SELECT CONCAT(c.id, '_', h.id, '_', f.id, '_', s.id) as id,
		                                            c.id as cinemaId,
		                                            c.name as cinema,
		                                            c.alias as alias,
		                                            h.hall as hall,
		                                            h.id as hallId,
		                                            s.shedule as sedule,
		                                            s.id as seduleId,
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