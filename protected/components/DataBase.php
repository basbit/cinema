<?php

/**
 * Component layer over the PDO
 *
 * @author		baster
 */

class DataBase extends CApplicationComponent
{
	public function query($sql, $bind = null)
	{
		$data = Yii::app()->db->createCommand($sql);

		if ($bind && is_array($bind))
			foreach ($bind as $key => $value)
				$data->bindValue("$key", $value);

		$data = $data->execute();

		if (strpos(trim($sql), "INSERT") === 0)
			return Yii::app()->db->getLastInsertID();

        if(strpos(trim($sql), "DELETE") === 0)
            return $data;
	}

	public function get($sql, $bind = null, $isArray = null)
	{
		$data = Yii::app()->db->createCommand($sql);

		if ($bind && is_array($bind))
			foreach ($bind as $key => $value)
				$data->bindValue("$key", $value);

		$data = $data->queryAll();

		$res = array();

		if(count($data) > 0)
		{
			foreach ($data as $key => $val)
				$res[current($val)] = $isArray ? $val : (object) $val;
		}
		
		return $res;
	}

	public function entity($sql, $bind = null, $isArray = null)
	{
		$data = Yii::app()->db->createCommand($sql);

		if ($bind && is_array($bind))
			foreach ($bind as $key => $value)
				$data->bindValue("$key", $value);

		$data = $data->queryRow();

		return $data ? ( $isArray ? $data : (object) $data ) : null;
	}

	public function column($sql, $bind = null)
	{
		$data = Yii::app()->db->createCommand($sql);

		if ($bind && is_array($bind))
			foreach ($bind as $key => $value)
				$data->bindValue("$key", $value);

		//return $data->queryColumn();

		$data = $data->queryAll();

		$res = array();

		if(count($data) > 0)
			foreach($data as $key => $val)
				$res[current($val)] = end($val);

		return $res;
	}

	public function cell($sql, $bind = null)
	{
		$data = Yii::app()->db->createCommand($sql);

		if ($bind && is_array($bind))
			foreach ($bind as $key => $value)
				$data->bindValue("$key", $value);

		return $data->queryScalar();
	}

}

?>
