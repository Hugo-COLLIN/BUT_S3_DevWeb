<?php

namespace iutnc\deefy\action;

use iutnc\deefy AS d;

class SigninAction extends Action
{

    public function execute(): string
    {
        $rend = "";
        if ($_SERVER['REQUEST_METHOD'] == "GET")
        {
            $rend .= <<<END
                <h3>Connexion</h3>
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
            catch (Exception $e)
            {
                $rend .= "<b>Informations d'identification invalides</b>";
            }

        }
        return $rend;
    }
}