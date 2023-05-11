<?php

require_once __DIR__ . '/Db.php';
class Category
{
    private $idCategory;
    private $nameCategory;
    private $descriptionCategory;


    private $conection;

    // Constructor
    public function __construct($idCategory = null, $nameCategory, $descriptionCategory)
    {
        $this->idCategory = $idCategory;
        $this->nameCategory = $nameCategory;
        $this->descriptionCategory = $descriptionCategory;
        $this->getConection();
        /* $this->getPlaces($this->idPlaces); */
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

    /* INSERT LIST DELETE UPDATE  */

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

    public static function getAllCategories()
    {
        $dbObj = new Db();
        $conection = $dbObj->conection;

        $sql = "SELECT * FROM category";
        $result = $conection->query($sql);
        $categories = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = new Category($row['idCategory'], $row['nameCategory'], $row['descriptionCategory']);
            }
        }

        return $categories;
    }
    /* llamar array categorias 
    $allCategories = Category::getAllCategories();
    */
}
