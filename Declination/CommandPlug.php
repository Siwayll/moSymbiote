<?php
/**
 * Plugin de Command
 * Ajout des fonctionalités d'écriture dans un fichier
 *
 * @author  Siwaÿll <sanath.labs@gmail.com>
 * @license CC by-nc http://creativecommons.org/licenses/by-nc/3.0/fr/
 */

namespace Siwayll\MoSymbiote\Declination;

use \Siwayll\Mollicute\Command;

/**
 * Plugin de Command
 * Ajout des fonctionalités d'écriture dans un fichier
 *
 * @author  Siwaÿll <sanath.labs@gmail.com>
 * @license CC by-nc http://creativecommons.org/licenses/by-nc/3.0/fr/
 */
class CommandPlug
{
    /**
     * Renvois les variables propre à Write
     *
     * @return array
     */
    public static function getVars()
    {
        return [
            'declination' => false,
            'declGenerator' => [],
        ];
    }

    /**
     * Active la génération d'un plan
     *
     * @param Command $cmd Commande en cours
     *
     * @return Command
     */
    public static function declination($cmd)
    {
        $cmd->declination = true;
        return $cmd;
    }

    /**
     * Renvois les valeurs possible du marqueur
     *
     * @param Command $cmd  Commande en cours
     * @param string  $mark Nom du marqueur
     *
     * @return string
     */
    public static function getDeclination($cmd, $mark)
    {
        foreach (call_user_func($cmd->declGenerator[$mark]) as $value) {
            yield $value;
        }
    }

    /**
     * Définie un générateur
     *
     * @param Command  $cmd       Commande en cours
     * @param string   $mark      Nom du marqueur
     * @param callable $generator liste des données
     *
     * @return Command
     */
    public static function setDeclination($cmd, $mark, $generator)
    {
        $cmd->declGenerator[$mark] = $generator;
        return $cmd;
    }
}
