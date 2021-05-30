<?php


class ContactoDAO extends BaseDAO
{
    private $nombreTabla = "contacto";
    private $modelEquipo;

    public function __construct()
    {
        parent::__construct($this->nombreTabla);
        $this->modelEquipo = new EquipoDAO();
    }

    function edit($id, object $contacto)
    {
        // Actualizar persona
        $pdo = $this->conexion->prepare('UPDATE `persona` set `dni`=?, `nombre`=?, `primerApellido`=?, `segundoApellido`=?, `telefono`=? where idPersona=?');

        $pdo->execute(
            array(
                $contacto->getDni(),
                $contacto->getNombre(),
                $contacto->getPrimerApellido(),
                $contacto->getSegundoApellido(),
                $contacto->getTelefono(),
                $id
            )
        );

        // Actualizar contacto
        $pdo = $this->conexion->prepare('UPDATE `contacto` set `nota`=? where idContacto=?');

        $pdo->execute(
            array(
                $contacto->getNota(),
                $id
            )
        );

        // Actualizar equipo
        if ($contacto->getIdEquipo() != "") {
            $idEquipo = $this->modelEquipo->getIdEquipo($contacto->getIdEquipo());
            if ($idEquipo == null) {
                $pdo = $this->conexion->prepare('INSERT INTO `equipo`(`nombre`) VALUES (?)');
                $pdo->execute(array($contacto->getIdEquipo()));
                $idEquipo = $this->conexion->lastInsertId();
            }
            $pdo = $this->conexion->prepare('UPDATE `contacto` SET `idEquipo`=? WHERE `idContacto` = ?');
            $pdo->execute(array($idEquipo, $id));
        }
    }

    function add(object $contacto)
    {
        // Añadir persona
        $pdo = $this->conexion->prepare('INSERT INTO `persona`( `dni`, `nombre`, `primerApellido`, `segundoApellido`, `telefono`) VALUES (?,?,?,?,?)');

        $pdo->execute(
            array(
                $contacto->getDni(),
                $contacto->getNombre(),
                $contacto->getPrimerApellido(),
                $contacto->getSegundoApellido(),
                $contacto->getTelefono()
            )
        );

        $idContacto = $this->conexion->lastInsertId();

        // Añadir contacto
        $pdo = $this->conexion->prepare('INSERT INTO `contacto`(`idContacto`, `nota`) VALUES (?,?)');

        $pdo->execute(
            array(
                $idContacto,
                $contacto->getNota(),
            )
        );

        // Añadir equipo
        if ($contacto->getIdEquipo() != "") {
            $idEquipo = $this->modelEquipo->getIdEquipo($contacto->getIdEquipo());
            if ($idEquipo == null) {
                $pdo = $this->conexion->prepare('INSERT INTO `equipo`(`nombre`) VALUES (?)');
                $pdo->execute(array($contacto->getIdEquipo()));
                $idEquipo = $this->conexion->lastInsertId();
            }
            $pdo = $this->conexion->prepare('UPDATE `contacto` SET `idEquipo`=? WHERE `idContacto` = ?');
            $pdo->execute(array($idEquipo, $idContacto));
        }
    }

    function view($id)
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT persona.*, contacto.*, equipo.nombre as equipo, equipo.idEquipo FROM `contacto` INNER JOIN persona on persona.idPersona = contacto.idContacto LEFT JOIN equipo on equipo.idEquipo = contacto.idEquipo WHERE idContacto=?");
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

            $stm = $this->conexion->prepare("SELECT * FROM `viewcontacto`;");
            $stm->execute();
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, $this->nombreTabla);
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function delete($id)
    {
        parent::delete($id);
    }


}