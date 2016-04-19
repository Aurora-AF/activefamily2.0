<?php

	require_once("session.php");
	
	require_once("class.user.php");
	$auth_user = new USER();
	
	
	$user_id = $_SESSION['user_session'];

	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>welcome - <?php print($userRow['user_email']); ?></title>

    <script type="text/javascript" src="js/webfxlayout.js"></script>

    <link type="text/css" rel="stylesheet" href="css/tab.webfx.css" />
    <style>
        input {
            line-height: 2.5em;
        }
     </style>


    <script type="text/javascript" src="js/tabpane.js"></script>
</head>

<body>


<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <h1 class="logo">
                <a href="index.html"><span class="text">Active Family</span></a>
            </h1>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['user_email']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<div class="clearfix"></div>
	
    <div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
    
    	<label class="h5">welcome : <?php print($userRow['user_name']); ?></label>
        <hr />
        
        <h1>
        <a href="home.php"><span class="glyphicon glyphicon-home"></span> home</a> &nbsp; 
        <a href="profile.php"><span class="glyphicon glyphicon-user"></span> profile</a></h1>
        <hr />
        <p>&nbsp;</p>

        <div class="tab-pane" id="tabPane1">

            <script type="text/javascript">
                tp1 = new WebFXTabPane( document.getElementById( "tabPane1" ) );
                //tp1.setClassNameTag( "dynamic-tab-pane-control-luna" );
                //alert( 0 )
            </script>

            <div class="tab-page" id="tabPage1">
                <h2 class="tab">Update Details</h2>

                <script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage1" ) );</script>
                <form name="form" action="" method="post">
                    <table>
                        <th>Update User Details</th>
                        <tr>
                            <td>First Name</td>
                            <td>Last Name</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="firstname" /></td>
                            <td><input type="text" name="lastname" /></td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td>Phone</td>
                        </tr>
                        <tr>
                            <td><input type="date" name="DOB" /></td>
                            <td><input type="text" name="phone" /></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="email" /></td>
                        </tr>
                        <tr>
                            <td>Post Code</td>
                            <td>State</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="postcode" /></td>
                            <td><input type="text" name="state" /></td>
                        </tr>
                        <tr>
                            <td>Street</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="street" /></td>
                        </tr>
                        <tr>
                            <td>Family Size</td>
                            <td>Interest</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="family_size" /></td>
                            <td><input type="text" name="interest" /></td>
                        </tr>
                    </table>
                    <input type="submit" name="update" value="Update"/>
                </form>

            </div>

            <div class="tab-page" id="tabPage2">
                <h2 class="tab">Details</h2>

                <script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage2" ) );</script>
                <?php
                    $query = $auth_user->runQuery("SELECT * FROM user_profile WHERE user_id=:user_id");
                    $query->execute(array(":user_id"=>$user_id));
                    $profileRow = $query->fetch(PDO::FETCH_ASSOC);
                ?>
                <table>
                    <th>User Details</th>
                    <tr>
                        <td>First Name</td>
                        <td>Last Name</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="firstname" value="<?php echo (empty($profileRow['user_fname'])) ? " " : $profileRow['user_fname'];?>"/></td>
                        <td><input type="text" name="lastname" value="<?php echo (empty($profileRow['user_lname'])) ? " " : $profileRow['user_lname'];?>"/></td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td>Phone</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="DOB" value="<?php echo (empty($profileRow['dob'])) ? " " : $profileRow['dob'];?>"/></td>
                        <td><input type="text" name="phone" value="<?php echo (empty($profileRow['phone'])) ? " " : $profileRow['phone'];?>"/></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="email" value="<?php echo (empty($profileRow['email'])) ? " " : $profileRow['email'];?>"/></td>
                    </tr>
                    <tr>
                        <td>Post Code</td>
                        <td>State</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="postcode" value="<?php echo (empty($profileRow['postcode'])) ? " " : $profileRow['postcode'];?>"/></td>
                        <td><input type="text" name="state" value="<?php echo (empty($profileRow['state'])) ? " " : $profileRow['state'];?>"/></td>
                    </tr>
                    <tr>
                        <td>Street</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="street" value="<?php echo (empty($profileRow['street'])) ? " " : $profileRow['street'];?>"/></td>
                    </tr>
                    <tr>
                        <td>Family Size</td>
                        <td>Interest</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="family size" value="<?php echo (empty($profileRow['family_size'])) ? " " : $profileRow['family_size'];?>"/></td>
                        <td><input type="text" name="interest" value="<?php echo (empty($profileRow['interest'])) ? " " : $profileRow['interest'];?>"/></td>
                    </tr>
                </table>

            </div>

        </div>
        <script type="text/javascript">
            //<![CDATA[

            setupAllTabs();

            //]]>
        </script>
    </div>

