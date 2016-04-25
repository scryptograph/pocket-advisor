<?PHP
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: login3.php");
}
else{
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
  <body>
    <div class="container">

      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h1>Pocket Advisor Admin Panel</h1>
            <p class="lead">A friendly foundation</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-4">
            <div class="list-group table-of-contents">
              <a class="list-group-item" href="#navbar"></a>
              <a class="list-group-item" href="#buttons">Buttons</a>
              <a class="list-group-item" href="#typography">Typography</a>
              <a class="list-group-item" href="#tables">Tables</a>
              <a class="list-group-item" href="#forms">Forms</a>
              <a class="list-group-item" href="#navs">Navs</a>
              <a class="list-group-item" href="#indicators">Indicators</a>
              <a class="list-group-item" href="#progress-bars">Progress bars</a>
              <a class="list-group-item" href="#containers">Containers</a>
              <a class="list-group-item" href="#dialogs">Dialogs</a>
            </div>
          </div>
        </div>
      </div>
  </body>
  </html>

}
?>

