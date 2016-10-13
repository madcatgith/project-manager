<?
include_once("ajax/whitelist.php");
if (in_array($_SERVER['REMOTE_ADDR'],$whitelist)):?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Passwords</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/main.css">
  <link href="/favicon.png" rel="shortcut icon">
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Project-manager</a>
      <ul class="nav navbar-nav">
      	<li class="active"><a href="index.php">Projects <span class="sr-only">(current)</span></a></li>
        <li><a href="add_project.php">Add project</a></li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" id="search" class="form-control" placeholder="Search">
        </div>
      </form>
    </div>
  </div> 
</nav>

<main>	
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<a href="#" id="sorter" data="DESC"><h1>Projects <span id="total" class="badge"></span></h1></a>
				<div class="list-group">

				</div>
        <div id="results" class="alert alert-danger"></div>
			</div>
			<div class="col-md-6">
				<h1>Access</h1>
        <div class="panel panel-default">
          <div class="panel-heading">
             <h3 class="panel-title" id="project_name"></h3>
          </div>
          <div class="panel-body main-panel">
          <div class="row">
          	<div class="col-md-12" id="url_box"></div>
          </div>
          <div class="row">
          	<div class="col-md-6">
          	<div class="panel-heading">
             <h3 class="panel-title">CMS</h3>
          	</div>
          <div class="panel-body" id="cms_holder"></div>
          	</div>
          	<div class="col-md-6">
          		<div class="panel-heading">
             		<h3 class="panel-title">FTP</h3>
          		</div>
          	<div class="panel-body" id="ftp_holder"></div>	
          	</div>
          </div>
          </div>
          <div class="panel panel-info" id="desc">
          <div class="panel-heading">
          <h3 class="panel-title">Comments:</h3>
          </div>
            <div class="panel-body">
              
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
            <form action="curllogin.php" id="login_form" method="post">
              <input type="hidden" name="wurl" id="wurl"/>
              <input type="hidden" name="admlogin" id="admlogin"/>
              <input type="hidden" name="admpass" id="admpass"/>
              <button type="button" id="login" class="btn btn-info">Login</button>
            </form>
            </div>
            <div class="col-md-4">
            <form id="editform" action="add_project.php" method="post">
            <input type="hidden" name="p_id" id="curr_id"/>
            <input type="hidden" name="name" id="curr_name"/>
            <input type="hidden" name="url" id="curr_url"/>
            <input type="hidden" name="cms_type" id="curr_cms_type"/>
            <input type="hidden" name="cms_login" id="curr_cms_login"/>
            <input type="hidden" name="cms_password" id="curr_cms_password"/>
            <input type="hidden" name="ftp_server" id="curr_ftp_server"/>
            <input type="hidden" name="ftp_login" id="curr_ftp_login"/>
            <input type="hidden" name="ftp_password" id="curr_ftp_password"/>
            <input type="hidden" name="host_server" id="curr_host_server"/>
            <input type="hidden" name="host_login" id="curr_host_login"/>
            <input type="hidden" name="host_password" id="curr_host_password"/>
            <input type="hidden" name="db" id="curr_db"/>
            <input type="hidden" name="db_login" id="curr_db_login"/>
            <input type="hidden" name="db_password" id="curr_db_password"/>
            <input type="hidden" name="desc" id="curr_desc"/>
            <button type="button" id="edit" class="btn btn-success">Edit</button>
            </div>
            </form>
            <div class="col-md-4"><button type="button" id="delete" class="btn btn-danger">Delete</button></div>
          </div>
          <div id="results"></div>
        </div>
			</div>
		</div>
	</div>	
</main>
<!--scripts-->
<script src="js/jquery-3.1.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/pss.js"></script>
<script>
  $(document).ready(function(){
     build_project_list();
     $.cookie('goback', 'goin', { expires: 1 });
    (function(){
    new Clipboard('.copy');
})();
  });
</script>

</body>
</html>
<?endif;?>