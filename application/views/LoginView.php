<?php
if (isset($this->session->userdata['logged_in'])) 
{
  redirect("UserAuthentication/user_login_process");
}
?>
<!DOCTYPE html>
<html lang="en">  
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
<style type="text/css">
#main{
align-items: center;
width:1260px;
margin:50px auto;
font-family:raleway;
}

span{
color:red;
}

h2{
background-color: #FEFFED;
text-align:center;
border-radius: 10px 10px 0 0;
margin: -10px -40px;
padding: 30px;
}

#login{

width:300px;
float: left;
border-radius: 10px;
font-family:raleway;
border: 2px solid #ccc;
padding: 10px 40px 25px;
margin-left: 420px;
}

input[type=text],input[type=password], input[type=email]{
width:99.5%;
padding: 10px;
margin-top: 8px;
border: 1px solid #ccc;
padding-left: 5px;
font-size: 16px;
font-family:raleway;
}

input[type=submit]{
width: 100%;
background-color:#FFBC00;
color: white;
border: 2px solid #FFCB00;
padding: 10px;
font-size:20px;
cursor:pointer;
border-radius: 5px;
margin-bottom: 15px;
}

#profile{
padding:50px;
border:1px dashed grey;
font-size:20px;
background-color:#DCE6F7;
}

#logout{
float:right;
padding:5px;
border:dashed 1px gray;
margin-top: -168px;
}

a{
text-decoration:none;
color: cornflowerblue;
}

i{
color: cornflowerblue;
}

.error_msg{
color:red;
font-size: 16px;
}

.message{
position: absolute;
font-weight: bold;
font-size: 28px;
color: #6495ED;
left: 30px;
top: 0px;
width: 500px;
margin-left: 50px;
}
.jumbotron {
color: white;
position:fixed;
overflow:hidden;
  width: 100%;
  height: 100%;}
.help-block{
 	color: red;
  }
</style>  
</head>
<body>
<div class="jumbotron">
    <div class="col-md-4"></div>
    <div class="col-md-4">
    <div class="" style="text-align: center;">
        <label style="color:black;">
    </div>
<div class="container">
    <div class="login-panel panel panel-success">
   <div class="panel-heading">
        <h3 style="text-align: center;"><b> Admin Login </b></h3>
    </div>
    <div class="panel-body">
		<?php
		if (isset($message_display)) {
		echo "<div class='alert alert-success'>";
		//echo $message_display;
		echo "<h3><b> $message_display </b></h3>";
		echo "</div>";
		}
		?>
        <?php echo form_open('UserAuthentication/user_login_process'); ?> 
    <?php
    if(!empty($logout_message)){?>
        <div class="alert alert-success">
    <?php
        echo '<p class="statusMsg" >'.$logout_message.'</p>';?>
    </div>
        <?php
    }
  	elseif(!empty($error_message)) {?>
    <div class="alert alert-danger">
    <?php
        echo '<p class="statusMsg">'.$error_message.'</p>';?>
    </div>
        <?php
        echo 'validation_errors()';
    }
    ?>
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="email" id="email" placeholder="Username" value="" />
            <?php echo form_error('email','<span class="help-block"><b>','</b></span>'); ?>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
          <?php echo form_error('password','<span class="help-block"><b>','</b></span>'); ?>
        </div>
        <div class="form-group" align="center">
            <input type="submit" name="loginSubmit" class="btn-primary" value="Go"/>
        </div>
    </form>  
    <?php echo form_close(); ?>
      <div class="form-group"></div> 
</div>
</div>
</div>
</div>
</div>
</body>
</html>