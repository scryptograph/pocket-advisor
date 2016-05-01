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

  $data = array();

  if ($db_found) {
    $query = "SELECT id, login, email, first_name, middle_name, last_name FROM user WHERE id = $user_ID";

    $result = mysql_query($query);
    while ($row = mysql_fetch_assoc($result)){
      $data[] = $row;
    }
    $colNames = array_keys(reset($data));
    mysql_close($db_handle);

  }
  else{
    $errorMessage = "Database Not Found";
  }
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
              <li class="active"><a href="signup.php">Sign Up <span class="sr-only">(current)</span></a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <div class="bs-docs-section col-lg-offset-1" id="banner">
      <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-6">
          <h1>Pocket Advisor Admin Panel</h1>
          <p class="lead"> Admin Access Requests </p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3">
          <div class="container" align="left">
            <div class="row">
              <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="list-group table-of-contents">
                  <a class="list-group-item" href="test.php">Give User Admin Access</a>
                  <a class="list-group-item" href="revoke.php">Revoke Admin Access</a>
                  <a class="list-group-item" href="view_admin_req.php">View Admin Requests</a>
                  <a class="list-group-item" href="add_course.php">Add Course</a>
                  <a class="list-group-item" href="#forms">Modify Course</a>
                  <a class="list-group-item" href="#navs">Delete Course</a>
                  <a class="list-group-item" href="get_user_id.php">View User Courses</a>
                  <a class="list-group-item" href="#dialogs">Delete Account</a>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="well bs-component">
                  <form class="form-horizontal"  METHOD ="POST" ACTION ="view_user_courses.php">
                    <fieldset>
                      <legend>Enter User Details</legend>
                        User ID: <input type = "text" name = "user_id">
                        <input type = "submit" value = "Submit">
                    </fieldset>
                  </form>
                </div>
              </div>
