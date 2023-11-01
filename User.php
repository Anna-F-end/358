<?php 
class User {
    private $name;
    private $lastname;
    private $email;
    private $id;

    function __construct($id, $name, $lastname, $email) 
    {
        $this->id=$id;
        $this->name=$name;
        $this->lastname=$lastname;
        $this->email=$email;
    }


    function getId() {return $this->id;}
    function getName() {return $this->name;}
    function getLastname() {return $this->lastname;}
    function getEmail() {return $this->email;}


    static function addUser($name, $lastname, $email, $pass) {
        // echo "User is added";
        global $mysqli;
        // var_dump($mysqli);
        $email = mb_strtolower(trim($email));
        $pass=trim($pass);
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
        if ($result->num_rows!=0) { //такой уже есть
            //Фронту отдаём, зашифровав в формате ключ-значение
            return json_encode(["result"=>"exist"]); //не регистрируем, пользователь уже есть
        } else {
            $mysqli->query("INSERT INTO `users`(`name`, `lastname`, `email`, `pass`) 
            VALUES ('$name','$lastname','$email', '$pass')");
            return json_encode(["result"=>"success"]); //регистрируем нового
        }
    }

    //Статический метод авторизации пользователя
    static function authUser($email, $pass){
        global $mysqli;
        // var_dump($mysqli);
        // echo "Сработал authUser в User.php";
        $email = mb_strtolower(trim($email));
        $pass=trim($pass);

        //Запрос в БД
        $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
        $result = $result->fetch_assoc(); // Преобразование результата к более удобному виду. Ассоциативный массив.
        // var_dump($result["pass"]); //достаём хэш из базы данных
        $passwordHash = $result["pass"];
        if (password_verify($pass, $passwordHash)) {
            $_SESSION["id"] = $result["id"]; //достаём данные из result

            return json_encode(["result"=>"ok"]);
        } else {
            return json_encode(["result"=>"error"]);
        }

    }
}

?>