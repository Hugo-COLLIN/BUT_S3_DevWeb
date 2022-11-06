<?php

namespace iutnc\deefy\action;

class AddUserAction extends Action
{

    public function execute(): string
    {
        $rend = "";
        if ($_SERVER['REQUEST_METHOD'] == "GET")
            $rend .= "
            <form method='post' action='?action=add-user'>
                Email : <input type='email' name='mail'>
                Mot de passe : <input type='password' name='pwd'>
                <input type='submit' value='Valider'>
            </form>";
        else
        {
            $_POST['mail'] = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
            $_POST['pwd'] = filter_var($_POST['pwd'], FILTER_SANITIZE_SPECIAL_CHARS);

            try {
                d\auth\Auth::register($_POST["mail"], $_POST["pwd"]);

                $rend .= "<p><strong>" . $_POST['mail'] .
                    " a été enregistre dans la base.</strong></p>";
            }
            catch (d\exception\PasswordStrenghException | d\exception\AlreadyRegisteredException | d\exception\InvalidPropertyNameException $e)
            {
                $rend .= $e->getMessage();
            }
        }
        return $rend;
    }
}