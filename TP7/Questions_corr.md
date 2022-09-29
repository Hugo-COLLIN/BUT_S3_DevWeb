#### Exercice 1 :
1) Elle est définie dans ``src/Monolog/Logger.php``.
Son namespace est : ``Monolog\ `` .

2) Oui, elles sont définies dans ``Monolog\ ``<br>
(``Monolog\ErrorHandler`` et ``Monolog\Registry``) <br>
Meme répertoire = même namespace

3) ``Monolog\Handler``

4) ``src/Monolog/Processor/HostnameProcessor.php``

5) ``src/Monolog/Handler/Slack/SlackRecord``

6) Il doit être créé dans ``src/Monolog/Formatter/json`` et être nommé ``JsonFormatter.php``
   <br>(donc le chemin du fichier à créer est ``src/Monolog/Formatter/json/JsonFormatter.php``).

7) La classe s'appelle ``SqlFormatter`` et son namespace est ``Monolog\Formatter\sql``.

8) Le fichier n'est pas affecté car les namespaces n'ont pas de lien avec 
le nom du fichier. En revanche, la convention PSR-4 conseille de nommer 
le namespace en fonction de l'emplacement du fichier dans l'arborescence. 
Il faut donc déplacer le fichier dans ``src/Monolog/Handler/Curl/Utils``

9) Le namespace de la classe inscrit dans le programme n'est pas correct.
   <!-- - Il se peut que le programme ait un namespace qui diffère du
     namespace de la classe qu'on souhaite utiliser. Dans ce cas il faut spécifier
     le namespace avant le nom de la classe ou utiliser une instruction use afin de
     créer un alias utilisable dans le programme. -->
   - Emplacement pas bon par rapport à la logique.
   - Il se peut également qu'il y ait une erreur de frappe (au niveau de l'utilisation 
     de la classe ou dans un use) auquel cas le namespace inscrit 
     diffère du namespace où se trouve la classe que l'on souhaite utiliser.
   - Il peut s'agir d'une erreur de configuration de l'autoloader.

10) Des modifications dans les répertoires **n'impactent pas** les namespaces des classes.
En revanche, il faut modifier les chemins dans tous les ``require_once`` du 
programme principal.