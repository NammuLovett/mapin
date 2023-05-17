<?php

require_once __DIR__ . '/Db.php';
class Place
{
    private $idPlace;
    private $namePlace;
    private $infoPlace;
    private $descriptionPlace;
    private $addressPlace;
    private $imgPlace;
    private $latPlace;
    private $lonPlace;
    private $showPlace;
    private $idLocation;
    private array $categories = array();

    private $conection;

    // Constructor
    public function __construct($idPlace, $namePlace, $infoPlace, $descriptionPlace, $addressPlace, $imgPlace, $latPlace, $lonPlace, $showPlace, $idLocation)
    {
        $this->idPlace = $idPlace;
        $this->namePlace = $namePlace;
        $this->infoPlace = $infoPlace;
        $this->descriptionPlace = $descriptionPlace;
        $this->addressPlace = $addressPlace;
        $this->imgPlace = $imgPlace;
        $this->latPlace = $latPlace;
        $this->lonPlace = $lonPlace;
        $this->showPlace = $showPlace;
        $this->idLocation = $idLocation;

        $this->getConection();
    }



    // Getters

    public function getConection()
    {
        $dbObj = new Db();
        $this->conection = $dbObj->conection;
    }
    public function getIdPlace()
    {
        return $this->idPlace;
    }

    public function getNamePlace()
    {
        return $this->namePlace;
    }

    public function getInfoPlace()
    {
        return $this->infoPlace;
    }

    public function getDescriptionPlace()
    {
        return $this->descriptionPlace;
    }

    public function getAddressPlace()
    {
        return $this->addressPlace;
    }

    public function getImgPlace()
    {
        return $this->imgPlace;
    }

    public function getLatPlace()
    {
        return $this->latPlace;
    }

    public function getLonPlace()
    {
        return $this->lonPlace;
    }
    public function getShowPlace()
    {
        return $this->showPlace;
    }

    public function getIdLocation()
    {
        return $this->idLocation;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    // Setters
    public function setIdPlace($idPlace)
    {
        $this->idPlace = $idPlace;
    }

    public function setNamePlace($namePlace)
    {
        $this->namePlace = $namePlace;
    }

    public function setInfoPlace($infoPlace)
    {
        $this->infoPlace = $infoPlace;
    }

    public function setDescriptionPlace($descriptionPlace)
    {
        $this->descriptionPlace = $descriptionPlace;
    }

    public function setAddressPlace($addressPlace)
    {
        $this->addressPlace = $addressPlace;
    }

    public function setImgPlace($imgPlace)
    {
        $this->imgPlace = $imgPlace;
    }

    public function setLatPlace($latPlace)
    {
        $this->latPlace = $latPlace;
    }

    public function setLonPlace($lonPlace)
    {
        $this->lonPlace = $lonPlace;
    }

    public function setShowPlace($showPlace)
    {
        $this->showPlace = $showPlace;
    }

    public function setIdLocation($idLocation)
    {
        $this->idLocation = $idLocation;
    }



    /* FUNCIONES */

    public static function getAllPlaces()
    {
        $dbObj = new Db();
        $conection = $dbObj->conection;

        $sql = "SELECT * FROM place";
        $result = $conection->query($sql);
        $places = [];

        if ($result === false) {
            // si falla, mostrar el error
            echo "Error: " . $conection->error;
        } else {
            while ($row = $result->fetch_assoc()) {
                $places[] = new Place($row['idPlace'], $row['namePlace'], $row['infoPlace'], $row['descriptionPlace'], $row['addressPlace'], $row['imgPlace'], $row['latPlace'], $row['lonPlace'], $row['showPlace'], $row['idLocation']);
            }
        }

        return $places;
    }

    public static function getPlaceById($idPlace)
    {
        $dbObj = new Db();
        $conection = $dbObj->conection;

        $sql = "SELECT * FROM place WHERE idPlace = '$idPlace'";

        $result = $conection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $place = new Place($row['idPlace'], $row['namePlace'], $row['infoPlace'], $row['descriptionPlace'], $row['addressPlace'], $row['imgPlace'], $row['latPlace'], $row['lonPlace'], $row['showPlace'], $row['idLocation']);
            return $place;
        } else {
            return null;
        }
    }



