<?php
namespace iutnc\deefy\audio\tracks;

use iutnc\deefy\audio\exception\InvalidPropertyNameException;
use iutnc\deefy\audio\exception\InvalidPropertyValueException;
use iutnc\deefy\audio\exception\NotEditablePropertyException;

class AudioTrack
{
    //Attributes
    protected string $titre;
    protected string $auteur;
    protected int $annee;
    protected string $genre;
    protected int $duree = 0;
    protected string $nomAudio;
    protected string $cheminfichier;

    //Methods
    public function __construct(string $t, string $c)
    {
        $this->titre = $t;
        $this->cheminfichier = $c;
    }

    public function __toString()
    {
        return json_encode($this); //JSON_PRETTY_PRINT
    }

    public function __get(string $att) : mixed
    {
        if (property_exists($this, $att)) return $this->$att;
        //throw new Exception("$att : Invalid property");
        throw new InvalidPropertyNameException(get_called_class() . " : invalid property $att");
    }

    /**
     * @throws InvalidPropertyNameException|NotEditablePropertyException|InvalidPropertyValueException
     */
    public function __set(string $att, $value): void
    {
        //if (property_exists($this, $att)) $this->$att = $value;
        //else throw new Exception("$att : Invalid property");
        if (!property_exists($this, $att))
            throw new InvalidPropertyNameException(get_called_class() . " : invalid property $att");

        if ($att === 'titre' || $att === 'chemin')
            throw new NotEditablePropertyException(get_called_class() . " : non-editable property $att");

        if ($att == 'duree' && $value < 0)
            throw new InvalidPropertyValueException(get_called_class() . " : invalid value for property $att");

        $this->$att = $value;
    }
}