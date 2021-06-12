<?php

/**
 * Class JugadorDAO
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com">sandraguerreror1995@gmail.com</a>
 */
class JugadorDAO extends BaseDAO
{

    /**
     * @var string
     */
    private $nombreTabla = "jugador";
    /**
     * @var \EquipoDAO
     */
    private $modelEquipo;

    /**
     * JugadorDAO constructor.
     */
    public function __construct()
    {
        parent::__construct($this->nombreTabla);
        $this->modelEquipo = new EquipoDAO();
    }

    /**
     * Function add
     * @param object $jugador
     * @return mixed|void
     */
    public function add(object $jugador)
    {
        // Añadir persona
        $pdo = $this->conexion->prepare('INSERT INTO `persona`( `dni`, `nombre`, `primerApellido`, `segundoApellido`, `telefono`) VALUES (?,?,?,?,?)');
        $pdo->execute(
            array(
                $jugador->getDni(),
                $jugador->getNombre(),
                $jugador->getPrimerApellido(),
                $jugador->getSegundoApellido(),
                $jugador->getTelefono()
            )
        );

        $idJugador = $this->conexion->lastInsertId();

        // Añadir jugador
        $pdo = $this->conexion->prepare('INSERT INTO `jugador`(`idJugador`, `genero`, `altura`, `extracomunitario`, `fechaNacimiento`, `estado`, `posicion`, `biografia`, `informe`, `visible`) VALUES (?,?,?,?,?,?,?,?,?,?)');

        $pdo->execute(
            array(
                $idJugador,
                $jugador->getGenero(),
                $jugador->getAltura(),
                $jugador->getExtracomunitario(),
                $jugador->getFechaNacimiento(),
                $jugador->getEstado(),
                $jugador->getPosicion(),
                $jugador->getBiografia(),
                $jugador->getInforme(),
                $jugador->getVisible()
            )
        );

        // Añadir imagen del usuario
        $pdo = $this->conexion->prepare("INSERT INTO `imagen`(`ruta`,`idJugador`) VALUES(?,?)");

        $pdo->execute(
            array(
                $jugador->getRuta(),
                $idJugador
            )
        );

        // Añadir equipo
        if ($jugador->getEquipo() != "") {
            $idEquipo = $this->modelEquipo->getIdEquipo($jugador->getEquipo());
            if ($idEquipo == null) {
                $pdo = $this->conexion->prepare('INSERT INTO `equipo`(`nombre`) VALUES (?)');
                $pdo->execute(array($jugador->getEquipo()));
                $idEquipo = $this->conexion->lastInsertId();
            }
            $pdo = $this->conexion->prepare('UPDATE `jugador` SET `idEquipo`=? WHERE `idJugador` = ?');
            $pdo->execute(array($idEquipo, $idJugador));
        }

        // Añadir nacionalidades
        foreach ($jugador->getNacionalidades() as $nacionalidad) {
            $pdo = $this->conexion->prepare('INSERT INTO `jugadores_nacionalidades`(`idJugador`, `idNacionalidad`) VALUES (?,?)');
            $pdo->execute(array($idJugador, $nacionalidad));
        }
    }

    /**
     * Function edit
     * @param $idJugador
     * @param object $jugador
     * @return mixed|void
     */
    public function edit($idJugador, object $jugador)
    {
        // Editar persona
        $pdo = $this->conexion->prepare('UPDATE `persona` set `dni`=?, `nombre`=?, `primerApellido`=?, `segundoApellido`=?, `telefono`=? where `idPersona`=? ');

        $pdo->execute(
            array(
                $jugador->getDni(),
                $jugador->getNombre(),
                $jugador->getPrimerApellido(),
                $jugador->getSegundoApellido(),
                $jugador->getTelefono(),
                $idJugador
            )
        );

        // Añadir jugador
        $pdo = $this->conexion->prepare('UPDATE `jugador` set `genero`=?, `altura`=?, `extracomunitario`=?, `fechaNacimiento`=?, `estado`=?, `posicion`=?, `biografia`=?, `informe`=?, `visible`=? where idJugador=?');

        $pdo->execute(
            array(
                $jugador->getGenero(),
                $jugador->getAltura(),
                $jugador->getExtracomunitario(),
                $jugador->getFechaNacimiento(),
                $jugador->getEstado(),
                $jugador->getPosicion(),
                $jugador->getBiografia(),
                $jugador->getInforme(),
                $jugador->getVisible(),
                $idJugador
            )
        );

        // Añadir imagen del usuario
        $pdo = $this->conexion->prepare("UPDATE `imagen` set `ruta`=? where idJugador=?");

        $pdo->execute(
            array(
                $jugador->getRuta(),
                $idJugador
            )
        );

        // Añadir equipo
        if ($jugador->getEquipo() != "") {
            $idEquipo = $this->modelEquipo->getIdEquipo($jugador->getEquipo());
            if ($idEquipo == null) {
                $pdo = $this->conexion->prepare('INSERT INTO `equipo`(`nombre`) VALUES (?)');
                $pdo->execute(array($jugador->getEquipo()));
                $idEquipo = $this->conexion->lastInsertId();
            }
            $pdo = $this->conexion->prepare('UPDATE `jugador` SET `idEquipo`=? WHERE `idJugador` = ?');
            $pdo->execute(array($idEquipo, $idJugador));
        }

        // Cambiar nacionalidades

        // Eliminar antiguas nacionalidades
        $pdo = $this->conexion->prepare('DELETE from `jugadores_nacionalidades` where idJugador=?');
        $pdo->execute(array($idJugador));
        // Añadir las nuevas nacionalidades
        foreach ($jugador->getNacionalidades() as $nacionalidad) {
            $pdo = $this->conexion->prepare('INSERT INTO `jugadores_nacionalidades`(`idJugador`, `idNacionalidad`) VALUES (?,?)');
            $pdo->execute(array($idJugador, $nacionalidad));
        }
    }

