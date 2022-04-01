<?php include_once '../_base_classes.php'; ?>
<?php include_once '../roles/_roles_classes.php'; ?>
<?php
class UserManager extends EntityManager
{
    public function getAll($conn)
    {
        $query = "
        SELECT 
            user.id as user_id,
            user.login as user_login,
            user.password as user_password,
            role.id as role_id,
            role.name as role_name,
            role.description as role_description
        FROM 
            user
        LEFT JOIN
            role ON role.id = user.role_id
        ORDER BY
            user.id";

        $array = [];
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $item = new User();
            $item->load($row);
            array_push($array, $item);
        }

        return $array;
    }
}

class User extends Entity
{
    public $login;
    public $password;

    public $role;

    public function load($row)
    {
        $this->id = $row["user_id"];
        $this->login = $row["user_login"];
        $this->password = $row["user_password"];

        $this->role = new Role();
        $this->role->load($row);
    }

    public function refresh($conn)
    {
        $query = "
        SELECT 
            user.id as user_id,
            user.login as user_login,
            user.password as user_password,
            role.id as role_id,
            role.name as role_name,
            role.description as role_description
        FROM 
            user
        LEFT JOIN
            role ON role.id = user.role_id
        WHERE
            user.id = {$this->id}";

        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        $this->load($row);
    }
    public function create($conn)
    {
        $query = "
        INSERT INTO `user` (`id`, `login`, `password`, `role_id`)
        VALUES (NULL, '{$this->login}', '{$this->password}', '{$this->role->id}')";

        $conn->query($query);
    }
    public function save($conn)
    {
        $query = "
        UPDATE 
            user 
        SET 
            user.login = '{$this->login}', 
            user.password = '{$this->password}',
            user.role_id = {$this->role->id}
        WHERE 
            user.id = {$this->id}";

        $conn->query($query);
    }
    public function delete($conn)
    {
        $query = "DELETE FROM user WHERE user.id={$this->id}";
        $conn->query($query);
    }
}
