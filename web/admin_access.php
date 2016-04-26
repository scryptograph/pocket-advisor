<?PHP
  $errorMessage = "";
  $user_id = "";

  session_start();
  if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
  	header ("Location: login.php");


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
}
?>

<!DOCTYPE html>
<html>
  <link href="css/bootstrap.min.css" rel="stylesheet">
    <div class="container" align="left"> 
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
              <li><a href="index.php">Home </a></li>
              <li><a href="about.php">About</a></li>
              <li><a href="login.php">Dev. Team</a></li>
              <li><a href="page1.php">Admin Portal</a></li>
            </ul>
            <form class="navbar-form navbar-right" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right"> 
              <li><a href="page2.php">Log Out</a></li>   
              <li><a href="signup.php">Sign Up </a></li>
            </ul>
          </div>
        </div>
      </nav>
      <body>
        <div class="page-header" id="banner">
          <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
              <h1>Pocket Advisor Admin Panel</h1>
              <p class="lead">Give User Admin Access </p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-3"><div class="container" align="left">
              <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-4">
                  <div class="list-group table-of-contents">
                    <a class="list-group-item" href="#navbar">Give User Admin Access</a>
                    <a class="list-group-item" href="#buttons">Delete User</a>
                    <a class="list-group-item" href="#typography">Add University</a>
                    <a class="list-group-item" href="#tables">Add Course</a>
                    <a class="list-group-item" href="#forms">Modify Course</a>
                    <a class="list-group-item" href="#navs">Delete Course</a>
                    <a class="list-group-item" href="#indicators">Add Class</a>
                    <a class="list-group-item" href="#progress-bars">Modify Class</a>
                    <a class="list-group-item" href="#containers">Delete Class</a>
                    <a class="list-group-item" href="#dialogs">Delete Account</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br> <br>
          <div class="col-lg-6" align="left">
            <div class="form-group">
              <!--<form METHOD ="POST" ACTION ="admin_access.php">
                <div class="form-group">
                  <label for="inputEmail" class="col-lg-8 control-label">Enter User ID To Grant Admin Access :</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" name = "user_id" id="user_id" placeholder="User ID" value="<?PHP print $user_id;?>">
                    <?PHP print($errorMessage) ?>
                  </div>
                </div>
                <p>
                <div class="form-group">
                  <div class="col-lg-10 " align="left">
                    <INPUT TYPE = "Submit" Name = "Submit1" class="btn btn-primary" VALUE = "Submit">
                  </div>
                </div>
              </p>
              </form> -->
              <form METHOD ="POST" ACTION ="admin_access.php">
      Username: <INPUT TYPE = 'TEXT' Name ='user_id'  value="<?PHP print $user_id;?>" maxlength="20"> <?PHP print($errorMessage) ?>
      <P align = center>
        <INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Login">
      </P>
    </FORM>
          </div>
        </div>
      </body>
    <?PHP print $errorMessage;?>
	</html>
