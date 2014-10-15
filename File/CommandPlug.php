<?php
/**
 * Plugin de Command
 * Ajout des fonctionalités d'écriture dans un fichier
 *
 * @author  Siwaÿll <sanath.labs@gmail.com>
 * @license CC by-nc http://creativecommons.org/licenses/by-nc/3.0/fr/
 */

namespace Siwayll\MoSymbiote\File;

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
            'write' => false,
            'writeFileExt' => 'html',
            'writeFileName' => null,
            'writeAppend' => null,
        ];
    }

    /**
     * Active l'écriture dans un fichier
     *
     * @param Command $cmd Commande en cours
     *
     * @return Command
     */
    public static function write($cmd)
    {
        $cmd->write = true;
        return $cmd;
    }

    /**
     * Personnalisation du nom du fichier
     *
     * @param Command $cmd      Commande en cours
     * @param string  $fileName Nouveau nom du fichier
     *
     * @return Command
     */
    public static function setFileName($cmd, $fileName)
    {
        $cmd->writeFileName = $fileName;
        return $cmd;
    }

    /**
     * Ajout d'éléments à la fin du fichier
     *
     * @param Command $cmd     Commande en cours
     * @param string  $content Informations à ajouter
     *
     * @return Command
     */
    public static function fileAppend($cmd, $content)
    {
        $cmd->writeAppend = $content;
    }

    /**
     * Renvois le nom du fichier
     *
     * @param Command $cmd Commande en cours
     *
     * @return string
     */
    public static function getFileName($cmd)
    {
        return $cmd->writeFileName;
    }

    /**
     * Change l'extension utilisée pour le fichier
     *
     * @param Command $cmd   Commande en cours
     * @param string  $value Extension à appliquer au fichier
     *
     * @return Command
     */
    public static function setFileExt($cmd, $value)
    {
        $cmd->writeFileExt = $value;
        return $cmd;
    }
}
