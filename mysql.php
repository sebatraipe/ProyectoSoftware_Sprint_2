<?php 

    class mysql
    {
        private $host = "localhost";
        private $user = 'root';
        private $password = '1234';
        private $data_base = 'db_traipe';
        private $usuarios = array();
        private $roles = array();

        public function __construct()
        {
        }

        private function connection()
        {
            try {
                return $connection = mysqli_connect($this->host, $this->user, $this->password, $this->data_base);
            } catch (Exception $e) {
                print_r($e->getMessage());
            }
        }

        /* Retorna un array de usuarios... */
        public function findAllUser()
        {
            /* JOIN: select id, nombre, apellido, username, password, email,  */
            $dbConn = $this->connection();
            $query = "SELECT u.id, u.nombre, apellido, username, password, email, r.nombre as nombre_rol, descripcion from usuario u join rol r on (u.rol=r.id)";
            $resultado = mysqli_query($dbConn, $query);
            while ($fila = mysqli_fetch_array($resultado)) {
                $rol = new rol($fila['nombre_rol'], $fila['descripcion']);
                $user = new user($fila['id'], $fila['nombre'], $fila['apellido'], $fila['username'], $fila['password'], $fila['email'], $rol);
                array_push($this->usuarios, $user);
            }
            return $this->usuarios;
        }

        /* Retorna un array de roles */
        public function findAllRol()
        {
            $dbConn = $this->connection();
            $query = "SELECT * FROM rol";
            $resultado = mysqli_query($dbConn, $query);
            while($fila = mysqli_fetch_array($resultado)){
                $rol = new rol($fila['nombre'], $fila['descripcion']);
                array_push($this->roles, $rol);
                print_r($this->roles);
            }
            return $this->roles;
        }

        public function createUser(user $user)
        {
            $db_conn = $this->connection();
            $nombre = $user->getNombre();
            $apellido = $user->getApellido();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $email = $user->getEmail();
            $id_rol = $this->obtenerIdRol($user->getRol());
            $query = "INSERT INTO usuario (nombre, apellido, username, password, email, rol) VALUES ('$nombre', '$apellido', '$username', '$password', '$email', '$id_rol')";
            mysqli_query($db_conn, $query);
        }

        public function obtenerIdRol($nombre_rol){
            $db_conn = $this->connection();
            $query = "SELECT id FROM rol WHERE nombre = ('$nombre_rol')";
            $fila = mysqli_fetch_array(mysqli_query($db_conn, $query));
            return $fila['id'];
        }

        public function obtenerRol($nombre_rol){
            $db_conn = $this->connection();
            $query = "SELECT nombre, descripcion FROM rol WHERE nombre = ('$nombre_rol')";
            $resultado = mysqli_query($db_conn, $query);
            $fila = mysqli_fetch_array($resultado);
            $role = new rol($fila['nombre'], $fila['descripcion']);
            return $role;
        }

        public function deleteUser($id){
            $db_conn = $this->connection();
            $query = "DELETE FROM usuario where id = '$id'";
            mysqli_query($db_conn, $query);
        }


        /*Retorna los datos de un unico usuario*/
         public function findUser($idUser)
        {
            $dbConn = $this->connection();
            $query = "SELECT u.id, u.nombre, apellido, username, password, email, r.nombre as nombre_rol, descripcion from usuario u join rol r on (u.rol=r.id) were u.id = '$idUser'";
            $resultado = mysqli_query($dbConn, $query);
            $fila = mysqli_fetch_array($resultado);
            $rol = new rol($fila['nombre_rol'], $fila['descripcion']);
            $user = new user($fila['id'], $fila['nombre'], $fila['apellido'], $fila['username'], $fila['password'], $fila['email'], $rol);
            
            return $user;
        }

        public function updateUser(user $user){
            $db_conn = $this->connection();
            $id_user = $user->getId();
            $nombre = $user->getNombre();
            $apellido = $user->getApellido();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $email = $user->getEmail();
            $id_rol = $this->obtenerIdRol($user->getRol());

            $query = "UPDATE usuario set nombre='$nombre', apellido='$apellido', username='$username', password='$password', email='$email', rol='$id_rol' where id = '$id_user'";
            mysqli_query($db_conn, $query);
        }
    }
?>
