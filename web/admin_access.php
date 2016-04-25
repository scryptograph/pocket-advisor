<?PHP
$errorMessage = "";
  session_start();
  if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
  	header ("Location: login.php");

  $user_id = "";
  $role = "ADMIN";
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
    $role = htmlspecialchars($role);

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
      $role = quote_smart($role, $db_handle);

      $SQL1 = "UPDATE user SET role = $role WHERE id = $user_id";
      $SQL = "SELECT * FROM user WHERE id = $user_id";
      $result = mysql_query($SQL);
      $result1 = mysql_query($SQL1);

      $num_rows = mysql_num_rows($result);
      
    //====================================================
    //  CHECK TO SEE IF THE $result VARIABLE IS TRUE
    //====================================================

      if ($result) {
        if ($num_rows > 0) {
          $errorMessage = "YES";
        }
        else {
          $errorMessage = $errorMessage . "WTF" . "<BR>";
        } 
      }
      else {
        $errorMessage = "Whoops.. User Does Not Exist";
      }

    mysql_close($db_handle);

    }

    else {
      $errorMessage = "Error logging on";
    }
  }}
?>

<!DOCTYPE html>
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
              <li><a href="index.php">Home </a></li>
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
              <li><a href="page2.php">Log Out</a></li>   
              <li><a href="signup.php">Sign Up </a></li>
            </ul>
          </div>
        </div>
      </nav>
  <body>
    <div class="container">

      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h1>Pocket Advisor Admin Panel</h1>
            <p class="lead">Give User Admin Access </p>
          </div>
        </div>
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
      <div class="col-lg-4 col-lg-offset-1">

        <form class="bs-component" METHOD ="POST" ACTION ="admin_access.php">
          <div class="form-group">
            <label class="control-label" for="focusedInput">Enter User ID to Grant Admin Access</label> <?PHP print $errorMessage;?>
            <input class="form-control" id="user_id" type="text" value="0" name="user_id" > 
            <INPUT TYPE = "Submit" class="btn btn-primary" Name = "Submit"  VALUE = "LEGGO">
          </div>
        </form>
      </div>
  <?PHP print $errorMessage;?>
	</body>
	</html>
