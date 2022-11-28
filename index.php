<?php
/* @author Jessica Ejelöv - jeej2100@student.miun.se */
$page_title = "Login - admin";
include('includes/header-login.php');
// check for login, if any send to admin page
if (isset($_SESSION['admin'])) {
    header("Location: admin.php");
}
// print error message if user tried to access register as not Admin
if (isset($_GET['message'])) {
    $errormsg = "<p class='error'>" . $_GET['message'] . "</p>";
}
// check if form is posted
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
// check if empty
    if (empty($username) || empty($password)) {
        $errormsg = "<p class='error center'>Du måste ange användarnamn och lösernord!</p>";
    } else {
        // if there is username and password, check agianst webservice with curl if login is correct

        $url = 'https://studenter.miun.se/~jeej2100/writeable/johansAPI/login.php';

        // curl with POST
        $curl = curl_init();
        $user = array("username" => $username, "password" => $password);
        //convert to JSON
        $json_string = json_encode($user);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_string);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //result
        $data = json_decode(curl_exec($curl), true);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        // if ok set session and login in to admin
        if ($httpcode === 200) {
            $_SESSION['admin'] = $username;

            header("Location: admin.php");
        } else {
            $errormsg = "<p class='error center'>Fel andänarnamn eller lösenord!</p>";
        }
    }
}
?>
<div class="container">
    <!-- form for login -->
    <form method="POST" action="index.php">
        <div class="forms-login">
            <label for="username">Användarnamn:</label>
            <input type="text" name="username" id="username">
            <label for="password">Lösenord:</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Login">
        </div>
        <?= $errormsg ?>
    </form>
</div>
<?php
include('includes/footer.php');
?>