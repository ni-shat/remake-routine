<?php


//if(isset($_POST['submit2'])){


    $selected_Batch = $_POST['batchID'];
    console.log($selected_Batch);

    $db = mysqli_connect('localhost', 'root', '','test');

    $sql = "UPDATE schedulecheckok9 SET userSelectedBatch = '$selected_Batch' WHERE id = 1";
    
    if(mysqli_query($db, $sql)){

         
    }

    
  /*  $query = "SELECT * FROM `schedulecheckok9`"; 

    $resdata = mysqli_query($db, $query);


    
        // if there is any empty column of dayy, fill them up with correct value(correct day)
        $regex_day = "/(sunday)|(monday)|(tuesday)|(wednesday)|(thursday)|(friday)|(saturday)|(sun)|(mon)|(tues)|(wed)|(thursday)|(fri)|(sat)/i";

        $storeDay = "TODAYY!"; // initialize identifier

       

        while($row = mysqli_fetch_array($resdata)){
            
            if((preg_match($regex_day, $row['dayy']) == 1)){

                $storeDay = $row['dayy'];

                break; // stored the first valid data of day column from db
            }
        }
        while($row = mysqli_fetch_array($resdata)){

            if((preg_match($regex_day, $row['dayy']) == 1)   && ($storeDay != $row['dayy'])){

                $storeDay = $row['dayy']; // notun day paisi. 

            } else{ 
                    
                    // INSERT
                    $id = $row['id']; // echo $id;
                    $sql = "UPDATE schedulecheckok9 SET dayy = '$storeDay' WHERE id = $id";

                    if(mysqli_query($db, $sql)){
                        // echo "created sucessfully" . "</br>";
                        // echo $row['dayy'] . "</br>";
                        $uploaded = 1;
                    }

            }



        } */

    mysqli_close($db);

    echo "1";

   
?>



