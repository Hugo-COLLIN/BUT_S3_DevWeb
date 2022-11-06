<?php

namespace iutnc\deefy\action;

use iutnc\deefy AS d;
use iutnc\deefy\exception\AuthException;

/**
 * Class that create the signin view
 */
class SigninAction extends Action
{

    /**
     * Method that create the view
     * @return string main view
     */
    public function execute(): string
    {
        $rend = "<h3>Connexion</h3>";
        if ($_SERVER['REQUEST_METHOD'] == "GET")
        {
            $rend .= <<<END
                <form method='post' action='?action=signin' enctype="multipart/form-data">
                    Email : <input type="email" name="email">
                    Password : <input type='password' name='password'>
                    <input type='submit' value='Valider'>
                </form>
            END;
        }
        else
        {
            $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $pwd = $_POST['password'];
            try {
                d\auth\Auth::authentificate($mail, $pwd);
                $user = d\auth\Auth::loadProfile($_POST['email']);
                $_SESSION["user"] = serialize($user);
                //$authuser = unserialize($_SESSION['user']);
                $rend .= "<p>Successfully connected !</p><ul>";

                foreach ($user->getPlaylist() as $item)
                {
                    $alr = new d\render\AudioListRenderer($item);
                    $rend .= "<li>" . $alr->render(d\render\Renderer::COMPACT) . "</li>";
                }
                $rend .= "</ul>";
            }
            catch (AuthException | d\exception\InvalidPropertyValueException $e)
            {
                $rend .= "<b>Informations d'identification invalides</b>";
            }

        }
        return $rend;
    }
}