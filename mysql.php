<?php 

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT | !MYSQLI_REPORT_INDEX);

    class mysql
    {
        private $host = "localhost";
        private $user = 'root';
        private $password = '1234';
        private $data_base = 'db_traipe';
        private $usuarios = array();
        private $roles = array();

    
        private function connection(){
            try{
            $connection = mysqli_connect($this->host, $this->user, $this->password, $this->data_base);
            }catch(Exception $e){
                throw new MyException("Error de conexion", MyException::$ERROR_FATAL);    
            }
            return $connection;
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

        public function createUser(user $user){

            $db_conn = $this->connection();
            try{
            if(!$this->usuarioExiste($user->getUsername())){
                $nombre = $user->getNombre();
                $apellido = $user->getApellido();
                $username = $user->getUsername();
                $password = $user->getPassword();
                $email = $user->getEmail();
                $id_rol = $this->obtenerIdRol($user->getRol());
                $query = "INSERT INTO usuario (nombre, apellido, username, password, email, rol) VALUES ('$nombre', '$apellido', '$username', '$password', '$email', '$id_rol')";
                mysqli_query($db_conn, $query);
                echo "exito";
                throw new MyException("Registrado correctamente", MyException::$OPERACION_EXITOSA);
            }
            }catch(mysqli_sql_exception $e){
                throw new MyException("El nombre de usuario ya existe", MyException::$USUARIO_DUPLICADO);
            }

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
            throw new MyException("Usuario eliminado", MyException::$OPERACION_EXITOSA);
        }


        /*Retorna true si el usuario existe y false en caso contrario*/
         public function usuarioExiste($username)
        {
            $dbConn = $this->connection();
            $query = "SELECT u.id from usuario u where u.username = '$username'";
            $resultado = mysqli_query($dbConn, $query);
            if(mysqli_num_rows($resultado) > 0){
                return true;
            }
            else
                return false;    
        }

         public function updateUser(user $user){
            
            $id_user = $user->getId();
            $username = $user->getUsername();

            if($this->sePuedeActualizar($username, $id_user)){
                $db_conn = $this->connection();
                $nombre = $user->getNombre();
                $apellido = $user->getApellido();
                $password = $user->getPassword();
                $email = $user->getEmail();
                $id_rol = $this->obtenerIdRol($user->getRol());

                $query = "UPDATE usuario set nombre='$nombre', apellido='$apellido', username='$username', password='$password', email='$email', rol='$id_rol' where id = '$id_user'";
                mysqli_query($db_conn, $query);
                throw new MyException("Datos actualizados correctamente", MyException::$OPERACION_EXITOSA);
            }
            else
                throw new MyException("El nombre de usuario ya existe", MyException::$USUARIO_DUPLICADO);
        }

        public function sePuedeActualizar($newUsername, $id){
            $dbConn = $this->connection();
            $query = "SELECT u.username from usuario u where u.id = '$id'";
            $resultado = mysqli_query($dbConn, $query);
            $fila = mysqli_fetch_array($resultado);
            if($newUsername != $fila['username']){
                if(!$this->usuarioExiste($newUsername))
                    return true;
                else
                    return false;
            }
            return true;
        }
    }
?>
