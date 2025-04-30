<?php

class  avion
{
    private $id_avion;
    private $compagny;
    private $type;
    /**
     * @return mixed
     */
    public function getIdAvion()
    {
        return $this->id_avion;
    }

    /**
     * @param mixed $id_avion
     */
    public function setIdAvion($id_avion)
    {
        $this->id_avion = $id_avion;
    }

    /**
     * @return mixed
     */
    public function getCompagny()
    {
        return $this->compagny;
    }

    /**
     * @param mixed $compagny
     */
    public function setCompagny($compagny)
    {
        $this->compagny = $compagny;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
