<?php

class User
{
    const STANDARD_USER = 1;
    const ADMIN_USER = 100;

    private string $email, $password, $role;


    public function __set(string $at, mixed $val) : void
    {
        if (!property_exists($this, $at))
            $this->at = $val;
        else throw new NEPExc ("$at : invalid prop");
    }

    public function getPlaylist() : array
    {
        $db = \iutnc\deefy\db\ConnectionFactory::makeConnection();
        $st = $db->prepare("SELECT 'id', 'nom' FROM Playlist p, user2Playlist u WHERE p.i")
        $var = $this->email;
        $st->execute();
        $userPlaylists = [];
        foreach ($st->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $playlist = new \iutnc\deefy\audio\lists\PlayList($row['nom']);
            $playlist->id = $row['id'];
            array_push($userPlaylists, $playlist)
        }
        return $userPlaylists;
    }
}