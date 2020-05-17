<?php
class dbClass {
	private $dbCon;
	private $userId;

	public function __construct() {
		include("dbConnect.php");
		$this->dbCon  = $conn;
	}

	function getDbConn(){
		return $this->dbCon;
	}

	function getCustomerId(){
		return $_SESSION['customer_id'];
	}


	function getSingleRow($sql){
	    //echo $sql; die;
		$stmt = $this->dbCon->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		//var_dump($result);die;
		return 	$result;
	}



	// insert function for all table
	// created ny moynul
	// parameter table name, inserted table column_name and value array
	function insert($table_name ,$columns_values){
		try {
			$this->dbCon->beginTransaction();
			//var_dump($columns_values);die;
			$bind = ':'.implode(',:', array_keys($columns_values));
			$columns =  implode(',', array_keys($columns_values));

			$master_sql = "Insert into $table_name ($columns)  VALUES ($bind)";
			//echo $master_sql;die;
			$stmt = $this->dbCon->prepare($master_sql);
    		$return = $stmt->execute(array_combine(explode(',',$bind), array_values($columns_values)));
			if($return == 1){
				$just_inserted_id = $this->dbCon->lastInsertId();
				if($just_inserted_id) $original_return = $just_inserted_id;
				else 				  $original_return = 1;
			}
			else
				$original_return = 0;

			$this->dbCon->commit();
			return $original_return;

		} catch(PDOException $e) {
			$this->dbCon->rollback();
			echo "Insert:Error: " . $e->getMessage();
		}
	}
	function update($table_name, $columns_values,$condition_array){
		try {
			$this->dbCon->beginTransaction();
			$condition_bind = ':'.implode(',:', array_keys($condition_array));
			$bind = ':'.implode(',:', array_keys($columns_values));

			$set_string = "";
			foreach($columns_values as $key=>$value) {
				$set_string .= "$key =:$key, ";
			}

			$con_string = "";
			$count_i = 1;
			foreach($condition_array as $key=>$value) {
				if(count($condition_array) != $count_i)
					$con_string .= "$key =:$key AND ";
				else
					$con_string .= "$key =:$key";
				$count_i++;
			}


			$updatesql = "update $table_name set ".rtrim($set_string,", ")."  where $con_string";

		//	echo $updatesql;die;
			$stmt = $this->dbCon->prepare($updatesql);

			$condition_combined_array  = array_combine(explode(',',$condition_bind), array_values($condition_array));
			$columns_combined_array   = array_combine(explode(',',$bind), array_values($columns_values));
			$bind_array = array_merge($condition_combined_array, $columns_combined_array );
			$return = $stmt->execute($bind_array);
			$this->dbCon->commit();
			return $return;

		} catch(PDOException $e) {
			$this->dbCon->rollback();
			echo "Insert:Error: " . $e->getMessage();
		}
	}

	function delete($table_name ,$condition_array){
		try {
			$this->dbCon->beginTransaction();
			$condition_bind = ':'.implode(',:', array_keys($condition_array));
			$con_string = "";
			$count_i = 1;
			foreach($condition_array as $key=>$value) {
				if(count($condition_array) != $count_i)
					$con_string .= "$key =:$key AND ";
				else
					$con_string .= "$key =:$key";
				$count_i++;
			}
			$deletesql = "delete  from $table_name where $con_string";
			$stmt = $this->dbCon->prepare($deletesql);
			$condition_combined_array  = array_combine(explode(',',$condition_bind), array_values($condition_array));
    		$return = $stmt->execute($condition_combined_array);
			$this->dbCon->commit();
			return $return;

		} catch(PDOException $e) {
			$this->dbCon->rollback();
			echo "Insert:Error: " . $e->getMessage();
		}
	}

    public function print_arrays()
    {
        $args = func_get_args();
        echo "<pre>";
        foreach ($args as $arg) {
            print_r($arg);
        }
        echo "</pre>";
        die();
    }

    function email_send($customer_id, $information, $invoice_no ){
        $customer_email = getSingleRow("SELECT email FROM customer_infos WHERE customer_id=$customer_id");

        $to 	 = $customer_email['email'];
        $from 	 = 'admin@admin.net';
        $subject = " Your payment has been successful";
        $body 	 = "Your payment has been successful" ;

        $headers = 'From: ' . $from . "\r\n" .
            'Reply-To: ' . $from . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $body, $headers);
    }

}

?>