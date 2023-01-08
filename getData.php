<?php
use SimpleExcel\SimpleExcel; // namespace

    if(isset($_POST)){


        if(move_uploaded_file($_FILES['excel_file']['tmp_name'], $_FILES['excel_file']['name'])){


            require_once('SimpleExcel/SimpleExcel.php');       // load the main class file (if you're not using autoloader)

            $excel = new SimpleExcel('csv');                    // instantiate new object (will automatically construct the parser & writer type as XML)

            $excel->parser->loadFile($_FILES['excel_file']['name']);            // load an XML file from server to be parsed

            $foo = $excel->parser->getField();                  // get complete array of the table
            //$bar = $excel->parser->getRow(6);  // fura row oibo. ar index shoho               // get specific array from the specified row (3rd row)
           // $baz = $excel->parser->getColumn(8); //column oibo index shoho               // get specific array from the specified column (4th row)
            //$qux = $excel->parser->getCell(2,1); //2 nmb row, 1 nmb column               // get specific data from the specified cell (2nd row in 1st column)

            // echo '<pre>';
            // print_r($foo);                                      // echo the array  
            // echo '</pre>';

            //echo count($foo);


            $columnNmb = 1; //echo "First clmnmb" . $columnNmb . "</br>";  // 1 e hoise karon eita tho plugin ekta, oikhane ora 1 theke return korse.

            while($columnNmb < 50){  // count left row to add in db  // 50 er beshi time hobe na eita chinta kore disi. 

                if($excel->parser->isColumnExists($columnNmb) == 0){  
                    break;
                }
                $columnNmb++;

            } //echo $columnNmb;  // row amr $columnNmb = 19, $rowNmb-1 = 18, $rowNmb-3 = 16. 
            
           
            $conn = new mysqli('localhost', 'root', '','test');    // Create connection
        

            $nmb = 1;
            $time = array();
            while($nmb < ($columnNmb-3)){

                $time[] = "timee" . $nmb; 
                $nmb++;
            }

            //$val = mysql_query('select 1 from `schedulecheckok9` LIMIT 1');

            // if((mysql_query("DESCRIBE `schedulecheckok9`")) === FALSE){

            //     $sql = "DROP TABLE `schedulecheck`;";
            //     $conn->query($sql);
            // }
            //console.log(mysql_query("DESCRIBE `schedulecheckok9`"));


            $sql = "DROP TABLE IF EXISTS `schedulecheckok9`;";
            if ($conn->query($sql) === TRUE){
                //echo "Table created successfully";  // succeed
            }

           // else if($tableFound == 0){

                $sql = "CREATE TABLE `schedulecheckok9` (
                    `id` INT NOT NULL,
                    `dayy` VARCHAR(200) NOT NULL,
                    `section` VARCHAR(200) NOT NULL,
                    `batch` VARCHAR(200)";
    
    
            /*    for($i=0; $i<count($time); $i++){
                echo $time[$i] . "</br>";
                } */
                
                for($i = 0; $i < count($time); $i++){                
                    
                    $sql = $sql . ", `" . $time[$i] . "` VARCHAR(200)";
                }
                $sql = $sql . ", `userSelectedBatch` VARCHAR(200))";
                //$sql = $sql . ")";
                
    
                if ($conn->query($sql) === TRUE){
                    //echo "Table created successfully";  // succeed
                }else{
                    //echo "Couldn't";
                }
    
    
    
       /*        
    //close for checking
                if ($conn->query($sql) === TRUE) {  // $conn->query() otar vitre dia jar.
                    //echo "Table created successfully";
                } else {
                    echo "Couldn't upload data!";
                } 
    
    
                $countnmb = 1;
    
                while($countnmb < $columnNmb-3){   
    
                    $sql2 = "ALTER TABLE `schedulecheckok9` ADD COLUMN (timee".$countnmb." varchar(50) CHARSET utf8mb4);";
    
                    $conn->query($sql2); //echo $countnmb;
                    $countnmb++;
                }  //close for check
                
    */
    
                // insert data into db rows
                $rowIdx_Json = 0;  
                $id = 1;
    
    
                while($rowIdx_Json < count($foo)){  
    
                        $v1 = $foo[$rowIdx_Json][0];
                        $v2 = $foo[$rowIdx_Json][1];
                        $v3 = $foo[$rowIdx_Json][2]; 
    
                        // echo "Row index = ".$rowindex.  $v1."<br/>";
                        // echo $v2."<br/>";
                        // echo $v3."<br/>";  
    
    
                    $query = "INSERT INTO `schedulecheckok9` VALUES ($id,'$v1','$v2','$v3'";  // $rownmb-3 = 
                    
                    // logically 3 ba tar porer index theke time boshanu
                    for ($columnIdx_Json = 3; $columnIdx_Json < $columnNmb-1; $columnIdx_Json++) { // $rowNmb-3 = 16
                        
                        $vForT = $foo[$rowIdx_Json][$columnIdx_Json]; 
    
                        $query = $query . ", "."'$vForT'";
    
                      } 
    
                      $query = $query . ", 'NoValue');";
                     // $query = $query . ");";
     
    
    
                    mysqli_query($conn, $query);
                    $rowIdx_Json++;
                    $id++;
                    
                }  // end inserting data 
    
                
            //} 

            


            // retrieve data from database now
            $sql = "SELECT DISTINCT `batch`, `section` FROM `schedulecheckok9`;";
            $result = $conn->query($sql);

            //$pa = "/(^[0-9]{2}(([\s][A-Z])?)([\s]?|[\s]*)$)|(^[0-9]{2}[\+][0-9]{2}([\s]?|[\s]*)$)|(^retake$)([\s]?|[\s]*)/i"; 
            $batcharr = array(1);

            while($row = $result->fetch_assoc()) {
                                             
                $batcharr[] = $row['batch'] . " " . $row['section'];
            }


            echo json_encode($batcharr);
             
             $conn->close();

/*
        if ($conn->query($sql2) === TRUE) {  // $conn->query() otar vitre dia jar.
            echo "Table MyGuests created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }  */

          //  $conn->query("CALL `createTableProcTest`();");


            
            

        } 


    }


?>