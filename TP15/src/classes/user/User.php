<?php
namespace iutnc\deefy\user;

use iutnc\deefy\audio\lists\PlayList;
use iutnc\deefy\exception AS e;
use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\exception\AlreadyStoredException;
use iutnc\deefy\exception\AuthException;
use iutnc\deefy\exception\EmptyRequestException;
use iutnc\deefy\exception\InvalidPropertyNameException;
use \PDO as PDO;

/**
 * Class that create a User object
 * @author Hugo COLLIN
 */
class User
{
    /**
     * Constants variables : refers to users roles
     */
    const   STANDARD_USER = 1,
            ADMIN_USER = 100;

    /**
     * User specific data
     * @var string
     */
    private string $email, $password, $role;

    /**
     * Constructor
     * @param string $e
     * @param string $p
     * @param string $r
     */
    public function __construct(string $e, string $p, string $r)
    {
        $this->email = $e;
        $this->password = $p;
        $this->role = $r;
    }

    /**
     * Magic setter
     * @param string $at
     * @param mixed $val
     * @return void
     * @throws e\NotEditablePropertyException
     */
    public function __set(string $at, mixed $val) : void
    {
        if (!property_exists($this, $at))
            $this->$at = $val;
        else throw new e\NotEditablePropertyException("$at : invalid prop");
    }

    /**
     * Magic getter
     * @param $prop
     * @return mixed
     * @throws e\InvalidPropertyNameException
     */
    public function __get($prop) : mixed
    {
        if (!property_exists($this, $prop)) throw new e\InvalidPropertyNameException();
        return $this->$prop;
    }

    /**
     * Get all the playlists for a certain user
     * @return array PlayList object's list
     */
    public function getPlaylist() : array
    {
        $db = ConnectionFactory::makeConnection();
        $st = $db->prepare("SELECT playlist.id, nom FROM playlist, user2playlist, user 
                        WHERE playlist.id = user2playlist.id_pl 
                          AND user2playlist.id_user = user.id 
                          AND user.email = ?");
        $var = $this->email;
        $st->bindParam(1, $var);
        $st->execute();
        $userPlaylists = [];
        foreach ($st->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $playlist = new PlayList($row['nom']);
            $playlist->id = $row['id'];
            $userPlaylists[] = $playlist;
        }
        return $userPlaylists;
    }

    /**
     * @param PlayList $pl
     * @throws AuthException
     * @throws InvalidPropertyNameException
     * @throws AlreadyStoredException
     * @throws EmptyRequestException
     */
    public function addPlaylist(PlayList $pl): void
    {
        $db = ConnectionFactory::makeConnection();
        $nomPl = $pl->__get("nom");

        $q1 = "SELECT id FROM user WHERE email = ?";
        $st1 = $db->prepare($q1);
        $st1->bindParam(1, $this->email);
        $st1->execute();
        if (!($q1res = $st1->fetch(\PDO::FETCH_ASSOC))) throw new e\AuthException();
        $usrid = $q1res['id'];

        $q2 = "SELECT nom FROM playlist WHERE nom = ?";
        $st2 = $db->prepare($q2);
        $st2->bindParam(1, $nomPl);
        $st2->execute();
        if ($st2->fetch(\PDO::FETCH_ASSOC)) throw new e\AlreadyStoredException();

        $q3 = "INSERT INTO playlist (nom) VALUES (?)";
        $st3 = $db->prepare($q3);
        $st3->bindParam(1, $nomPl);
        $st3->execute();

        $q4 = "SELECT id FROM playlist WHERE nom = ?";
        $st4 = $db->prepare($q4);
        $st4->bindParam(1, $nomPl);
        $st4->execute();
        if (!($q4res = $st4->fetch(\PDO::FETCH_ASSOC))) throw new e\EmptyRequestException();
        $plid = $q4res['id'];

        $q5 = "INSERT INTO user2playlist (id_user, id_pl) VALUES (?, ?);";
        $st5 = $db->prepare($q5);
        $st5->bindParam(1, $usrid);
        $st5->bindParam(2, $plid);
        $st5->execute();
    }
}