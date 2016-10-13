<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Passwords</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Project-manager</a>
       <ul class="nav navbar-nav">
        <li><a href="index.php">Projects</a></li>
        <li class="active"><a href="add_project.php">Add project <span class="sr-only">(current)</span></a></li>
      </ul>
    </div>
  </div>
</nav>

<main>	
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">New Project</h3>
          </div>
          <form method="POST" id="project">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <div class="input-group input-group-lg">
                  <span class="input-group-addon" id="project_name_desc">Project:</span>
                  <input type="text" class="form-control" placeholder="Name" aria-describedby="project_name_desc" id="project_name" name="project_name">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group form-group-lg">
                  <label for="project_url">URL:</label>
                  <input type="text" class="form-control" placeholder="http://site_url.com" id="project_url" name="project_url">
                </div>
              </div>
            </div>
              <div class="row">
                <div class="col-md-6">
                <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">CMS</h3>
                  </div>
                  <div class="panel-body">
                  <div class="form-group">
                    <label for="cms_type">CMS type:</label>
                    <select class="form-control" id="cms_type" name="cms_type">
                    <option>Bitrix</option>
                    <option>Webmanager</option>
                    </select>
                    <label for="cms_login">Login:</label>
                    <input type="text" class="form-control" id="cms_login" name="cms_login">
                    <label for="cms_password">Password:</label>
                    <input type="text" class="form-control" id="cms_password" name="cms_password">
                    </div>
                  </div>
                  </div>
                </div>
                <div class="col-md-6">
                <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">FTP</h3>
                  </div>
                  <div class="panel-body">
                  <div class="form-group">
                  <label for="ftp_server">Server:</label>
                  <input type="text" class="form-control" id="ftp_server" name="ftp_server">
                  <label for="ftp_login">Login:</label>
                  <input type="text" class="form-control" id="ftp_login" name="ftp_login">
                  <label for="ftp_password">Password:</label>
                  <input type="text" class="form-control" id="ftp_password" name="ftp_password">
                  </div>
                </div>
                </div>
                </div>
              </div>
              <label for="desc">Description:</label>
              <textarea class="form-control" id="desc" name="project_descr" rows="3"></textarea>
              </form>
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                   <button id="add_project" type="button" class="btn btn-success btn-lg">Add Project</button>
                </div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-danger btn-lg">Exit</button>
                </div>
                <div class="col-md-2"></div>
              </div>
              <div id="results"></div>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
		</div>
	</div>	
</main>

<!--scripts-->
<script src="js/jquery-3.1.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/npm.js"></script>-->
<script src="js/pss.js"></script>

<script>
$(document).ready(function(){
  getdatabyid(<?php echo $_POST["p_id"];?>);
});
</script>

</body>
</html>