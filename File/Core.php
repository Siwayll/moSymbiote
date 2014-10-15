<?php
/**
 * Mycoplasma
 *
 * @author  Siwaÿll <sanath.labs@gmail.com>
 * @license CC by-nc http://creativecommons.org/licenses/by-nc/3.0/fr/
 */

namespace Siwayll\MoSymbiote\File;

use \Siwayll\Mollicute\Command;
use \Siwayll\Mollicute\Core as Mollicute;

/**
 * Mycoplasma
 *
 * @author  Siwaÿll <sanath.labs@gmail.com>
 * @license CC by-nc http://creativecommons.org/licenses/by-nc/3.0/fr/
 */
class Core
{
    /**
     * Initialisation du plugin
     */
    public function __construct()
    {
        $this->dirName = '/home/siwayll/tmp/test/';
    }

    /**
     * Renvois une configuration de base pour un fichier
     *
     * @return File
     */
    public function getFile()
    {
        $file = new File($this->dirName);
        return $file;
    }

    /**
     * Dossier dans lequel enregistrer les fichiers
     *
     * @param string $dirName Chemin vers le dossier qui sera créé
     * si il n'existe pas.
     *
     * @return self
     */
    public function setDir($dirName)
    {
        $this->dirName = $dirName;
        if (!is_dir($this->dirName)) {
            mkdir($this->dirName, 0777, true);
        }
    }

    /**
     * Ecriture du resultat de l'aspiration dans un fichier
     *
     * @param Command   $cmd     Commande en cours
     * @param string    $content Resultat de l'aspiration
     * @param Mollicute $moll    Plan d'aspiration
     *
     * @return array
     */
    public function after(Command $cmd, $content, Mollicute $moll)
    {
        if ($cmd->write !== true) {
            return;
        }
        $file = $this->getFile();

        if (empty($cmd->writeFileName)) {
            $cmd->writeFileName = uniqid();
        }

        $file
            ->setId($cmd->writeFileName)
            ->setExt($cmd->writeFileExt)
            ->write($content)
        ;

        if ($cmd->writeAppend !== null) {
            $file->append($cmd->writeAppend);
        }

        return [
            'mycoplasma' => [
                'file' => $file
            ]
        ];
    }
}
