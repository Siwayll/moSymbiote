<?php
/**
 * Fichier aspiré
 *
 * @author  Siwaÿll <sanath.labs@gmail.com>
 * @license CC by-nc http://creativecommons.org/licenses/by-nc/3.0/fr/
 */

namespace Siwayll\MollicutePlugins\File;

/**
 * Fichier aspiré
 *
 * @author  Siwaÿll <sanath.labs@gmail.com>
 * @license CC by-nc http://creativecommons.org/licenses/by-nc/3.0/fr/
 */
class File
{
    /**
     * Enregistre le chemin vers le dossier de travail
     *
     * @param string $dir Chemin
     *
     * @return void
     */
    public static function setWorkDir($dir)
    {
        self::$workDir = $dir;
    }

    /**
     * Gestion d'une nouvelle pagination
     *
     * @param int $id Identifiant de l'aspiration
     */
    public function __construct($workDir)
    {
        $this->workDir = $workDir;
    }

    /**
     *
     * @param string $content
     */
    public function write($content)
    {
        file_put_contents($this->getName(), $content);
    }

    /**
     *
     * @param string $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Change l'extension du fichier utilisé pour le
     *
     * @param string $ext Extension du fichier
     *
     * @return self
     */
    public function setExt($ext)
    {
        $this->ext = $ext;
        return $this;
    }

    /**
     * Renvois le nom du fichier
     *
     * @return string Chemin vers le fichier
     */
    public function getName()
    {
        $name = $this->workDir . DS . $this->id . '.' . $this->ext;

        $this->lastName = $name;

        return $name;
    }

    /**
     * Renvois le nom du dernier fichier utilisé
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }


    /**
     * Renvois le contenu du fichier
     *
     * @return string Contenu du fichier
     */
    public function get()
    {
        return file_get_contents($this->lastName);
    }

    /**
     * Remplace le contenu du fichier
     *
     * @param string $str contenu à mettre dans le fichier
     *
     * @return void
     */
    public function replace($str)
    {
        file_put_contents($this->lastName, $str);
    }

    /**
     * Supprime le fichier
     *
     * Si le mode groupe est activé, tous les fichiers du groupe seront
     * supprimés.
     *
     * @return void
     */
    public function remove()
    {
        if (file_exists($this->lastName)) {
            unlink($this->lastName);
        }
    }
}
