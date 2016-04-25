<?PHP
  $errorMessage = "";
  $user_id = "";

//==========================================
//  ESCAPE DANGEROUS SQL CHARACTERS
//==========================================
function quote_smart($value, $handle) {

   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value);
   }

   if (!is_numeric($value)) {
       $value = "'" . mysql_real_escape_string($value, $handle) . "'";
   }
   return $value;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $user_id = $_POST['user_id'];

  $user_id = htmlspecialchars($user_id);

  //==========================================
  //  CONNECT TO THE LOCAL DATABASE
  //==========================================
  $user_name = "root";
  $pass_word = "";
  $database = "pocket-advisor";
  $server = "127.0.0.1";

  $db_handle = mysql_connect($server, $user_name, $pass_word);
  $db_found = mysql_select_db($database, $db_handle);

  if ($db_found) {

    $user_id = quote_smart($user_id, $db_handle);

    $SQL = "SELECT * FROM user WHERE id = $user_id ";
    $result = mysql_query($SQL);
    $num_rows = mysql_num_rows($result);



  //====================================================
  //  CHECK TO SEE IF THE $result VARIABLE IS TRUE
  //====================================================

    if ($result) {
      if ($num_rows > 0) {
        $SQL1 = "UPDATE user SET role = 'ADMIN' WHERE id = $user_id";
        $result2 = mysql_query($SQL1);
        $errorMessage = "SUCCESS";
        if ($result2) {
          $errorMessage = "UPDATED";
        }
      }
      else {
        
        $errorMessage = "FAIL";
      } 
    }
    else {
      $errorMessage = "Error logging on foo";
    }

  mysql_close($db_handle);

  }

  else {
    $errorMessage = "Error logging on";
  }

}

?>

<html>
  <link href="css/bootstrap.min.css" rel="stylesheet">
    <div class="bs-component">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="login.php">Software Engineering Project</a>
          </div>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="login.php">Home </a></li>
              <li><a href="about.php">About</a></li>
              <li><a href="login.php">Dev. Team</a></li>
            </ul>
            <form class="navbar-form navbar-right" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right"> 
              <li><a href="login.php">Login</a></li>   
              <li class="active"><a href="signup.php">Sign Up <span class="sr-only">(current)</span></a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>

    <form METHOD ="POST" ACTION ="test.php">
      Username: <INPUT TYPE = 'TEXT' Name ='user_id'  value="<?PHP print $user_id;?>" maxlength="20"> <?PHP print($errorMessage) ?>
      <P align = center>
        <INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Login">
      </P>
    </FORM>
</html>

