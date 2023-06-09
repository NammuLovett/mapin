<?php

class Mapin

{
    private $conection;

    function __construct()
    {
        $this->getConection();
    }

    public function getConection()
    {
        $dbObj = new Db();
        $this->conection = $dbObj->conection;

        // Prueba la conexión.
        if ($this->conection->connect_error) {
            die("Connection failed: " . $this->conection->connect_error);
        }
    }

    public function getManagerById($id)
    {
        if (is_null($id)) return false;

        $sql = " SELECT * FROM `manager` WHERE `idManager` = '$id';";

        $result = $this->conection->query($sql);

        $row = $result->fetch_assoc();
        $manager =  new Manager($row['idManager'], $row['nameManager'], $row['surnameManager'], $row['emailManager'], $row['passwordManager'],  $row['showManager'], $row['idLocation']);

        return $manager;
    }

    public function getVisitorById($id)
    {
        if (is_null($id)) return false;

        $sql = " SELECT * FROM `visitor` WHERE `idVisitor` = '$id';";

        $result = $this->conection->query($sql);

        $row = $result->fetch_assoc();
        $visitor =  new Visitor($row['idVisitor'], $row['nameVisitor'], $row['surnameVisitor'], $row['emailVisitor'], $row['passwordVisitor'], $row['genderVisitor'], $row['datebirthVisitor'], $row['cityVisitor']);

        return $visitor;
    }

    public function getCategoryById($id)
    {


        if (is_null($id)) return false;

        $sql = " SELECT * FROM `category` WHERE `idCategory` = '$id';";

        $result = $this->conection->query($sql);

        $row = $result->fetch_assoc();
        $category =  new Category($row['idCategory'], $row['nameCategory'], $row['descriptionCategory']);

        return $category;
    }

    /* LOGIN */

    public function login($email, $password)
    {
        $sql = "SELECT * FROM `manager` WHERE `emailManager` = '$email'";
        $result = $this->conection->query($sql);

        // Si la consulta no devuelve nada, la función devuelve false.
        if ($result->num_rows < 1) return false;


        $row = $result->fetch_assoc();

        if ($password != $row['passwordManager']) {
            return false;
        }
        $_SESSION['manager'] = $row['idManager'];

        return new Manager($row['idManager'], $row['nameManager'], $row['surnameManager'], $row['emailManager'], $row['passwordManager'], $row['showManager'], $row['idLocation']);
    }

    public function loginV($email, $password)
    {
        // Consulta a la base de datos.
        $sql = "SELECT * FROM `visitor` WHERE `emailVisitor` = '$email'";

        // Resultado de la consulta.
        $result = $this->conection->query($sql);
        // Si la consulta no devuelve nada, la función devuelve false.
        if ($result->num_rows < 1) return false;

        // Se guarda la fila.
        $row = $result->fetch_assoc();

        if ($password != $row['passwordVisitor']) {
            return false;
        }

        // se crea una variable de sesión que guarda el id del manager.
        $_SESSION['visitor'] = $row['idVisitor'];

        return new Visitor($row['idVisitor'], $row['nameVisitor'], $row['surnameVisitor'], $row['emailVisitor'], $row['passwordVisitor'], $row['genderVisitor'], $row['datebirthVisitor'], $row['cityVisitor']);
    }

    public function close()
    {
        $_SESSION['manager'] = null;
        session_destroy();
    }
    public function closeV()
    {
        $_SESSION['visitor'] = null;
        session_destroy();
    }
}
