<?php

class JugadorDAO extends BaseDAO
{

    private $nombreTabla = "jugador";
    private $modelEquipo;

    public function __construct()
    {
        parent::__construct($this->nombreTabla);
        $this->modelEquipo = new EquipoDAO();
    }

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


    public function delete($id)
    {
        parent::delete($id);
    }

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

    function getJugadoresWithEstadisticas()
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT persona.nombre, persona.primerApellido, persona.segundoApellido, jugador.idJugador FROM `estadistica` LEFT JOIN jugador on estadistica.idJugador = jugador.idJugador LEFT JOIN persona on persona.idPersona = estadistica.idJugador");
            $stm->execute();
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, "Jugador");
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function getJugadoresWithVideos()
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT persona.nombre, persona.primerApellido, persona.segundoApellido, jugador.idJugador FROM `video` LEFT JOIN jugador on video.idJugador = jugador.idJugador LEFT JOIN persona on persona.idPersona = video.idJugador");
            $stm->execute();
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, "Jugador");
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

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


}
