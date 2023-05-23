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

    public function editPlace($idPlace)
    {
        $this->getConection();

        $sql = "UPDATE place SET 
            namePlace = '{$this->namePlace}', 
            infoPlace = '{$this->infoPlace}', 
            descriptionPlace = '{$this->descriptionPlace}', 
            addressPlace = '{$this->addressPlace}', 
            imgPlace = '{$this->imgPlace}', 
            latPlace = '{$this->latPlace}', 
            lonPlace = '{$this->lonPlace}', 
            showPlace = '{$this->showPlace}', 
            idLocation = '{$this->idLocation}' 
        WHERE idPlace = '{$idPlace}'";

        if ($this->conection->query($sql)) {
            if ($this->conection->affected_rows === 0) {
                echo "No se ha actualizado la fila.";
            } else {
                echo $this->conection->affected_rows . " row(s) updated.";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $this->conection->error;
        }
    }

    public function deletePlace($idPlace)
    {
        $this->getConection();
        $sql = "DELETE FROM place WHERE idPlace = '$idPlace'";

        if ($this->conection->query($sql) === false) {
            echo "Error: " . $sql . "<br>" . $this->conection->error;
        }
    }

    /* Conversión datos del array de BD a Array asociativo para que funcione JSON */
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

    /* Formulario categorías / Editar Categorías */
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

    /* Vista categorías */
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

    /* vista descubre NV */
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

    /* vista descubre V*/
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

    /* vista favorito */
    public static function getAllFavoritePlacesBy($idVisitor)
    {
        $idVisitor = intval($idVisitor);

        $dbObj = new Db();
        $conection = $dbObj->conection;

        $sql = "SELECT p.* FROM place p WHERE p.idPlace IN (SELECT vfp.idPlace FROM visitorFavPlace vfp WHERE vfp.idVisitor = '$idVisitor')";

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

    /* vista detalle place Comprobar si se ha visitado*/
    public function checkIfVisited($idVisitor, $idPlace)
    {
        $idVisitor = intval($idVisitor);
        $dbObj = new Db();

        $conection = $dbObj->conection;
        $sql = "SELECT * FROM visitorVisitPlace WHERE idVisitor = $idVisitor AND idPlace = $idPlace";

        $result = $conection->query($sql);

        // Si el visitante ha marcado el lugar como visitado, devuelve la fila completa
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        // Si el visitante no ha marcado el lugar como visitado, devuelve false
        return false;
    }
    /* vista detalle place si es favort*/
    public function checkIfFavorited($idVisitor, $idPlace)
    {
        $idVisitor = intval($idVisitor);
        $dbObj = new Db();

        $conection = $dbObj->conection;
        $sql = "SELECT * FROM visitorFavPlace WHERE idVisitor = $idVisitor AND idPlace = $idPlace";

        $result = $conection->query($sql);
        // Si el visitante ha marcado el lugar como favorito, devuelve true
        if ($result->num_rows > 0) {
            return true;
        }

        // Si el visitante no ha marcado el lugar como favorito, devuelve false
        return false;
    }


    /* vista detalle place */
    public function toggleVisited($idVisitor, $idPlace)
    {
        $idVisitor = intval($idVisitor);
        $dbObj = new Db();
        $conection = $dbObj->conection;

        // Primero, verifica si el lugar ya ha sido visitado
        $visitedData = $this->checkIfVisited($idVisitor, $idPlace);

        if ($visitedData) {
            // Si el lugar ya ha sido visitado, borra el registro
            $sql = "DELETE FROM visitorVisitPlace WHERE idVisitor = $idVisitor AND idPlace = $idPlace";
        } else {
            // Si el lugar no ha sido visitado, inserta un nuevo registro
            $sql = "INSERT INTO visitorVisitPlace (idVisitor, idPlace, dateVVP) VALUES ($idVisitor, $idPlace, NOW())";
        }

        if ($conection->query($sql)) {
            $visitedData = $this->checkIfVisited($idVisitor, $idPlace);
            return array('success' => true, 'Visitado' => $visitedData ? true : false, 'Fecha' => $visitedData ? $visitedData['dateVVP'] : null);
        } else {
            return array('success' => false, 'error' => 'Error de consulta SQL');
        }
    }
    /* vista detalle place */
    public function toggleFavorited($idVisitor, $idPlace)
    {
        $idVisitor = intval($idVisitor);
        $dbObj = new Db();
        $conection = $dbObj->conection;

        // Primero, verifica si el lugar ya es favorito
        $favoritedData = $this->checkIfFavorited($idVisitor, $idPlace);

        if ($favoritedData) {
            // Si el lugar ya es favorito, borra el registro
            $sql = "DELETE FROM visitorFavPlace WHERE idVisitor = $idVisitor AND idPlace = $idPlace";
        } else {
            // Si el lugar no es favorito, inserta un nuevo registro
            $sql = "INSERT INTO visitorFavPlace (idVisitor, idPlace) VALUES ($idVisitor, $idPlace)";
        }

        return $conection->query($sql);
    }

    /* Gráfica */
    public static function getVisitedPlacesCategoriesCountByVisitor($idVisitor)
    {
        $idVisitor = intval($idVisitor);
        $dbObj = new Db();
        $conection = $dbObj->conection;

        //El consultón de la base de datos
        $sql = "SELECT c.idCategory, c.nameCategory, COUNT(*) as visitedPlaces 
                FROM category c 
                JOIN placeHaveCategory pc ON c.idCategory = pc.idCategory
                JOIN visitorVisitPlace vvp ON pc.idPlace = vvp.idPlace 
                WHERE vvp.idVisitor = '$idVisitor' 
                GROUP BY c.idCategory, c.nameCategory";

        $result = $conection->query($sql);
        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        return $categories;
    }

    /* Gráfica */
    public static function getTotalPlaces()
    {
        $dbObj = new Db();
        $conection = $dbObj->conection;

        $sql = "SELECT COUNT(*) as totalPlaces FROM place";

        $result = $conection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['totalPlaces'];
        }

        return 0;
    }

    /* gráfica */
    public static function getVisitedPlacesCount($idVisitor)
    {
        $idVisitor = intval($idVisitor);

        $dbObj = new Db();
        $conection = $dbObj->conection;

        $sql = "SELECT COUNT(DISTINCT idPlace) as visitedCount 
            FROM visitorVisitPlace
            WHERE idVisitor = $idVisitor";

        $result = $conection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['visitedCount'];
        }

        return 0;
    }

    public static function getCategoriesByPlaceId($idPlace)
    {
        $idPlace = intval($idPlace);

        $dbObj = new Db();
        $conection = $dbObj->conection;

        $sql = "SELECT c.idCategory FROM category c JOIN placeHaveCategory pc ON c.idCategory = pc.idCategory WHERE pc.idPlace = '$idPlace'";

        $result = $conection->query($sql);

        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row['idCategory'];
            }
        }

        return $categories;
    }
}
