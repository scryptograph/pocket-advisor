<?PHP
//session_start();
//if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	//header ("Location: login.php");
//}

//set the session variable to 1, if the user signs up. That way, they can use the site straight away
//do you want to send the user a confirmation email?
//does the user need to validate an email address, before they can use the site?
//do you want to display a message for the user that a particular username is already taken?
//test to see if the u and p are long enough
//you might also want to test if the users is already logged in. That way, they can't sign up repeatedly without closing down the browser
//other login methods - set a cookie, and read that back for every page
//collect other information: date and time of login, ip address, etc
//don't store passwords without encrypting them

$uname = "";
$pword = "";
$fname = "";
$mname = "";
$lname = "";
$email = "";
$role = "Student";
$gpa = "NULL";
$errorMessage = "";
$num_rows = 0;
$admin_access = "STUDENT";

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

	//====================================================================
	//	GET THE CHOSEN U AND P, AND CHECK IT FOR DANGEROUS CHARCTERS
	//====================================================================
	$uname = $_POST['username'];
	$pword = $_POST['password'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $admin_access = @$_POST['admin_access'];

	$uname = htmlspecialchars($uname);
	$pword = htmlspecialchars($pword);
    $fname = htmlspecialchars($fname);
    $mname = htmlspecialchars($mname);
    $lname = htmlspecialchars($lname);
    $email = htmlspecialchars($email);
    $admin_access = htmlspecialchars($admin_access);
    

	//====================================================================
	//	CHECK TO SEE IF U AND P ARE OF THE CORRECT LENGTH
	//	A MALICIOUS USER MIGHT TRY TO PASS A STRING THAT IS TOO LONG
	//	if no errors occur, then $errorMessage will be blank
	//====================================================================

	$uLength = strlen($uname);
	$pLength = strlen($pword);

	if ($uLength >= 8 && $uLength <= 20) {
		$errorMessage = "";
	}
	else {
		$errorMessage = $errorMessage . "Username must be between 10 and 20 characters" . "<BR>";
	}

	if ($pLength >= 6 && $pLength <= 16) {
		$errorMessage = "";
	}
	else {
		$errorMessage = $errorMessage . "Password must be between 6 and 16 characters" . "<BR>";
	}


//test to see if $errorMessage is blank
//if it is, then we can go ahead with the rest of the code
//if it's not, we can display the error

	//====================================================================
	//	Write to the database
	//====================================================================
	if ($errorMessage == "") {

	$user_name = "root";
	$pass_word = "";
	$database = "pocket-advisor";
	$server = "127.0.0.1";

	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);

	if ($db_found) {

		$uname = quote_smart($uname, $db_handle);
		$pword = quote_smart($pword, $db_handle);
        $email = quote_smart($email, $db_handle);
        $fname = quote_smart($fname, $db_handle);
        $mname = quote_smart($mname, $db_handle);
        $lname = quote_smart($lname, $db_handle);
        $admin_access = quote_smart($admin_access, $db_handle);

	//====================================================================
	//	CHECK THAT THE USERNAME IS NOT TAKEN
	//====================================================================

		$SQL = "SELECT * FROM user WHERE login = $uname";
		$result = mysql_query($SQL);
		$num_rows = mysql_num_rows($result);

		if ($num_rows > 0) {
			$errorMessage = "Username already taken";
		}
		
		else {$SQL = "SELECT * FROM user";
            $result = mysql_query($SQL);
            $num_rows = mysql_num_rows($result);

            $SQL = "INSERT INTO user (id ,login, password, email, first_name, middle_name, last_name, role) VALUES ($num_rows, $uname, md5($pword), $email, $fname, $mname, $lname, $admin_access)";
			$result = mysql_query($SQL);

			mysql_close($db_handle);

		//=================================================================================
		//	START THE SESSION AND PUT SOMETHING INTO THE SESSION VARIABLE CALLED login
		//	SEND USER TO A DIFFERENT PAGE AFTER SIGN UP
		//=================================================================================

			session_start();
			$_SESSION['login'] = "1";

			header ("Location: page3.php");
		}
	}
	else {
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
              <li><a href="login.php">Login</a></li>   
              <li class="active"><a href="signup.php">Sign Up <span class="sr-only">(current)</span></a></li>
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
              <form class="form-horizontal"  METHOD ="POST" ACTION ="signup.php">
                <fieldset>
                  <legend>Register New User</legend>
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
                        <label>
                          <input type="checkbox" name = "admin_access" id = "admin_access" value = "REQUEST"> Request Admin Access
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name = "email" id="email" placeholder=" Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name = "fname" id="fname" placeholder="First Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name = "mname" id="mname" placeholder="Middle Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label"></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name = "lname" id="lname" placeholder="Last Name">
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
          <div class="col-lg-4 col-lg-offset-1">
              
          </div>
<!--
<head>
	<title>Basic Login Script</title>
</head>

<body>
	<div class="row">
    	<div class="col-md-5 col-md-offset-1">
			<FORM NAME ="form1" METHOD ="POST" ACTION ="signup.php">
				<form class="form-horizontal">
  					<div class="row">
          				<div class="col-lg-30">
            				<div class="well bs-component">
              					<form class="form-horizontal">
                					<fieldset>
										<legend>Create New Account</legend>
                                        <div class="form-group">
                                            <label for="inputPassword" class="col-lg-2 control-label">First Name</label>
                                            <div class="col-lg-10">
                                                <input type="fname" Name='fname' class="form-control" id="inputPassword" placeholder="First Name">
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                                        <div class="col-lg-10">
                                            <input type="text" Name='username' class="form-control" id="inputEmail" placeholder="Username" "<?PHP print $uname;?>" maxlength="20"> <?PHP print $errorMessage;?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                            <div class="col-lg-10">
                                                <input type="password" Name='password' class="form-control" id="inputPassword" placeholder="Password">
                                            </div>
                                        </div>
                                     <div class="form-group">
                                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                        <div class="col-lg-10">
                                            <input type="password" Name='password' class="form-control" id="inputPassword" placeholder="Password">
                                        </div>
                                    </div>
                                    <INPUT TYPE = "Submit" Name = "Submit1" class="btn btn-primary" VALUE = "Register">
    	                                   </P>
                                        </fieldset>


</FORM>
-->
<P>

	</body>
	</html>
