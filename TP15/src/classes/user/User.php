<?php
namespace iutnc\deefy\user;

use iutnc\deefy\audio\lists\PlayList;
use iutnc\deefy\exception AS e;
use iutnc\deefy\db\ConnectionFactory;
use \PDO as PDO;

/**
 * Class that create a User object
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
}