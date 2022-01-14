<?php
    function logOut() {
        $params = [
            'logout' => date('Y-m-d H:i:s'),
            'user_id' => $_SESSION["userID"]
        ];

        $update_sql = "UPDATE loginout SET 
            logout=:logout
        WHERE 
            user_id=:user_id";

        $stmt = $GLOBALS['pdo']->prepare($update_sql);
        $stmt->execute($params);

        session_unset();
    }
?>