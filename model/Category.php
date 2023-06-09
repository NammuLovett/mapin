<?php

require_once __DIR__ . '/Db.php';
class Category
{
    private $idCategory;
    private $nameCategory;
    private $descriptionCategory;


    private $conection;

    // Constructor
    public function __construct($idCategory, $nameCategory, $descriptionCategory)
    {
        $this->idCategory = $idCategory;
        $this->nameCategory = $nameCategory;
        $this->descriptionCategory = $descriptionCategory;
        $this->getConection();
    }

    // Getters
    public function getConection()
    {
        $dbObj = new Db();
        $this->conection = $dbObj->conection;
    }

    public function getIdCategory()
    {
        return $this->idCategory;
    }

    public function getNameCategory()
    {
        return $this->nameCategory;
    }

    public function getDescriptionCategory()
    {
        return $this->descriptionCategory;
    }



    public function setNameCategory($nameCategory)
    {
        $this->nameCategory = $nameCategory;
    }

    public function setDescriptionCategory($descriptionCategory)
    {
        $this->descriptionCategory = $descriptionCategory;
    }

    /* INSERT DELETE UPDATE  */

    public function addCategory($nameCategory, $descriptionCategory)
    {
        $this->getConection();
        $sql = "INSERT INTO category (nameCategory, descriptionCategory) VALUES ('$nameCategory', '$descriptionCategory')";

        if ($this->conection->query($sql) === false) {
            echo "Error: " . $sql . "<br>" . $this->conection->error;
        }
    }

    public function editCategory($idCategory)
    {
        $this->getConection();
        $sql = "UPDATE category SET nameCategory = '$this->nameCategory', descriptionCategory = '$this->descriptionCategory' WHERE idCategory = '$idCategory'";

        if ($this->conection->query($sql) === false) {
            echo "Error: " . $sql . "<br>" . $this->conection->error;
        }
    }

    public function deleteCategory($idCategory)
    {
        $this->getConection();
        $sql = "DELETE FROM category WHERE idCategory = '$idCategory'";

        if ($this->conection->query($sql) === false) {
            echo "Error: " . $sql . "<br>" . $this->conection->error;
        }
    }

    /* Obtener todas categoría */
    public static function getAllCategories()
    {
        $dbObj = new Db();
        $conection = $dbObj->conection;

        $sql = "SELECT * FROM category";
        $result = $conection->query($sql);
        $categories = [];

        // Llenar el array con nuevos objetos de la clase Category
        while ($row = $result->fetch_assoc()) {
            $categories[] = new Category($row['idCategory'], $row['nameCategory'], $row['descriptionCategory']);
        }

        // Devolver el array de objetos Category
        return $categories;
    }


    /* Obtener la categoría por ID */

    public static function getCategoryById($idCategory)
    {
        $dbObj = new Db();
        $conection = $dbObj->conection;

        $sql = "SELECT * FROM category WHERE idCategory = '$idCategory'";

        $result = $conection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $category = new Category($row['idCategory'], $row['nameCategory'], $row['descriptionCategory']);
            return $category;
        } else {
            return null;
        }
    }
}
