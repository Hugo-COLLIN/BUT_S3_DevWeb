<?php
namespace iutnc\deefy\user;

use iutnc\deefy\exception AS e;
use iutnc\deefy\db\ConnectionFactory;
use \PDO as PDO;

class User
{
    const STANDARD_USER = 1;
    const ADMIN_USER = 100;

    private string $email, $password, $role;

    public function __construct(string $e, string $p, string $r)
    {
        $this->email = $e;
        $this->password = $p;
        $this->role = $r;
    }

    public function __set(string $at, mixed $val) : void
    {
        if (!property_exists($this, $at))
            $this->at = $val;
        else throw new e\NotEditablePropertyException("$at : invalid prop");
    }

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
            //print_r($row); echo '<br>';
            $playlist = new \iutnc\deefy\audio\lists\PlayList($row['nom']);
            $playlist->id = $row['id'];
            array_push($userPlaylists, $playlist);
        }
        return $userPlaylists;
    }

    public function testQuery ()
    {
        $db = ConnectionFactory::makeConnection();
        $st = $db->prepare("SELECT * FROM playlist");
        $st->execute();

        foreach ($st->fetchAll(PDO::FETCH_NUM) as $row) {
            echo $row['id'] . "<br>";
        }
    }
}