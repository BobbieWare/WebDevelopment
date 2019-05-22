<?php

session_start();

$newitem = $_GET["book"];
$action = $_GET["action"];

		if (array_key_exists("Cart", $_SESSION))
        {
            $MDA = $_SESSION["Cart"];
            if ($action == "Add")
            {
                if ($MDA[$newitem] != "")
                {  
                    $value = $MDA[$newitem] + 1;
                    $MDA[$newitem] = $value;
                }
                else
                {
                    $MDA[$newitem] = "1";
                }
            }
            else
            {
                $MDA= "";
            }
        }
        else
        {
            $MDA[$newitem] = "1";
        }

        $_SESSION["Cart"] = $MDA;

        

        
		echo json_encode($MDA, JSON_PRETTY_PRINT);
		
		// echo json_encode($MDA, JSON_PRETTY_PRINT);
		
?>
