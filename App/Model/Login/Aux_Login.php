<?php

namespace App\Model\Login;

use App\Model\Database\Database;


class Aux_Login
{

    public static function initialize_Session($user_id, $username, $people_id, $is_Active, $is_Changing_Password, $is_First_Login)
    {

        if ($is_Active === 1) {
            self::start_Session();
            self::retrive_Session($user_id);
            self::retrive_Users_Data($username);
            self::retrive_People_Data($people_id);
            self::retrieveUserPermissions($people_id);
            
            if ($is_First_Login) {
                $response = ['success' => true, 'redirect' => '/home'];
                echo json_encode($response);
                exit();
            } elseif ($is_Changing_Password) {
                $response = ['success' => true, 'redirect' => '/home'];
                echo json_encode($response);
                exit();
            } else {
                $response = ['success' => true, 'redirect' => '/home'];
                echo json_encode($response);
                exit();
            }
        } else {
            $response = ['success' => false, 'message' => 'Usuário desativado'];
            echo json_encode($response);
            exit();
        }
    }

    public static function start_Session()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function retrive_Session($user_id)//TODO: Mudar para people_id
    {
        if (empty($user_id) || is_numeric($user_id) === false) {
            return false;
        }

        $_SESSION['SESSION_ID'] = $user_id;
        return true;
    }

    public static function retrive_Users_Data($username)
    {
        if (empty($username) || filter_var($username, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        }
        $_SESSION['username'] = $username;
        return true;
    }


    public static function retrive_People_Data($people_id)
    {
        // TODO: Aplicar ClenCode dividir a função
        if(empty($people_id) || is_numeric($people_id) === false)
        {
            return false;
        }

        $conn = Database::conectaDB();

        $sql = 'SELECT * FROM TBL_PEOPLE WHERE COL_PEOPLE_ID = :people_id limit 1';

        try{
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':people_id', $people_id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            $_SESSION['nome']           = $result['COL_PEOPLE_NAME'         ];
            $_SESSION['cpf']            = $result['COL_PEOPLE_CPF'          ];
            $_SESSION['celular']        = $result['COL_PEOPLE_PHONE_NUMBER' ];
            $_SESSION['pais']           = $result['COL_PEOPLE_COUNTRY'      ];
            $_SESSION['cidade']         = $result['COL_PEOPLE_CITY'         ];
            $_SESSION['rua']            = $result['COL_PEOPLE_STREET'       ];
            $_SESSION['casaNumero']     = $result['COL_PEOPLE_HOUSE_NUMBER' ];
            $_SESSION['imgPerfil']      = $result['COL_PEOPLE_IMG'          ];
        }catch (\PDOException $e){
            error_log("Erro na consulta: " . $e->getMessage());
            return false;
        }
        return true;
    }

    public static function retrieveUserPermissions($people_id)
    {
        $conn = Database::conectaDB();
    
        $permissions = array(); // Array para armazenar as permissões do usuário
    
        // Consulta para recuperar as permissões do usuário com base no ID do usuário
        $sql = 'SELECT TBL_PERMISSIONS.COL_PERMISSIONS_ACTION
                FROM TBL_PERMISSIONS
                INNER JOIN TBL_USERS_HAS_PERMISSIONS 
                ON TBL_PERMISSIONS.COL_PERMISSIONS_ID = TBL_USERS_HAS_PERMISSIONS.COL_USERS_HAS_PERMISSIONS_FK_PERMISSIONS_ID
                WHERE TBL_USERS_HAS_PERMISSIONS.COL_USERS_HAS_PERMISSIONS_FK_USERS_ID = :people_id';
    
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':people_id', $people_id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
            // Percorre o resultado e armazena as permissões no array
            foreach ($result as $row) {
                $permissions[] = $row['COL_PERMISSIONS_ACTION'];
            }
    
            // Armazena as permissões na sessão do usuário
            $_SESSION['user_permissions'] = $permissions;
    
        } catch (\PDOException $e) {
            error_log("Erro na consulta: " . $e->getMessage());
            return false;
        }
        return true;
    }
}
