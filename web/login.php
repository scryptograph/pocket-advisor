<?PHP

$uname = "";
$pword = "";
$errorMessage = "";
//==========================================
//	ESCAPE DANGEROUS SQL CHARACTERS
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
	$uname = $_POST['username'];
	$pword = $_POST['password'];

	$uname = htmlspecialchars($uname);
	$pword = htmlspecialchars($pword);

	//==========================================
	//	CONNECT TO THE LOCAL DATABASE
	//==========================================
	$user_name = "root";
	$pass_word = "";
	$database = "pocket-advisor";
	$server = "127.0.0.1";

	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);

	if ($db_found) {

		$uname = quote_smart($uname, $db_handle);
		$pword = quote_smart($pword, $db_handle);

		$SQL = "SELECT * FROM user WHERE login = $uname AND password = md5($pword)";
		$result = mysql_query($SQL);
		$num_rows = mysql_num_rows($result);

	//====================================================
	//	CHECK TO SEE IF THE $result VARIABLE IS TRUE
	//====================================================

		if ($result) {
			if ($num_rows > 0) {
				session_start();
				$_SESSION['login'] = "1";
				header ("Location: page1.php");
			}
			else {
        $errorMessage = "Username or Password Incorrect";
				//session_start();
				//$_SESSION['login'] = "";
				//header ("Location: login.php");
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
              <li class = "active"><a href="login.php">Login<span class="sr-only">(current)</span></a></li>   
              <li><a href="signup.php">Sign Up </a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>

    <div class="bs-docs-section col-lg-offset-1" >
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="forms">Pocket Advisor</h1>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="well bs-component">
              <form class="form-horizontal"  METHOD ="POST" ACTION ="login.php">
                <fieldset>
                  <legend>Admin Portal Login</legend>
                  <div class="form-group">
                    <label for="username" Name="username" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                      <input type="text" Name = "username" class="form-control" id="username" placeholder="Username" "<?PHP print $uname;?>" maxlength="20"> <?PHP print $errorMessage;?>
                      <span class="help-block">Enter unique Username with a minimum of 8 characters</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" Name="password" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                      <input type="password" Name = "password" class="form-control" id="password" placeholder="Password" "<?PHP print $pword;?>" maxlength="16">
                      <div class="checkbox">
                      </div>
                    </div>
                  </div>
                  <INPUT TYPE = "Submit" class="btn btn-primary" Name = "Submit1"  VALUE = "Login">
                  <a href="signup.php" class="btn btn-primary">Sign Up</a>
                  
                </fieldset>
              </form>
            </div>
          </div>
          <div class="col-lg-4 col-lg-offset-1">
              
          </div>

<!-- End Navbar -->
<!--
<div class="row">
    <div class="col-md-5 col-md-offset-1">

<FORM NAME ="form1" METHOD ="POST" ACTION ="login.php">
<form class="form-horizontal">
  <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="forms">Pocket Advisor</h1>
            </div>
          </div>
        </div>
          <div class="col-lg-30">
            <div class="well bs-component">
              <form class="form-horizontal">
                <fieldset>
	<legend>Admin Portal Login</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Username</label>
      <div class="col-lg-10">
        <input type="text" Name='username' class="form-control" id="inputEmail" placeholder="Username" "<?PHP print $uname;?>" maxlength="20">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-10">
        <input type="password" Name='password' class="form-control" id="inputPassword" placeholder="Password">
      </div>
    </div>
		<INPUT TYPE = "Submit" class="btn btn-primary" Name = "Submit1"  VALUE = "Login">
		<a href="signup.php" class="btn btn-primary">New User</a>
	</P>
  </fieldset>

</FORM>
<-->
</div></div>
<P>
<?PHP print $errorMessage;?>




</body>
</html>