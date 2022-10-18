<?php
namespace iutnc\deefy\audio\tracks;

class PodcastTrack extends AudioTrack
{
    //Methods
    public function __construct(string $t, string $c)
    {
        parent::__construct($t, $c);
    }
}