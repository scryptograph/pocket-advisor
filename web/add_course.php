<?php
	$errorMessage = "";
	$course_id = "";
	$course_name = "";
	$course_description = "";
	$credit_hours = "";

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
  $course_id = $_POST['course_id'];
  $course_name = $_POST['course_name'];
  $course_description = $_POST['course_description'];
  $credit_hours = $_POST['credit_hours'];

  $course_id = htmlspecialchars($course_id);
  $course_name = htmlspecialchars($course_name);
  $credit_hours = htmlspecialchars($credit_hours);
  $course_description = htmlspecialchars($course_description);

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

    $course_id = quote_smart($course_id, $db_handle);
    $course_name = quote_smart($course_name, $db_handle);
    $course_description = quote_smart($course_description, $db_handle);
    $credit_hours = quote_smart($credit_hours, $db_handle);

    $SQL = "INSERT INTO course (id , course_name, credit_hours, description) VALUES ($course_id, $course_name, $credit_hours, $course_description)";
    $result = mysql_query($SQL);
    $errorMessage = "SUCCESS";
    mysql_close($db_handle);
  }
  else{
  	$errorMessage = "Cannot Connect to Database";
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
          <p class="lead">Add New Course to Catalog </p>
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
                  <a class="list-group-item" href="#add_course.php">Add Course</a>
                  <a class="list-group-item" href="#forms">Modify Course</a>
                  <a class="list-group-item" href="#navs">Delete Course</a>
                  <a class="list-group-item" href="#dialogs">Delete Account</a>
                </div>
              </div>

  
          <div class="col-lg-6">
            <div class="well bs-component">
              <form class="form-horizontal"  METHOD ="POST" ACTION ="add_course.php">
                <fieldset>
                  <legend>Enter New Course Details</legend>
                  <div class="form-group">
                    <label for="username" Name="username" class="col-lg-2 control-label">Course ID </label>
                    <div class="col-lg-10">
                      <input type="text" Name = "course_id" class="form-control" id="course_id" placeholder="Course ID" "<?PHP print $course_id;?>" maxlength="20"> <?PHP print $errorMessage;?>
                      <span class="help-block">Enter unique Course ID </span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Course Name  </label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name = "course_name" id="course_name" placeholder=" Course Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="credit_hours" class="col-lg-2 control-label">Credit Hours  </label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name = "credit_hours" id="credit_hours" placeholder="Credit Hours">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name = "course_description" id="course_description" placeholder="Description">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                      <INPUT TYPE = "Submit" Name = "Submit1" class="btn btn-primary" VALUE = "Register">
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>










