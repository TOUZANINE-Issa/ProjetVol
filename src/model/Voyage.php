<?php

class Voyage
{
    private $id_reservatio;
    private $destination;
    private $heureDepart;
    private $heureArrivee;
    private $descriptions;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }
    public function hydrate($donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (is_callable(array($this, $method)))
            {
                $this->$method($value);
            }
        }
    }
    /**
     * @return mixed
     */
    public function getIdFilm()
    {
        return $this->idFilm;
    }

    /**
     * @param mixed $idFilm
     */
    public function setIdFilm($idFilm)
    {
        $this->idFilm = $idFilm;
    }

    /**
     * @return mixed
     */
    public function getNomFilm()
    {
        return $this->nomFilm;
    }

    /**
     * @param mixed $nomFilm
     */
    public function setNomFilm($nomFilm)
    {
        $this->nomFilm = $nomFilm;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


}