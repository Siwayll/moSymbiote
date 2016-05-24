<?php
/**
 * Fonctionnalités de générations d'url
 *
 * @author  Siwaÿll <sanath.labs@gmail.com>
 * @license CC by-nc http://creativecommons.org/licenses/by-nc/3.0/fr/
 */

namespace Siwayll\Mollicute;

/**
 * Fonctionnalités de générations d'url
 *
 * @author  Siwaÿll <sanath.labs@gmail.com>
 * @license CC by-nc http://creativecommons.org/licenses/by-nc/3.0/fr/
 */
class Command
{
    /**
     * Active la génération d'un plan
     *
     * @return Command
     */
    public function declinationActivation()
    {
    }

    /**
     * Renvois les valeurs possible du marqueur
     *
     * @param string $mark Nom du marqueur
     *
     * @return string
     */
    public function getDeclination($mark)
    {
    }

    /**
     * Définie un générateur
     *
     * @param string   $mark      Nom du marqueur
     * @param callable $generator liste des données
     *
     * @return Command
     */
    public function setDeclination($mark, $generator)
    {
    }
}
