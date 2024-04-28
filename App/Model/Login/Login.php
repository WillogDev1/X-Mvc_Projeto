<?php

namespace App\Model\Login;

use App\Model\Database\Database;

class Login
{
    public static function get()
    {
        $DATA = "Login - Works!";

        return $DATA;
    }

    public static function loggin($username, $password)
    {
        $conn = Database::conectaDB();

        $sql = "SELECT COL_USERS_ID, COL_USERS_EMAIL, COL_USERS_PASSWORD, COL_USERS_IS_ACTIVE, COL_USERS_IS_CHANGING_PASSWORD, COL_USERS_IS_FIRST_LOGGIN, COL_USERS_FK_PEOPLE_ID 
                FROM TBL_USERS 
                WHERE COL_USERS_EMAIL = :username LIMIT 1";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($result && password_verify($password, $result['COL_USERS_PASSWORD'])) {
                $user_id =              $result['COL_USERS_ID'];
                $user_Name_From_DB =    $result['COL_USERS_EMAIL'];
                $people_id =            $result['COL_USERS_FK_PEOPLE_ID'];
                $is_Active =            $result['COL_USERS_IS_ACTIVE'];
                $is_Chaging_Password =  $result['COL_USERS_IS_CHANGING_PASSWORD'];
                $is_First_Login =       $result['COL_USERS_IS_FIRST_LOGGIN'];
                Aux_Login::initialize_Session($user_id, $user_Name_From_DB, $people_id, $is_Active, $is_Chaging_Password, $is_First_Login);
            } else {
                echo json_encode(["message" => "Credenciais Invalidas"]);
            }
        } catch (\PDOException $e) {
            die("Erro na consulta: " . $e->getMessage());
        }
    }

    public static function primeiroAcesso()
    {
        
    }

}
