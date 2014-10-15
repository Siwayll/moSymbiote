<?php
/**
 * Fonctionnalités d'enregistrement du resultat de l'aspiration
 *
 * @author  Siwaÿll <sanath.labs@gmail.com>
 * @license CC by-nc http://creativecommons.org/licenses/by-nc/3.0/fr/
 */

namespace Siwayll\Mollicute;

/**
 * Fonctionnalités d'enregistrement du resultat de l'aspiration
 *
 * @author  Siwaÿll <sanath.labs@gmail.com>
 * @license CC by-nc http://creativecommons.org/licenses/by-nc/3.0/fr/
 */
class Command
{
    /**
     * Active l'écriture dans un fichier
     *
     * @return Command
     */
    public function write()
    {
    }

    /**
     * Personnalisation du nom du fichier
     *
     * @param string $fileName Nouveau nom du fichier
     *
     * @return Command
     */
    public function setFileName($fileName)
    {
    }

    /**
     * Renvois le nom du fichier
     *
     * @return string
     */
    public function getFileName()
    {
    }

    /**
     * Ajoute une chaine à la fin du fichier
     *
     * @param string $content élément à ajouter
     *
     * @return self
     */
    public function fileAppend($content)
    {
    }

    /**
     * Change l'extension utilisée pour le fichier
     *
     * @param string $ext Extension à appliquer au fichier
     *
     * @return Command
     */
    public function setFileExt($ext)
    {
    }
}
