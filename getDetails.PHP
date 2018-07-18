 <html>
    <head>
        <title>Info Page</title>
    </head>
    <body>
       <?php
      set_time_limit(0);
      $ip = $_POST['IP'];
      echo "<h1>Details for " . $ip . "</h1>";
      echo "<br />";
      $val = sprintf('%u', ip2long($ip));
      $path = "C:\Users\ONGC\Desktop\USer\\" . $val . ".txt";
      $txt = "";

      //opening a preexistant file already dicovered
      if (file_exists($path)) {        
        $myfile = fopen("$path", 'r') or die("<p><b>file not existant</b></p>");
        $data = fread($myfile, filesize($path));
        $tr = getOutput($ip);
        $path1 = "C:\Users\ONGC\Desktop\User\Internal.txt";
        $myfile = fopen("$path1", "w") or ("interal error");
        exec("FC $path $path1", $change, $status);  

        //comparing the new results to the old 
        if ($change) {
          echo ("<h><b>THEIR IS A CHANGE IN THE DEVICE</b></h>");
          foreach($change as $key => $value){
            echo $value . "<br />";
          }
        }
      }
      else{
        //creating a new file
        $myfile = fopen("$path", "w") or die("Unable to create a file");
        $tr = getOutput($ip);
        fwrite($myfile, $tr);
        fclose($myfile);
      }

      function getOutput($ip){
        echo "<h2>1.Hostname</h2>";
        exec("wmic /node:" . $ip . " /user:ongc /password:ongc computersystem get name", $outcome1, $status);
        displayResult($outcome1);
       

        echo "<h2>2.OS details</h2>";
        exec("wmic /node:" . $ip . " get name", $outcome2, $status);
        displayResult($outcome2);

        echo "<h2>3.Processor</h2>";
        exec("wmic /node:" . $ip . " /user:ongc /password:ongc cpu get name", $outcome3, $status);
        displayResult($outcome3);

        echo "<h2>4.RAM capacity</h2>";
        exec("wmic /node:" . $ip . " /user:ongc /password:ongc memorychip get capacity", $outcome4, $status);
        displayResult($outcome4);

        echo "<h2>5.Video card</h2>";
        exec("powershell C:\xampp\htdocs\Output\video.ps1", $outcome5, $status);
        if (is_null($outcome5)) {
          echo "NULL";
        }
        else{
          $val = implode($outcome5);
          echo "yes $val ";
          displayResult($outcome5);
        }

        echo "<h2>6.Disk drives</h2>";
        exec("wmic /node:" . $ip . " /user:ongc /password:ongc logicaldisk get deviceid,filesystem", $outcome6, $status);
        displayResult($outcome6);

        echo "<h2>7.Mounted NFS</h2>";
        exec("wmic /node:" . $ip . " /user:ongc /password:ongc win32_mappedlogicaldisk get filesystem", $outcome7, $status);
        if (is_null($outcome7)) {
          echo "NULL";
        }
        else{
          $val = implode($outcome7);
          echo "yes $val ";
          displayResult($outcome7);
        }

        echo "<h2>8.Users</h2>";
        exec("wmic /node:" . $ip . " /user:ongc /password:ongc useraccount get name", $outcome8, $status);
        displayResult($outcome8);

        echo "<h2>9.Attached devices</h2>";
        exec("wmic /node:" . $ip . " /user:ongc /password:ongc win32_mappedlogicaldisk get filesystem", $outcome9, $status);
        displayResult($outcome9);

        echo "<h2>10.Serial Number</h2>";
        exec("wmic /node:" . $ip . " /user:ongc /password:ongc bios get serialnumber", $outcome10, $status);
        displayResult($outcome10);

        $txt = "\r\n" . $ip . "\r\n1)" . implode($outcome1) . "\r\n2)" . implode($outcome2) . "\r\n3)" . implode($outcome3) . "\r\n4)" . implode($outcome4) . "\r\n5)" . implode($outcome5) . "\r\n6)" . implode($outcome6) . "\r\n7)" . implode($outcome7) . "\r\n8)" . implode($outcome8) . "\r\n9)" . implode($outcome9) . "\r\n10)" . implode($outcome10);
        return $txt;
        }

      function displayResult($outcome)
      {
        foreach($outcome10 as $key => $value){
          echo $value . "<br />";
        }
      }

      // $servername = "localhost";
      // $username = "";
      // $password = "password";
      // // Create connection
      // $conn = new mysqli($servername, $username, $password);
      // // Check connection
      // if ($conn->connect_error) {
      //     die("Connection failed: " . $conn->connect_error);
      // }
      // echo "Connected successfully";
      // $user='root';
      // $pass= '';
      // $db= 'testdb';
      // $db = new mysqli('localhost', $user, $db) or die("Unable to connect");
      // echo "great work";
      // $sql = "INSERT INTO mywork (hostname, OS, processor, ram, videocard, diskdrives, NFS, users, attachedDevices, serialno)
      // VALUES ('abc','fbfg', $outcome3, $outcome4, $outcome5, $outcome6, $outcome7, $outcome8, $outcome9, $outcome10)";
      // if (mysqli_query($conn, $sql)) {
      //   echo "New record created successfully";
      // } else {
      //   echo "Error: " . $sql . "<br />" . mysqli_error($conn);
      // }
      // mysqli_close($conn);

      ?> 
      </body>
      </html>
      

      

      

