<?php   

    session_start();
    require_once dirname(__DIR__) . "/database/connection.php";
    require_once dirname(__DIR__) . "/cryptage/cryptage.php";

    $db = new Database();

    if (!isset($_SESSION['userInfo'])) {

        header('Location: /');
        exit();
    } else {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $updates = [];
            $UserID = $_SESSION['userInfo'] -> UserID;

            
            if (!empty($_POST['firstName'])) {
                $firstName = $_POST['firstName'];
                array_push($updates,"FirstName = '$firstName'");
            }

            if (!empty($_POST['lastName'])) {
                $lastName = $_POST['lastName'];
                array_push($updates,"LastName = '$lastName'");
            }

            if (!empty($_POST['email'])) {
                $email = $_POST['email'];
                array_push($updates,"Email = '$email'");
            }

            if (!empty($_POST['password'])) {
                $pwd = $_POST['password'];
                $pwd = crypt_password($pwd);
                array_push($updates,"Password = '$pwd'");
            }

            if (!empty($_FILES['picture'])) {
                $target_dir = "/images/profiles/";
                $target_file = dirname(__DIR__) . $target_dir . basename($_FILES["picture"]["name"]);
                if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                    $picture = $target_dir . basename($_FILES["picture"]["name"]);
                    array_push( $updates,"Profile = '$picture'");
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    die();
                }
            }


            if (!empty($updates)) {
                $query = "UPDATE Users SET " . implode(", ", $updates) . " WHERE UserID = :UserID";
                $db -> query( $query );
                $db -> bind(":UserID",$UserID);

                if ($db -> execute()) {
                    header("Location: /profile");
                    exit();
                } else {
                    echo "Error updating record: ";
                    die();
                }
            }
        }

        require_once dirname(__DIR__) . "/views/editProfile.view.php";
    }