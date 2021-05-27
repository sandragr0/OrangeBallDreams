<?php
class JugadorDAO extends BaseDAO
{

    private $nombreTabla = "jugador";

    public function __construct()
    {
        parent::__construct($this->nombreTabla);
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

            $idEquipo = $this->checkEquipo($jugador->getEquipo());
            echo $idEquipo;
            if ($idEquipo != null) {
                $pdo = $this->conexion->prepare('UPDATE `jugador` SET `idEquipo`=? WHERE `idJugador` = ?');
                $pdo->execute(array($idEquipo, $idJugador));
            } else {
                $pdo = $this->conexion->prepare('INSERT INTO `equipo`(`nombre`) VALUES (?)');
                $pdo->execute(array($jugador->getEquipo()));

                $idEquipo = $this->conexion->lastInsertId();


                $pdo = $this->conexion->prepare('UPDATE `jugador` SET `idEquipo`=? WHERE `idJugador` = ?');
                $pdo->execute(array($idEquipo, $idJugador));
            }
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
            $idEquipo = $this->checkEquipo($jugador->getEquipo());
            if ($idEquipo != null) {
                $pdo = $this->conexion->prepare('UPDATE `jugador` SET `idEquipo`=? WHERE `idJugador` = ?');
                $pdo->execute(array($idEquipo, $idJugador));
            } else {
                $pdo = $this->conexion->prepare('INSERT INTO `equipo`(`nombre`) VALUES (?)');
                $pdo->execute(array($jugador->getEquipo()));

                $idEquipo = $this->conexion->lastInsertId();

                $pdo = $this->conexion->prepare('UPDATE `jugador` SET `idEquipo`=? WHERE `idJugador` = ?');
                $pdo->execute(array($idEquipo, $idJugador));
            }
        }
    }


    function view($id)
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT jugador.idJugador, dni, persona.nombre, primerApellido, segundoApellido, genero, telefono, altura, extracomunitario, fechaNacimiento, telefono, estado, posicion, biografia, informe, visible, jugador.idEquipo, equipo.nombre as equipo, ruta FROM $this->nombreTabla INNER JOIN persona on persona.idPersona = jugador.idJugador LEFT JOIN equipo on equipo.idEquipo = jugador.idEquipo LEFT JOIN imagen on jugador.idJugador = imagen.idJugador where jugador.idJugador=?");
            $stm->execute(array($id));
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchObject($this->nombreTabla);
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function list()
    {
        try {
            $result = null;

            $stm = $this->conexion->prepare("SELECT jugador.idJugador, dni, persona.nombre, primerApellido, segundoApellido, genero, telefono, altura, extracomunitario, fechaNacimiento, telefono, estado, posicion, biografia, informe, visible, jugador.idEquipo, equipo.nombre as equipo, ruta FROM $this->nombreTabla INNER JOIN persona on persona.idPersona = jugador.idJugador LEFT JOIN equipo on equipo.idEquipo = jugador.idEquipo LEFT JOIN imagen on jugador.idJugador = imagen.idJugador");
            $stm->execute();
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, $this->nombreTabla);
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
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

    public function checkEquipo($nombreEquipo)
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT `idEquipo` FROM `equipo` WHERE `nombre`=?");
            $stm->execute(array($nombreEquipo));
            if ($stm->rowCount() != 0) {
                $result = $stm->fetch(PDO::FETCH_ASSOC);
            }
            return $result["idEquipo"];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
