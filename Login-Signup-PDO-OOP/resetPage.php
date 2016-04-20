<?php
session_start();
require_once('class.user.php');
$user = new User();

if(isset($_POST['btn-reset']))
{
    $umail = strip_tags($_POST['txt_umail']);

    if($umail=="")	{
        $error[] = "provide email id !";
    }
    else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
        $error[] = 'Please enter a valid email address !';
    }
    else
    {
        try
        {
            $stmt = $user->runQuery("SELECT user_email FROM users WHERE user_email=:umail");
            $stmt->execute(array(':umail'=>$umail));
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            if($row['user_email']==$umail) {
                $token=getRandomString(10);
                $q="insert into tokens (token,email) values ('$token','$umail')";
                $stmt = $user->runQuery($q);
                $stmt->execute(array(':token'=>$token));
                mailresetlink($umail, $token);
            }
            else
            {
                $error[] = 'Invalid Email Address!';
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}

function getRandomString($length)
{
    $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
    $validCharNumber = strlen($validCharacters);
    $result = "";

    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
    return $result;
}

function mailresetlink($to,$token){
    $subject = "Forgot Password on active-family.net";
    $uri = 'http://'. $_SERVER['HTTP_HOST'] ;
    $message = '
<html>
<head>
<title>Forgot Password For active-family.net</title>
</head>
<body>
<p>Click on the given link to reset your password <a href="'.$uri.'/resetPassword.php?token='.$token.'">Reset Password</a></p>

</body>
</html>
';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .= 'From: Admin<kricjma83@gmail.com>' . "\r\n";
    $headers .= 'Cc: Admin@example.com' . "\r\n";

    if(mail($to,$subject,$message,$headers)){
        echo "We have sent the password reset link to your  email id <b>".$to."</b>";
    }
}

//if(isset($_GET['email']))mailresetlink($email,$token);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Active Family: Reset Your Password</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<form action="" method="post">
    <h2 class="form-signin-heading">Reset Your Password.</h2><hr />
    <?php
    if(isset($error))
    {
        foreach($error as $error)
        {
            ?>
            <div class="alert alert-danger">
                <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
            </div>
            <?php
        }
    }
    else if(isset($_GET['joined']))
    {
        ?>
        <div class="alert alert-info">
            <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully Reset Your Password <a href='index.php'>login</a> here
        </div>
        <?php
    }
    ?>
    <div class="form-group">
        <input type="text" class="form-control" name="txt_umail" placeholder="Enter E-Mail ID" value="" />
    </div>
    <div class="clearfix"></div><hr />
    <div class="form-group">
        <button id="submitBtn" type="submit" class="btn btn-primary" name="btn-reset" >
            <i class="glyphicon glyphicon-open-file"></i>&nbsp;Reset
        </button>
    </div>
</form>