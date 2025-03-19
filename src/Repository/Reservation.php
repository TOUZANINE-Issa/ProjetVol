<?php

namespace src\modele;

class reservation
{
    private $idReservation;
    private $refUser;
    private $refSeance;
    private $nbrPlace;
    private $idFilm;
    private $nom_film;
    private $duree;
    private $image;
    private $genre;
    private $descriptions;


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

    /**
     * @return mixed
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * @param mixed $idReservation
     */
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
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
    public function getRefSeance()
    {
        return $this->refSeance;
    }

    /**
     * @param mixed $refSeance
     */
    public function setRefSeance($refSeance)
    {
        $this->refSeance = $refSeance;
    }

    /**
     * @return mixed
     */
    public function getRefUser()
    {
        return $this->refUser;
    }

    /**
     * @param mixed $refUser
     */
    public function setRefUser($refUser)
    {
        $this->refUser = $refUser;
    }


    public function getIdFilm()
    {
        return $this->idFilm;
    }
    public function getNomFilm()
    {
        return $this->nom_film;
    }
    public function getDuree()
    {
        return $this->duree;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getGenre()
    {
        return $this->genre;
    }
    public function getDescription()
    {
        return $this->descriptions;
    }

}