<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>demo</title>

	
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>     <!-- google jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.3.1.js" 
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script> <!-- google theke ansi -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>     <!-- google jquery cdn -->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">



    <style type="text/css">

        div{

             
            margin : auto;
            margin-top: 50px;
            
        }

        body{

            background-color:  rgba(167, 170, 171, 0.937);
        }

    </style>

</head>


<body>



<div class="container">

        <table id="myTable" class="table table-success table-striped" style="display:none;">

            <tr>

             <th>Date &</br>TIME</th>  

    <?php


        // $stm = "SELECT dayy from `schedulecheckok9` WHERE id = 1;";  
        // //$data = mysqli_fetch_array($stm);
        // $selectedBatch = mysql_result($stm, 0);
        // console.log($selectedBatch);
        $selectedBatch = "";

        $db = mysqli_connect('localhost', 'root', '','test'); // connect db


        $query = "SELECT * FROM `schedulecheckok9`"; 

        $resdata = mysqli_query($db, $query); 
        $rowToProvideData = $resdata;
        $Fetch_ForDayheader = $resdata; // total data


        $regex_sec = "/^section$/i";
        $nmb = 1;   // 'timee1' 


        while($row = mysqli_fetch_array($resdata)){  // data fetch kortese. eita 1st row fetch kortese.  fetches all the row

            if($row['id'] == 1){
                $selectedBatch = $row['userSelectedBatch'];
            }

            if(preg_match($regex_sec, $row['section']) == 1){  // section regex er sathe jodi match hoy. 

                $regex_time = "/^[0-9]{1,2}:[0-9]{1,2}-[0-9]{1,2}:[0-9]{1,2}(am|pm)$/i"; // 08:55-9:45AM

                // loop chalaisi
                for($nmb = 1; $nmb < 50; $nmb){  // 50 er beshi hobe na time row. nmb hocche timee er porer ta count korar jonno.

                    $columnname = "timee" . $nmb;   // column name create kortese db er colmn er sathe match kore
                    //echo $columnname;

                    if(preg_match($regex_time, $row[$columnname]) == 1){

                        //print time header
                        echo "<th>" . $row[$columnname] . "</th>";
                        
                        
                        $nmb++;   
                    } 
                    else{
                        break;  // loop theke ber hobe for loop
                    }
                }                 
            } 
            
            if($nmb > 1){  // ekbar chaitesi while loop choluk


                break;  // jodi regex mile section er sathe, tarpor for loop e jabe time regex match korte,jokhon r time thakbe na ber hobe. 
                        //num barbe, mane amra time and section peye gesi, amra ber hoye jabo while loop theke

            }
        }   

        echo "</tr>";  //end header

        //echo "<tbody>";




        // if there is any empty column of dayy, fill them up with correct value(correct day)
        $regex_day = "/(sunday)|(monday)|(tuesday)|(wednesday)|(thursday)|(friday)|(saturday)|(sun)|(mon)|(tues)|(wed)|(thursday)|(fri)|(sat)/i";

        $storeDay = "TODAYY!"; // initialize identifier

        mysqli_data_seek($resdata, 0);

        while($row = mysqli_fetch_array($resdata)){
            
            if((preg_match($regex_day, $row['dayy']) == 1)){

                $storeDay = $row['dayy'];

                break; // stored the first valid data of day column from db
            }
        }
        while($row = mysqli_fetch_array($resdata)){

            if((preg_match($regex_day, $row['dayy']) == 1)   && ($storeDay != $row['dayy'])){

                $storeDay = $row['dayy']; // notun day paisi. store oise current point kora day in fetching

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



        }


    
    


        // table er row data print kortese course er
        // selected batch first ei bar korilaimu ekbar. uprer while loop o, ono ekbar loop ghurani oise.
        //SELECT B from table_name WHERE A = 'a';
        $n=1;
        mysqli_data_seek($resdata, 0);

        while($row = mysqli_fetch_array($resdata)){  //print korbo data tablebody er

           
            // combine batch and section from database batch and section data. 
            if (!empty($row['section'])){  // batch null na thakhe tahole combine batch and section
                $batchandSection = $row['batch'] . " " . $row['section'];  // db er data
            } else{
                $batchandSection = $row['batch']; // null thakhle sudhu store batch
            }


           // store selected data by user which was stored in 'newnewcolumn' column
            //$selectedBatch = $row['userSelectedBatch'];  //selected data from user
            $selectedBatch = preg_replace("/\s+/", "", $selectedBatch); // remove all the whitespaces from selected batch
            $batchandSection = preg_replace("/\s+/", "", $batchandSection); // remove all the whitespaces from combined batch and section from db

            
            
            
            // echo "</br>" . "my batch and section combined:" . $batchandSection . "|||";
            // echo "user selected bacth:" . $selectedBatch . "end";


            

            $reg_forCombinedBatches = "/^[0-9]{2}[\+][0-9]{2}([\s]?|[\s]*)$/";  // if two batches are combined
            $str = array();
            if(preg_match($reg_forCombinedBatches, $batchandSection) == 1){    //$str = "";   $cntnmb = 1;
               
               // echo "</br>" . "my combined batch :" . $batchandSection ."</br>";


                // alada kortesi each batch in a array
                for($i = 0; $i < strlen($batchandSection) ; $i++){
                    $tmp_str = ""; // concate korar jonno characters
        
                    for($j = $i; $batchandSection[$j] != '+' ; $j++){                      
                        if($j == (strlen($batchandSection)-1)) break; // jodi index j sesher dike chole jay, tokhon tho '+' pabe na. So sesher index hole jeno stop hoye jay condition dewa hoise
                        $tmp_str .= $batchandSection[$j];                    
                    }

                    $str[] = $tmp_str; // array te store korbo
                    $i = $j; // keep the value of j to i. j te '+' er index ache. for loop e giye index ek increase hoye abar '+' er porer index e jabe
                }
            } // combined batches gula alada korsi str array te.

            
            // check korbo selected batch ki ei string gular kunu ektar sathe mile ki na! 
            $matchedWith_combinedBatches = 0;
            for($i = 0; $i < count($str) ; $i++){
 
                if($selectedBatch == $str[$i]){

                    $matchedWith_combinedBatches = 1; 
                    break;
                }
            }
            




            if($batchandSection == $selectedBatch || $matchedWith_combinedBatches == 1){  // batch matches in any row of db table. first row te amra. row fetch hocche.
                
                //echo "</br>" . "MATCHES"; echo $n;

                // jodi ulta irrilivant jinish stored thake batch and section column e, tao milbe na selectedbatch variable er sathe. So if e dhuktese na.

                // jodi match hoy prothome amra notun row create korbo
                echo "<tr>"; // new row created in html table
                //today print korbo prothom cell e
                // add day at first box or column
               // echo $array_day[$idx_dayarr];
                
            /*   echo "<td>" . $array_day[$idx_dayarr] . "</td>"; //today
                if($idx_dayarr < (count($array_day)-1)){
                    $idx_dayarr++; //index baraisi day array er. porer day print korar jonno
                } else{
                    $idx_dayarr=0;
                } //index baranu sesh porer row te porer day print korar jonno */

                // $idExt_td = 1;
                // $idfor_td = "day" . $idExt_td;

                echo "<td>" . $row['dayy'] . "</td>";
                

                // ekhon baki shomoy data gulu row er print korbo

                $index = 1;  // loop chalabar jonno random index nisi
                for($index=1; $index < $nmb; $index++){  // nmb theke chuto thakle. loop chalaisi column name generate korar jonno db er
                    
                    
                    $columnname_Time = "timee" . $index;

                    if($matchedWith_combinedBatches == 1 && !empty($row[$columnname_Time])){

                        echo "<td>" . $row[$columnname_Time] . "</br>(" . $batchandSection . ")</td>"; // index nmb er shoman hole, table data print kora bondho
                    
                    } else {

                        echo "<td>" . $row[$columnname_Time] . "</td>"; // index nmb er shoman hole, table data print kora bondho

                    }
                    
                    
                    
                } // shob time column er data print kora sesh
                
                echo "</tr>";  // row ended here

            } //jodi user selected batch match hoy db er batch column section er sathe, puro oi row er data ana sesh 

        } // end while loop


        // kaj sesh

        
        mysqli_close($db);


   // }
        
        ?>

        </table>

    </div>

    
    <script type="text/javascript">

        $(document).ready(function () {

            $("#myTable").attr("style", "display:block");
            

            var table = document.getElementById("myTable");
            
            var rowlen = table.rows.length;
            var cells_len = table.rows[1].cells.length;
            
            for(var r=1; r < rowlen ; r++){



                console.log(table.rows[r].cells[0].innerHTML);

                var current_rows_day = table.rows[r].cells[0].innerHTML;
                var next_rows_day = table.rows[r+1].cells[0].innerHTML;

                if(current_rows_day == next_rows_day){   //console.log("same day");

                    var x = table.rows[r].cells; // pura row
                    //console.log(x);

                    for(var c=1; c < cells_len ; c++){

                        //check is there any cell is empty

                        var next_row_cell = table.rows[r+1].cells[c].innerHTML; console.log("next row cell : " + next_row_cell + "\n");
                        var current_row_cell = table.rows[r].cells[c].innerHTML; console.log("current row cell : " + next_row_cell + "\n");
                            
                            
                        if(next_row_cell != ""){ // not empty

                            //console.log("next row cell if not empty : " + next_row_cell + "\n");

                            x[c].innerHTML = next_row_cell;
                        
                        } 

                    } // end for loop. each cell empty ni check kore ager row er same index er cell e pathabe
                    
                    table.deleteRow(r+1);

                } // end if

            } // end for loop
            

        });

    </script>


</body>
</html>



