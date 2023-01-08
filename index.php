<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap demo</title>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
    <script src="https://malsup.github.io/jquery.form.js"></script> 
 -->

    <script src="https://code.jquery.com/jquery-3.3.1.js" 
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script> <!-- google theke ansi -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>     <!-- google jquery cdn -->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

  <!--  <script src="jquery.min.js"></script> 

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
    <script src="https://malsup.github.io/jquery.form.js"></script>  -->


    <style type="text/css">

        .selector-for-some-widget {
            box-sizing: content-box;
        }

        .jumbotron{

            color:black;

            box-shadow: 2px 3px 7px 2px rgba(0,0,0,0.02);
            background-position: 0 50%;
           /* background-image: url("bbb.jpg");   */
      background-color: rgb(189, 164, 164); }

        body{

            background-image: url("bik.jpg");  background-size: cover;

        }

        a:link{
            text-decoration:none;
        }
        a:hover{
            text-decoration:none;
        }

    </style>

</head>


  <body>



    <div class="jumbotron container container-sm" style="border-radius: 50px; width:1200px; height:520px; margin: 4em auto;">

      

            <h1 class="display-4" style="text-align: center;">Remake your own routine!</h1>
           
            <hr class="my-4">
                     
            <p class="lead" style="text-align: center;">Choose a .CSV file </p>

            
                <form id="fupForm" method="post" enctype="multipart/form-data" class="needs-validation">
                    <div class="input-group mb-3 p-2" style="width:600px; margin:auto; margin-top: 30px;">                    
                        <input type="file" name="excel_file" class="form-control rounded-pill" id="validationCustom04" accept=".csv" required> 
                        <!-- <div class="invalid-feedback">Example invalid form file feedback</div>
                    -->
                         <button class="input-group-text rounded-5" style="margin-left: 5px;" name="submit" id="btn">Upload</button>
                      <!--   <input class="input-group-text rounded-5" style="margin-left: 5px;" type="submit" value="Upload" name="import">   -->              
                    </div>
                </form>
                

                <form method="post"> 			
                    <div class="input-group mb-3  p-2 " style="width:600px; margin:auto;">                  
                        <select class="form-select rounded-pill scrollable-menu batchselection" name="batches" id="inputGroupSelect04" aria-label="Example select with button addon">               
                            <option selected disabled>Select your batch...</option>

                        </select>                
                        <label class="input-group-text rounded-5" style="margin-left: 5px;" for="inputGroupSelect02">Options</label>          
                    </div>

                    <div style="width:300px; text-align:center; margin:auto; margin-top:28px; height:85px;">
                        <input type=button onclick="parent.open('http://localhost/remake_schedule/somefile.php')" id="pressbtn" class="btn btn-secondary rounded-5" 
                        style="width:300px;" value= 'GO TO SEE YOUR FILE'>

                        <!-- <button id="pressbtn" type="submit" class="btn btn-secondary rounded-5" name="submit2" style="width:300px;">
                        PRESS TO MAKE YOUR FILE </button> -->
                    </div>                 

                </form> 


    </div>

    <div style="display:none;" id="linkdiv">
        <a target="_parent" style="display:flex;text-align:center; height:35px; margin-top:10px;"><button style="width:2000px; background-color:rgb(99, 151, 125); color:white;">
        YOUR ROUTINE IS ALMOST THERE! PLEASE WAIT...
        <div class="spinner-border spinner-border-sm" style="" role="status" ma>
        <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow spinner-grow-sm" style="" role="status">
        <span class="visually-hidden">Loading...</span>
        </div>
    
    </button></a>
     
        
    </div>


    <!-- <div class="alert alert-success" id="linkdiv" role="" style=" margin: auto;">
        YOUR ROUTINE IS GETTING READY. PLEASE WAIT...
                   
         <button onclick="document.location='default.asp'">HTML Tutorial</button> 
        
    </div> -->
    <div class="alert alert-danger" style="display: none;" id="uploadStatus" role="alert"></div>
                



    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->


    <!-- Boot strap 5 theke add korsi -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



    <script type="text/javascript">

        $(document).ready(function(e){ 


            $("#fupForm").on('submit', function(e){   //alert("ADD");
                e.preventDefault();

                $.ajax({

                    type: 'POST',
                    url: 'getData.php',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,

                    beforeSend: function(){
                       // $(".progress").slideDown();
                        $('#fupForm').css("opacity",".5");
                        $("#fupForm").find("button").css("background-color", "rgba(225, 225, 225, 0.937)");
                        //$(".progress-bar").css("width",`${percentageFormatted}%`).attr
                        //("aria-valuenow", percentageFormatted).text(`${percentageFormatted}%`);
                         $("#fupForm").find("button").text("Uploading...");
                    },

                    success: function(data){
                        console.log(data);
                        console.log("nishat");
                        var obj = JSON.parse(data);  // got all the batch here in array
                        console.log(obj.length);                        
                        $('#fupForm')[0].reset();
                        $('#fupForm').css("opacity","1");
                        $("#fupForm").find("button").text("Uploaded");
                        $("#fupForm").find("button").css("background-color", "rgb(67, 172, 142)");
                        $("#fupForm").find("button").css("color", "white");	
                        
                        // for(var i=1; i<obj.length; i++){
                        //     console.log(obj[i]);
                        // }

                        
                        var regex = /(^[0-9]{2}(([\s][A-Z]{1})?)([\s]?|[\s]*)$)|(^retake$)([\s]?|[\s]*)/i;                               

                        for(var i=1; i < obj.length; i++){
                            if (!regex.test(obj[i])){ 
                                //if(!str[i].match(regex))
                                //if(!obj[i].match(regexBatch)){
                                console.log("not M : " + obj[i]);
                                obj.splice(i, 1); 
                                i = i-1;
                            }
                        }

                        obj.forEach(function(item){
                            var optionn = document.createElement("option");
                            optionn.text = item;
                            optionn.value = item;
                            inputGroupSelect04.appendChild(optionn);
                        });



                        // send data to seomefile.php using ajax

                        //$(document).ready(function(){

                            $("#inputGroupSelect04").change(function(){ //console.log("Inside change func");

                                var selectedbatchOpt = $(this).val(); console.log(selectedbatchOpt);

                                $("#pressbtn").click(function(evt) {
                                    e.preventDefault();
                                
                                $.ajax({

                                    type: 'POST',
                                    url: 'sendSelectedBatchData.php',
                                    data: {'batchID':selectedbatchOpt}, // na oile + dimu
                                   // contentType: false,
                                    cache: false,
                                    //processData:false,

                                    success:function(response){
                                        console.log(response);
                                        //$("#linkdiv").attr('style', 'display:block !important');
                                    }


                                }); // end ajax 

                            });
                        });

                        


                    },


                    error:function(){
                        console.log(data);
                        $("#fupForm").find("button").text("Failed to upload!");
                        $("#fupForm").find("button").css("background-color", "rgba(189, 53, 53, 0.937)");
                        $("#fupForm").find("button").css("color", "white");	
                        //$("#fupForm").find("button").text("Uploading error");
                        
                        // $("#uploadStatus").css("display","none");
                        //$('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>'); 
                    }
                        
                });

            });
            

        });  


    </script>


</body>
</html>