    public function addPlace($namePlace, $infoPlace, $descriptionPlace, $addressPlace, $imgPlace, $latPlace, $lonPlace, $showPlace, $idLocation)
    {
        $this->getConection();
        $sql = "INSERT INTO place (namePlace, infoPlace, descriptionPlace, addressPlace, imgPlace, latPlace, lonPlace, showPlace, idLocation) VALUES ('$namePlace', '$infoPlace','$descriptionPlace','$addressPlace', '$imgPlace', '$latPlace', '$lonPlace', '$showPlace', '$idLocation' )";



        if ($this->conection->query($sql) === false) {
            echo "Error: " . $sql . "<br>" . $this->conection->error;
        }
        return $this->conection->insert_id;
    }


    public function deletePlace($idPlace)
    {
        $this->getConection();
        $sql = "DELETE FROM place WHERE idPlace = '$idPlace'";

        if ($this->conection->query($sql) === false) {
            echo "Error: " . $sql . "<br>" . $this->conection->error;
        }
    }

    public function toArray()
    {
        return [
            'idPlace' => $this->idPlace,
            'namePlace' => $this->namePlace,
            'infoPlace' => $this->infoPlace,
            'descriptionPlace' => $this->descriptionPlace,
            'addressPlace' => $this->addressPlace,
            'imgPlace' => $this->imgPlace,
            'latPlace' => $this->latPlace,
            'lonPlace' => $this->lonPlace,
            'showPlace' => $this->showPlace,
            'idLocation' => $this->idLocation
        ];
    }

    public function assignCategories($idPlace, $categories)

    {
        $this->getConection();

        // Validar los valores antes de utilizarlos en la consulta
        $idPlace = intval($idPlace); // Convertir a entero
        $categories = array_map('intval', $categories); // Convertir a entero


        foreach ($categories as $idCategory) {
            $sql = "INSERT INTO placeHaveCategory (idPlace, idCategory) VALUES ('$idPlace', '$idCategory')";
            if ($this->conection->query($sql) === false) {
                echo "Error: " . $sql . "<br>" . $this->conection->error;
            }
        }
    }


    public static function getPlacesByCategoryId($idCategory)
    {
        $idCategory = intval($idCategory);

        $dbObj = new Db();
        $conection = $dbObj->conection;

        $sql = "SELECT p.* FROM place p JOIN placeHaveCategory pc ON p.idPlace = pc.idPlace WHERE pc.idCategory = '$idCategory'";

        $result = $conection->query($sql);

        $places = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $place = new Place($row['idPlace'], $row['namePlace'], $row['infoPlace'], $row['descriptionPlace'], $row['addressPlace'], $row['imgPlace'], $row['latPlace'], $row['lonPlace'], $row['showPlace'], $row['idLocation']);
                $places[] = $place;
            }
        }

        return $places;
    }

    public static function getAllPlacesNotVisitedBy($idVisitor)
    {
        $idVisitor = intval($idVisitor);

        $dbObj = new Db();
        $conection = $dbObj->conection;

        $sql = "SELECT p.* FROM place p WHERE p.idPlace NOT IN (SELECT vvp.idPlace FROM visitorVisitPlace vvp WHERE vvp.idVisitor = '$idVisitor')";

        $result = $conection->query($sql);

        $places = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $place = new Place($row['idPlace'], $row['namePlace'], $row['infoPlace'], $row['descriptionPlace'], $row['addressPlace'], $row['imgPlace'], $row['latPlace'], $row['lonPlace'], $row['showPlace'], $row['idLocation']);
                $places[] = $place;
            }
        }


        return $places;
    }
    public static function getAllPlacesVisitedBy($idVisitor)
    {
        $idVisitor = intval($idVisitor);

        $dbObj = new Db();
        $conection = $dbObj->conection;

        $sql = "SELECT p.* FROM place p WHERE p.idPlace IN (SELECT vvp.idPlace FROM visitorVisitPlace vvp WHERE vvp.idVisitor = '$idVisitor')";

        $result = $conection->query($sql);

        $places = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $place = new Place($row['idPlace'], $row['namePlace'], $row['infoPlace'], $row['descriptionPlace'], $row['addressPlace'], $row['imgPlace'], $row['latPlace'], $row['lonPlace'], $row['showPlace'], $row['idLocation']);
                $places[] = $place;
            }
        }

        return $places;
    }
}
