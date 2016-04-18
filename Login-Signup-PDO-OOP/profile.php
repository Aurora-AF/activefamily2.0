<?php

	require_once("session.php");
	
	require_once("class.user.php");
	$auth_user = new USER();
	
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	
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

    <!-- this link element includes the css definitions that describes the tab pane -->
    <!--
    <link type="text/css" rel="stylesheet" href="tab.winclassic.css" />
    -->
    <link type="text/css" rel="stylesheet" href="css/tab.webfx.css" />
    <!-- the id is not needed. It is used here to be able to change css file at runtime -->
<!--    <style type="text/css">-->
<!---->
<!--        .dynamic-tab-pane-control .tab-page {-->
<!--            height:		300px;-->
<!--        }-->
<!---->
<!--        .dynamic-tab-pane-control .tab-page .dynamic-tab-pane-control .tab-page {-->
<!--            height:		100px;-->
<!--        }-->
<!---->
<!--        html, body {-->
<!--            background:	ThreeDFace;-->
<!--        }-->
<!---->
<!--        form {-->
<!--            margin:		0;-->
<!--            padding:	0;-->
<!--        }-->
<!---->
<!--        /* over ride styles from webfxlayout */-->
<!---->
<!--        body {-->
<!--            margin:		10px;-->
<!--            width:		auto;-->
<!--            height:		auto;-->
<!--        }-->
<!---->
<!--        .dynamic-tab-pane-control h2 {-->
<!--            text-align:	center;-->
<!--            width:		auto;-->
<!--        }-->
<!---->
<!--        .dynamic-tab-pane-control h2 a {-->
<!--            display:	inline;-->
<!--            width:		auto;-->
<!--        }-->
<!---->
<!--        .dynamic-tab-pane-control a:hover {-->
<!--            background: transparent;-->
<!--        }-->
<!--    </style>-->


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
          <a class="navbar-brand" href="http://www.codingcage.com">Coding Cage</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://www.codingcage.com/2015/11/ajax-login-script-with-jquery-php-mysql.html">Back to Article</a></li>
            <li><a href="http://www.codingcage.com/search/label/jQuery">jQuery</a></li>
            <li><a href="http://www.codingcage.com/search/label/PHP">PHP</a></li>
          </ul>
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
        
        <p class="h4">Another Secure Profile Page</p>
        <p>&nbsp;</p>

        <div class="tab-pane" id="tabPane1">

            <script type="text/javascript">
                tp1 = new WebFXTabPane( document.getElementById( "tabPane1" ) );
                //tp1.setClassNameTag( "dynamic-tab-pane-control-luna" );
                //alert( 0 )
            </script>

            <div class="tab-page" id="tabPage1">
                <h2 class="tab">Details</h2>

                <script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage1" ) );</script>
                <table>
                    <th>User Details</th>
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
                        <td><input type="text" name="DOB" /></td>
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
                        <td><input type="text" name="firstname" /></td>
                        <td><input type="text" name="lastname" /></td>
                    </tr>


                </table>

            </div>

            <div class="tab-page" id="tabPage2">
                <h2 class="tab">Security</h2>

                <script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage2" ) );</script>

                This is text of tab 2. This is text of tab 2. This is text of tab 2.
                This is text of tab 2. This is text of tab 2. This is text of tab 2.
                This is text of tab 2. This is text of tab 2. This is text of tab 2.
                <br />
                <br />
                This is text of tab 2. This is text of tab 2. This is text of tab 2.
                This is text of tab 2. This is text of tab 2. This is text of tab 2.
                This is text of tab 2. This is text of tab 2. This is text of tab 2.

            </div>

            <div class="tab-page" id="tabPage3">
                <h2 class="tab">Privacy</h2>

                <script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage3" ) );</script>

                This is text of tab 3. This is text of tab 3. This is text of tab 3.
                This is text of tab 3. This is text of tab 3. This is text of tab 3.
                This is text of tab 3. This is text of tab 3. This is text of tab 3.

            </div>

            <div class="tab-page" id="tabPage4">
                <h2 class="tab">Content</h2>

                <script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage4" ) );</script>

                <fieldset>
                    <legend>Content</legend>
                    This is text of tab 4. This is text of tab 4. This is text of tab 4.
                    This is text of tab 4. This is text of tab 4. This is text of tab 4.
                    This is text of tab 4. This is text of tab 4. This is text of tab 4.
                </fieldset>

            </div>

        </div>
        <script type="text/javascript">
            //<![CDATA[

            setupAllTabs();

            //]]>
        </script>

        
    <p class="blockquote-reverse" style="margin-top:200px;">
    Programming Blog Featuring Tutorials on PHP, MySQL, Ajax, jQuery, Web Design and More...<br /><br />
    <a href="http://www.codingcage.com/2015/04/php-login-and-registration-script-with.html">tutorial link</a>
    </p>
    
    </div>

</div>




<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>