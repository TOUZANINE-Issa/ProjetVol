<?php


class reservation
{
    private $id_reservation;
    private $ref_user;
    private $ref_avion;
    private $nbrPlace;
    private $destination;
    private $heureDepart;
    private $heureArriver;
    private $descriptions;

    /**
     * @return mixed
     */
    public function getId_reservation()
    {
        return $this->idreservation;
    }

    /**
     * @param mixed $idreservation
     */
    public function setId_reservation($id_reservation)
    {
        $this->id_reservation = $id_reservation;
    }

    /**
     * @return mixed
     */
    public function getRefUser()
    {
        return $this->ref_user;
    }

    /**
     * @param mixed $ref_user
     */
    public function setRefUser($ref_user)
    {
        $this->ref_user = $ref_user;
    }

    /**
     * @return mixed
     */
    public function getRefAvion()
    {
        return $this->ref_avion;
    }

    /**
     * @param mixed $ref_avion
     */
    public function setRefAvion($ref_avion)
    {
        $this->ref_avion = $ref_avion;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return mixed
     */
    public function getNbrPlace()
    {
        return $this->nbrPlace;
    }

    /**
     * @param mixed $nbrPlace
     */
    public function setNbrPlace($nbrPlace)
    {
        $this->nbrPlace = $nbrPlace;
    }

    /**
     * @return mixed
     */
    public function getHeureDepart()
    {
        return $this->heureDepart;
    }

    /**
     * @param mixed $heureDepart
     */
    public function setHeureDepart($heureDepart)
    {
        $this->heureDepart = $heureDepart;
    }

    /**
     * @return mixed
     */
    public function getHeureArriver()
    {
        return $this->heureArriver;
    }

    /**
     * @param mixed $heureArriver
     */
    public function setHeureArriver($heureArriver)
    {
        $this->heureArriver = $heureArriver;
    }

    /**
     * @return mixed
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * @param mixed $descriptions
     */
    public function setDescriptions($descriptions)
    {
        $this->descriptions = $descriptions;
    }


    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }
    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                // On appelle le setter
                $this->$method($value);
            }
        }
    }


}