</div>
<?php

if(isset($_POST['update'])) {
    $fname = (isset($_POST['firstname']) ? $_POST['firstname'] : null);
    $lname = (isset($_POST['lastname']) ? $_POST['lastname'] : null);
    $dob = (isset($_POST['DOB']) ? $_POST['DOB'] : null);
    $phone = (isset($_POST['phone']) ? $_POST['phone'] : null);
    $email = (isset($_POST['email']) ? $_POST['email'] : null);
    $postcode = (isset($_POST['postcode']) ? $_POST['postcode'] : null);
    $state = (isset($_POST['state']) ? $_POST['state'] : null);
    $street = (isset($_POST['street']) ? $_POST['street'] : null);
    $familySize = (isset($_POST['family_size']) ? $_POST['family_size'] : 0);
    $interest = (isset($_POST['interest']) ? $_POST['interest'] : null);

    if(!empty($fname)) {
        $query = $auth_user->runQuery("UPDATE user_profile
                                       SET user_fname = '$fname'
                                       WHERE user_id = $user_id");
        $query->execute(array(":user_id"=>$user_id));
    }

    if(!empty($lname)) {
        $query = $auth_user->runQuery("UPDATE user_profile
                                       SET user_lname = '$lname'
                                       WHERE user_id = $user_id");
        $query->execute(array(":user_id"=>$user_id));
    }

    if(!empty($dob)) {
        $query = $auth_user->runQuery("UPDATE user_profile
                                       SET dob = '$dob'
                                       WHERE user_id = $user_id");
        $query->execute(array(":user_id"=>$user_id));
    }

    if(!empty($phone)) {
        $query = $auth_user->runQuery("UPDATE user_profile
                                       SET phone = '$phone'
                                       WHERE user_id = $user_id");
        $query->execute(array(":user_id"=>$user_id));
    }

    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query = $auth_user->runQuery("UPDATE user_profile
                                       SET email = '$email'
                                       WHERE user_id = '$user_id'");
        $query->execute(array(":user_id"=>$user_id));
    }

    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script language="javascript">';
        echo 'alert("Email Address is not valid!")';
        echo '</script>';
    }

    if(!empty($postcode)) {
        $query = $auth_user->runQuery("UPDATE user_profile
                                       SET postcode = '$postcode'
                                       WHERE user_id = $user_id");
        $query->execute(array(":user_id"=>$user_id));
    }

    if(!empty($state)) {
        $query = $auth_user->runQuery("UPDATE user_profile
                                       SET state = '$state'
                                       WHERE user_id = $user_id");
        $query->execute(array(":user_id"=>$user_id));
    }

    if(!empty($street)) {
        $query = $auth_user->runQuery("UPDATE user_profile
                                       SET street = '$street'
                                       WHERE user_id = $user_id");
        $query->execute(array(":user_id"=>$user_id));
    }

    if((!empty($familySize) && (filter_var($familySize, FILTER_VALIDATE_INT)))) {
        $query = $auth_user->runQuery("UPDATE user_profile
                                       SET family_size = '$familySize'
                                       WHERE user_id = $user_id");
        $query->execute(array(":user_id"=>$user_id));
    }

    if(!empty($familySize) && (!filter_var($familySize, FILTER_VALIDATE_INT))) {
        echo '<script language="javascript">';
        echo 'alert("Family Size should be number")';
        echo '</script>';
    }

    if(!empty($interest)) {
        $query = $auth_user->runQuery("UPDATE user_profile
                                       SET interest = '$interest'
                                       WHERE user_id = $user_id");
        $query->execute(array(":user_id"=>$user_id));
    }
}
?>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>

























