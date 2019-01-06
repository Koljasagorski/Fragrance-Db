<?php
require_once('./xtra/broken_dreams.php');

    if (isset($_POST['password']) && $_POST['password'] == $decryptPass && $_POST['aduser'] == $adminUser) {
        
        setcookie("password", $encryptPass, time() + (50 * 60 * 24 * 20), "/", "", true, true);
        setcookie("aduser", $adminUser, time() + (50 * 60 * 24 * 20), "/", "", true, true);
        ?>
        <script type="text/javascript">
window.location.href = '/adminpanel';
</script>
<?php
        exit;
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Password protected</title>
</head>
<body>
    <div style="text-align:center;margin-top:50px;">
    <a href="/"><h3>-Main page-</h3></a><br />
        You must enter the password to view this content.
        <form action="rakel" method="POST">
        <input type="text" name="aduser" placeholder="User" required><br />
            <input type="password" name="password" placeholder="Password" required><br />
            <input type="submit" id="submit" value="Login" />
        </form>
    </div>
</body>
</html>