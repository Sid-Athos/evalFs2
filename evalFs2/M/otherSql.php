<?php
    
    function noSets($db,$query)
    {
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(NULL);
            $res = true;
        }
        catch(PDOException $ex)
        {
            $res = false;   
        }
        return $res;
    }

    function oneSet($db,$query,$set1)
    {
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ":set1" => $set1
                )
            );
            $res = true;
        }
        catch(PDOException $ex)
        {   
            $res = false;
        }
        return $res; 
    }

    function twoSets($db,$query,$set1,$set2)
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
            $res = true;
        }
        catch(PDOException $ex)
        {
            $res = false;   
        }
        return $res; 
    }

    function threeSets($db,$query,$set1,$set2,$set3)
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
            $res = true;
        }
        catch(PDOException $ex)
        {   
            echo $ex;
            $res = false;
        }
        return $res; 
    }
    
    function fourSets($db,$query,$set1,$set2,$set3,$set4)
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
            $res = true;
        }
        catch(PDOException $ex)
        {   
            $res = false;
        }
        return $res; 
    }

    function sixSets($db,$query,$set1,$set2,$set3,$set4,$set5,$set6)
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
            $res = true;
        }
        catch(PDOException $ex)
        {   
            $res = false;
        }
        return $res; 
    }

    function sevenSets($db,$query,$set1,$set2,$set3,$set4,$set5,$set6,$set7)
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
                    ":set7" => $set7
                )
            );
            $res = true;
        }
        catch(PDOException $ex)
        {   
            $res = false;
        }
        return $res; 
    }

    function heightSets($db,$query,$set1,$set2,$set3,$set4,$set5,$set6,$set7,$set8)
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
            $res = true;
        }
        catch(PDOException $ex)
        {   
            $res = false;
        }
        return $res; 
    }

    function nineSets($db,$query,$set1,$set2,$set3,$set4,$set5,$set6,$set7,$set8,$set9)
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
                    ":set8" => $set8,
                    ":set9" => $set9
                )
            );
            $res = true;
        }
        catch(PDOException $ex)
        {   
            $res = false;
        }
        return $res; 
    }
?>