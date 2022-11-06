<?php

namespace iutnc\deefy\auth;

use iutnc\deefy\exception\AlreadyRegisteredException;
use iutnc\deefy\exception\AuthException;
use \iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\exception\EmptyRequestException;
use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\exception\PasswordStrenghException;
use iutnc\deefy\user\User;

/**
 * Class that manage users' connections
 */
class Auth
{
    /**
     * Method that compare credentials sent by user to data already in the base
     * @throws AuthException
     */
    public static function authentificate(string $email, string $pwd) : void
    {
        $db = ConnectionFactory::makeConnection();
        $q = "SELECT * FROM USER WHERE email=?";
        $st = $db->prepare($q);
        $res = $st->execute([$email]);

        if (!$res) throw new AuthException();

        $user = $st->fetch(\PDO::FETCH_ASSOC);

        if (!$user) throw new AuthException();

        if (!password_verify($pwd, $user['passwd'])) throw new AuthException();

        //ou dans loadProfile
        $user = new User($email, $user['passwd'], $user['role']);
        $_SESSION['user'] = serialize($user);
    }

    /**
     * Method that return a User object created from database information about the user
     * @param string $email user email
     * @return User|void User objec
     */
    public static function loadProfile(string $email)
    {
        $db = ConnectionFactory::makeConnection();
        $q = "SELECT * FROM User where email = ?";
        $st = $db->prepare($q);
        $res = $st->execute([$email]);

        $user = $st->fetch(\PDO::FETCH_ASSOC);

        if ($res) return new User($user['email'], $user['passwd'], $user['role']);
    }

    /**
     * Check the strengh of the password sent
     * @param string $pass
     * @param int $long
     * @return bool
     */
    public static function checkPasswordStrengh(string $pass, int $long) : bool
    {
        return strlen($pass) >= $long;
    }

    /**
     * Method that register a new user in the database if he doesn't exist
     * @throws PasswordStrenghException
     * @throws AlreadyRegisteredException
     * @throws InvalidPropertyNameException
     */
    public static function register(string $mail, string $pass)
    {
        if (!self::checkPasswordStrengh($pass, 10))
            throw new PasswordStrenghException();

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
            throw new InvalidPropertyNameException("Email invalide");

        $db = ConnectionFactory::makeConnection();
        $q1 = "SELECT email FROM User WHERE email = ?";
        $st = $db->prepare($q1);

        $st->execute([$mail]);

        if ($st->fetch(\PDO::FETCH_ASSOC) !== false) { //<!>
            throw new AlreadyRegisteredException();
        }

        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $q2 = "INSERT INTO User (email, passwd, role) VALUES (?, ?, ?)";
        $st2 = $db->prepare($q2);
        $st2->execute([$mail, $hash, 1]);

    }


    /**
     * Check that user is authorized to access a playlist
     * @throws EmptyRequestException
     */
    public static function checkAccessLevel (string $userSer, int $plId)
    {
        $user = unserialize($userSer);
        if ($user->role === User::ADMIN_USER) return;

        $q = "SELECT email, role FROM user, user2playlist, playlist
                WHERE user.id = user2playlist.id_user
                AND user2playlist.id_pl = playlist.id
                AND user.email = ?
                AND playlist.id = ?";

        $db = ConnectionFactory::makeConnection();
        $st = $db->prepare($q);

        $st->execute([$user->email, $plId]);
        $res = $st->fetch(\PDO::FETCH_ASSOC);

        if (!$res) throw new EmptyRequestException("Accès refusé à la playlist");
    }

}