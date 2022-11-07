<?php
namespace iutnc\deefy\audio\lists;

use iutnc\deefy as d;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\exception\EmptyRequestException;
use iutnc\deefy\exception\InvalidPropertyNameException;

class PlayList extends AudioList
{
    public function addTrack(AudioTrack $track) : void
    {
        array_push($this->tracklist, $track);
        $this->nbPiste ++;
        $this->dureeTot += isset($track->duree) ? $track->duree : 0;
    }

    public function removeTrack(int $indice) : void
    {
        unset($this->tracklist[$indice]);
    }

    public function addTrackList(array $tracks) : void
    {
        $this->tracklist = array_unique(array_merge($this->tracklist, $tracks), SORT_REGULAR);
        $this->nbPiste = count($this->tracklist); //$this->nbPiste += sizeof($tracks);

        //foreach ($tracks as $t) $this->dureeTot += isset($t->duree) ? $t->duree : 0;
        foreach ($this->tracklist as $item)
            $this->dureeTot += $item->duree;

    }

    /**
     * @throws EmptyRequestException
     */
    public static function find (int $idPl) : PlayList
    {
        $db = ConnectionFactory::makeConnection();
        $qPl = "SELECT nom FROM playlist WHERE id=?";
        $stPl = $db->prepare($qPl);
        $stPl->execute([$idPl]);

        if ($resPl = $stPl->fetch(\PDO::FETCH_ASSOC))
        {
            $qTrack = "SELECT * FROM track, playlist2track
                        WHERE track.id = playlist2track.id_track
                        AND playlist2track.id_pl = ?";
            $stTr = $db->prepare($qTrack);
            $stPl->execute([$idPl]);

            $tabTr = [];
            while ($track = $stTr->fetch(\PDO::FETCH_ASSOC)) {
                $tabTr[] = new d\audio\tracks\PodcastTrack($track["titre"], $track["filename"]);
            }
            $db = null;
            return new PlayList($resPl["nom"], $tabTr);
        }
        else throw new d\exception\EmptyRequestException("La playlist n'existe pas.");
    }

    /**
     * @throws InvalidPropertyNameException
     */
    public function __get(string $name) : mixed
    {
        if (!property_exists($this, $name))
            throw new InvalidPropertyNameException();
        return $this->$name;
    }
/*
    public function getTrackList ()
    {
        $db make co
        $q = "SELECT * from track t, playlist2track p WHERE t.id = p.id_tr";

        $st = premape;

        $tracklist = [];

        foreach ($st->fetchall(PDO::FETCH_ASSOC) as $row) {
            switch ($row['type'])
            {
                case 'A':
                    $track = new tr\AlbumTrack($row titre, )

            }

        }
    }
*/
}