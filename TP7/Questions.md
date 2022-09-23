#### Exercice 1 :
1) Elle est définie dans ``src/Monolog/Logger.php``.
Son namespace est : ``Monolog\ `` .

2) Oui, elles sont définies dans ``Monolog\ ``<br>
(``Monolog\ErrorHandler`` et ``Monolog\Registry``)

3) ``Monolog\Handler``

4) ``src/Monolog/Processor/HostnameProcessor.php``

5) ``src/Monolog/Handler/Slack/SlackRecord``

6) Il doit être créé dans ``src/Monolog/Formatter/json`` et être nommé ``JsonFormatter.php``
   <br>(donc le chemin du fichier à créer est ``src/Monolog/Formatter/json/JsonFormatter.php``).

7) La classe s'appelle ``SqlFormatter`` et son namespace est ``Monolog\Formatter``.

8) Le fichier n'est pas affecté car les namespaces n'ont pas de lien avec 
le nom du fichier. En revanche, la convention PSR-4 conseille de nommer 
le namespace en fonction de l'emplacement du fichier dans l'arborescence.

9) Le namespace de la classe inscrit dans le programme n'est pas correct.
   - Il se peut que le programme ait un namespace qui diffère du
     namespace de la classe qu'on souhaite utiliser. Dans ce cas il faut spécifier
     le namespace avant le nom de la classe ou utiliser une instruction use afin de
     créer un alias utilisable dans le programme.
   - Il se peut également qu'il y ait une erreur de frappe (au niveau de l'utilisation 
     de la classe ou dans un use) auquel cas le namespace inscrit 
     diffère du namespace où se trouve la classe que l'on souhaite utiliser.

10) Des modifications dans les répertoires **n'impactent pas** les namespaces des classes.
En revanche, il faut modifier les chemins dans tous les ``require_once`` du 
programme principal.