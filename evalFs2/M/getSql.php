<?php
    
	function actualDate($db)
	{
		$query = 
			"SELECT 
			DAYNAME(CURRENT_TIMESTAMP()), 
			DAY(CURRENT_TIMESTAMP()), 
			MONTHNAME(CURRENT_TIMESTAMP()), 
			YEAR(CURRENT_TIMESTAMP())";
			try {
				$stmt = $db->prepare($query);
				$stmt->execute(Null);
			}catch(PDOException $ex){   
				die("Failed to run query: " . $ex->getMessage());
			}
			$row = $stmt -> fetchAll();
			/* Pregu REPLACUUUUUUUUUUUUUUUUUUUU */
			function pregu_replacu($row)
			{
				$pattern = array(array("/^l/","/^j/","/^f/","/^m/","/^a/","/^s/","/^o/","/^n/","/^d/","/^v/"),array("L","J","F","M","A","S","O","N","D","V"));
				$row[0]['MONTHNAME(CURRENT_TIMESTAMP())'] = preg_replace($pattern[0],$pattern[1],$row[0]['MONTHNAME(CURRENT_TIMESTAMP())']);
				$row[0]['DAYNAME(CURRENT_TIMESTAMP())'] =  preg_replace($pattern[0], $pattern[1], $row[0]['DAYNAME(CURRENT_TIMESTAMP())']); 
				return $row;
			}
			$row = pregu_replacu($row);
			$actual_date = implode(" ",$row[0]);
			unset($row,$pattern,$stmt,$db);
			return $actual_date;
	}

    function fetchNoSets($db,$query)
    {
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(NULL);
        }
        catch(PDOException $ex)
        {   
        }
        $res = $stmt -> fetchALL();
        return $res; 
        
    }

    function fetchOneSet($db,$query,$set1)
    {
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ":set1" => $set1
                )
            );
        }
        catch(PDOException $ex)
        {   
        }
        $res = $stmt -> fetchALL();
        return $res; 
        
    }

    function fetchTwoSets($db,$query,$set1,$set2)
    {
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ":set1" => $set1,
                    ":set2" => $set2
                )
            );
        }
        catch(PDOException $ex)
        {   
        }
        $res = $stmt -> fetchALL();
        return $res; 
        
    }
    
    function fetchThreeSets($db,$query,$set1,$set2,$set3)
    {
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ":set1" => $set1,
                    ":set2" => $set2,
                    ":set3" => $set3
                )
            );
        }
        catch(PDOException $ex)
        {   
        }
        
        $res = $stmt -> fetchALL();
        
        return $res; 
    }

    function fetchFourSets($db,$query,$set1,$set2,$set3,$set4)
    {
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ":set1" => $set1,
                    ":set2" => $set2,
                    ":set3" => $set3,
                    ":set4" => $set4
                )
            );
        }
        catch(PDOException $ex)
        {   
            echo $ex;
        }
        $res = $stmt -> fetchALL();
        return $res; 
        
    }

    function fetchFiveSets($db,$query,$set1,$set2,$set3,$set4,$set5)
    {
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ":set1" => $set1,
                    ":set2" => $set2,
                    ":set3" => $set3,
                    ":set4" => $set4,
                    ":set5" => $set5
                )
            );
        }
        catch(PDOException $ex)
        {   
        }
        $res = $stmt -> fetchALL();
        return $res; 
        
    }

    function fetchSixSets($db,$query,$set1,$set2,$set3,$set4,$set5,$set6)
    {
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ":set1" => $set1,
                    ":set2" => $set2,
                    ":set3" => $set3,
                    ":set4" => $set4,
                    ":set5" => $set5,
                    ":set6" => $set6
                )
            );
        }
        catch(PDOException $ex)
        {   
        }
        $res = $stmt -> fetchALL();
        return $res; 
        
    }

    function fetchHeightets($db,$query,$set1,$set2,$set3,$set4,$set5,$set6,$set7,$set8)
    {
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ":set1" => $set1,
                    ":set2" => $set2,
                    ":set3" => $set3,
                    ":set4" => $set4,
                    ":set5" => $set5,
                    ":set6" => $set6,
                    ":set7" => $set7,
                    ":set8" => $set8
                )
            );
        }
        catch(PDOException $ex)
        {   
        }
        $res = $stmt -> fetchALL();
        return $res; 
        
    }
?>