    /**
     * Function list
     * @return array|null
     */
    function list()
    {
        try {
            $result = null;

            $stm = $this->conexion->prepare("SELECT * FROM `viewjugador`");
            $stm->execute();
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, $this->nombreTabla);
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function view
     * @param $id
     * @return mixed|null
     */
    function view($id)
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT * FROM `viewjugador` where idJugador=?");
            $stm->execute(array($id));
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchObject($this->nombreTabla);

                // Añadir nacionalidades
                $result->setNacionalidades($this->getNacionalidadesJugador($id));
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function getNacionalidadesJugador
     * @param $idJugador
     * @return array
     */
    private function getNacionalidadesJugador($idJugador)
    {
        $nacionalidades = array();
        $stm = $this->conexion->prepare('SELECT nacionalidad.* FROM jugadores_nacionalidades left join nacionalidad on jugadores_nacionalidades.idNacionalidad = nacionalidad.idNacionalidad WHERE idJugador=?');
        $stm->execute(array($idJugador));
        if ($stm->rowCount() != 0) {
            $nacionalidades = $stm->fetchAll(PDO::FETCH_CLASS, "Nacionalidad");
        }
        return $nacionalidades;

    }

    /**
     * Function listNacionalidades
     * @return array|null
     */
    function listNacionalidades()
    {
        $nacionalidades = null;
        $stm = $this->conexion->prepare('SELECT * FROM nacionalidad order by nombre');
        $stm->execute();
        if ($stm->rowCount() != 0) {
            $nacionalidades = $stm->fetchAll(PDO::FETCH_CLASS, "Nacionalidad");
        }
        return $nacionalidades;

    }


    /**
     * Function delete
     * @param object $id
     * @return mixed|void
     */
    public function delete($id)
    {
        parent::delete($id);
    }

    /**
     * Function getImage
     * @param $id
     * @return mixed|null
     */
    public function getImage($id)
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT ruta FROM $this->nombreTabla LEFT JOIN imagen on jugador.idJugador = imagen.idJugador where jugador.idJugador=?");
            $stm->execute(array($id));
            if ($stm->rowCount() != 0) {
                $result = $stm->fetch(PDO::FETCH_ASSOC);
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function getJugadoresWithEstadisticas
     * @return array|null
     */
    function getJugadoresWithEstadisticas()
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT * FROM `viewjugadoreswithestadisticas`;");
            $stm->execute();
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, "Jugador");
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function getJugadoresWithVideos
     * @return array|null
     */
    function getJugadoresWithVideos()
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT * FROM `viewjugadoreswithvideos`");
            $stm->execute();
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, "Jugador");
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function getJugadores
     * @return array|null
     */
    function getJugadores()
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT * FROM `viewgetjugadoresresumen`");
            $stm->execute();
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, "Jugador");
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function getJugadoresVisibles
     * @return array|null
     */
    function getJugadoresVisibles()
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT * FROM `viewjugadoresvisibles`");
            $stm->execute();
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, "Jugador");
                foreach ($result as $jugador) {
                    $jugador->setNacionalidades($this->getNacionalidadesJugador($jugador->getIdJugador()));
                }
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


}
