<?php


/**
 * Class ContactoDAO
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com">sandraguerreror1995@gmail.com</a>
 */
class ContactoDAO extends BaseDAO
{
    /**
     * @var string
     */
    private $nombreTabla = "contacto";
    /**
     * @var \EquipoDAO
     */
    private $modelEquipo;

    /**
     * ContactoDAO constructor.
     */
    public function __construct()
    {
        parent::__construct($this->nombreTabla);
        $this->modelEquipo = new EquipoDAO();
    }

    /**
     * Function edit
     * @param $id
     * @param object $contacto
     * @return mixed|void
     */
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

    /**
     * Function add
     * @param object $contacto
     * @return mixed|void
     */
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

    /**
     * Function view
     * @param $id
     * @return mixed|null
     */
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

    /**
     * Function list
     * @return array|null
     */
    function list(): ?array
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

    /**
     * Function delete
     * @param object $id
     */
    function delete($id)
    {
        parent::delete($id);
    }

}