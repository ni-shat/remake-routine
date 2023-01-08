<?php

header("Content-Type: application/json");
 if(isset($_POST)){
     echo json_encode($_FILES);
 }

use SimpleExcel\SimpleExcel; // namespace



// if(is_array($_FILES)) {
//     if(is_uploaded_file($_FILES['excel_file']['tmp_name'])) {
    
//     $fileName   = $_FILES['excel_file']['name'];
    
//     $sourcePath = $_FILES['excel_file']['tmp_name'];
//     $targetPath = "uploads/".$_FILES['excel_file']['name'];
    
//     if($fileName ==''){
//         echo "<div id='errorLayer'>Please select a file</div>";
//         exit;
//     }
    
//     $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
//     $allowTypes = array('csv');
//     if (!in_array($fileType, $allowTypes, true)) {
//         echo "<div id='errorLayer'>File type is invalid. Only CSV is allowed</div>";
//         exit;
//     }



   // $upload_path = './uploads/'. basename($_FILES['excel_file']['name']);

    if(!empty($_FILES['excel_file']['name'])){

       

        if(move_uploaded_file($_FILES['excel_file']['tmp_name'],$_FILES['excel_file']['tmp_name'])){

            $upload = 'ok'; echo "OK";
            
            require_once('SimpleExcel/SimpleExcel.php');       // load the main class file (if you're not using autoloader)

            $excel = new SimpleExcel('csv');                    // instantiate new object (will automatically construct the parser & writer type as XML)

            $excel->parser->loadFile($_FILES['excel_file']['name']);            // load an file from server to be parsed

            $foo = $excel->parser->getField();                  // get complete array of the table
        //     $bar = $excel->parser->getRow(6);  // fura row oibo. ar index shoho               // get specific array from the specified row (3rd row)
        //    // $baz = $excel->parser->getColumn(8); //column oibo index shoho               // get specific array from the specified column (4th row)
        //     $qux = $excel->parser->getCell(2,1); //2 nmb row, 1 nmb column               // get specific data from the specified cell (2nd row in 1st column)

            //  echo '<pre>';
            //  print_r($foo);                                      
            //  echo '</pre>';

       

            // $sectionbatch_ar = array(1); 

            // for($idx=0; $idx < count($foo); $idx++){

            //     $str = $foo[$idx][2];   // stores batch

            //     if($foo[$idx][1] != "")
            //         $str = $str . " " . $foo[$idx][1];  // stores section
                
            //     $sectionbatch_ar[$idx] = $str; 
            // }


            // $sectionbatch_ar = array_unique($sectionbatch_ar); 

           
           
            
            // $pa = "/(^[0-9]{2}(([\s][A-Z])?)([\s]?|[\s]*)$)|(^[0-9]{2}[\+][0-9]{2}([\s]?|[\s]*)$)|(^retake$)([\s]?|[\s]*)/i";


            // for($idx=0; $idx < count($sectionbatch_ar); $idx++){
                
            //      if(preg_match($pa, $sectionbatch_ar[$idx]) == 0){

            //          unset($sectionbatch_ar[$idx]);
            //      }
                
            // }
            

            $rowNmb = 1;

            while($rowNmb < 50){  // count left row to add in db  // 50 er beshi time hobe na eita chinta kore disi. 

                if(!$excel->parser->isColumnExists($rowNmb)){
                   break;
                }
                
                $rowNmb++;

            } //echo $rowNmb;  // row amr $rowNmb = 19, $rowNmb-1 = 18, $rowNmb-3 = 16. 
            
            //echo $excel->parser->isRowExists($rowNmb);

            //echo $excel->parser->isColumnExists(0);
            //echo "</br>".$rowNmb-1."</br>";  // row nmb

        

           
            $conn = new mysqli('localhost', 'root', '','user_auth');    // Create connection
          

            $sql = "CREATE TABLE `mytable656` (
                
                `dayy` VARCHAR(200) NOT NULL,
                `section` VARCHAR(200) NOT NULL,
                `batch` VARCHAR(200) 
                )"; 

            $fileIsUploading = 0;

            if ($conn->query($sql) === TRUE) {  // $conn->query() otar vitre dia jar.
                
                $fileIsUploading = 1;

                // $data = array('status' => 'success');
                // echo
            } else {
                // echo "Error creating table: " . $conn->error;
                $fileIsUploading = 0;

            }


            $countnmb = 1;

            while($countnmb < $rowNmb-3){   

                $sql2 = "ALTER TABLE `mytable656` ADD COLUMN
                (timee".$countnmb." varchar(50) CHARSET utf8mb4);";

                $conn->query($sql2); //echo $countnmb;
                $countnmb++;
            }  
            // $sql2 = "ALTER TABLE `mytable656` ADD COLUMN
            //     (selectedbatch varchar(50) CHARSET utf8mb4);";
            // $conn->query($sql2);



            // insert data into db rows
            $rowindex = 0;  
            $timeerowcnt = 1;

           // echo "<br/>".count($foo)."<br/>";

            while($rowindex < count($foo)){  


                    $v1 = $foo[$rowindex][0];
                    $v2 = $foo[$rowindex][1];
                    $v3 = $foo[$rowindex][2]; 

                    // echo "Row index = ".$rowindex.  $v1."<br/>";
                    // echo $v2."<br/>";
                    // echo $v3."<br/>";  


                $query = "INSERT INTO `cant` VALUES ('$v1','$v2','$v3'";  // $rownmb-3 = 

                

                for ($indexToGetdataforTimee = 3; $indexToGetdataforTimee < $rowNmb-1; $indexToGetdataforTimee++) { // $rowNmb-3 = 16
                    
                    $vForT = $foo[$rowindex][$indexToGetdataforTimee]; 

                    //echo "<br/>" . $vForT . "<br/>";

                    $query = $query . ", "."'$vForT'";

                  } 

                  $query = $query . ")";
 


                mysqli_query($conn, $query);
                $rowindex++;
                
            }  // end inserting data             


             
             $conn->close();


        // if ($conn->query($sql2) === TRUE) {  // $conn->query() otar vitre dia jar.
        //     echo "Table MyGuests created successfully";
        // } else {
        //     echo "Error creating table: " . $conn->error;
        // }  

          //  $conn->query("CALL `createTableProcTest`();");


            
          //echo "<script>Window.location.href='firstindexphp';</script>";
            echo $upload;

            }    
        }

       

    // }


    // }


?>