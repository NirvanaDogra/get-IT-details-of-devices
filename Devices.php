<html class="w3-light-grey">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<?php
echo '<h1 class="w3-container w3-center w3-padding-32">The list is as follows</h1><br>';

//check if the submit button was cliked by the user
if ( (isset( $_POST['submit'] )) ){
    // retrieve the form data by using the element's name attributes value as key
    $val1 = $_REQUEST['First'];
    $val2 = $_REQUEST['second'];

    //getting long value to be use in a for loop
   // $start = ip2long($val1);
    $start = sprintf('%u', ip2long($val1));
    $end = sprintf('%u', ip2long($val2));
    
   // $end = ip2long($val2);

    if(!$start || !$end) {  
        //whill give me a negative value in case of incorrect value 
    die('<p class="w3-container w3-center">Please enter a valid range</p>');
    }
    else{
        pingAllIP($start, $end);
    }    
}
function pingAllIP($start, $end)
{
    //echo($start);
    //going through the entire IP range
    for($i=$start; $i<=$end; $i++){
        $ip=long2ip($i);
        echo '<h2 class="w3-container w3-center">',
              "$ip</h2>";
        
        
        exec("ping -n 1 " . $i, $output, $result);  
         
        if (strpos($output[5], 'Packets: Sent = 1, Received = 1, Lost = 0 (0% loss)') && strpos($output[2], 'Destination host unreachable') ==FALSE) {
            echo '<p class="w3-container w3-center">the computer was found<p>';  
           
        }    
        else{echo '<p  class="w3-container w3-center">computer is offline<p>';}
        //printhing button
        echo '<form  class="w3-container w3-center " action="getDetails.php" method="post">',   
             '<input type="hidden" value='.$ip.' name="IP" />',                    
             '<input class="w3-card-4 w3-margin w3-white" type="submit" name="submit" />',
             '</form>'  ;   
             
     $output="";
        
    }
   

}
?>
</html>