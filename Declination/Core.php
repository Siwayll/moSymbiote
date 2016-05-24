<?php
/**
 * Mycoplasma
 *
 * @author  Siwaÿll <sanath.labs@gmail.com>
 * @license CC by-nc http://creativecommons.org/licenses/by-nc/3.0/fr/
 */

namespace Siwayll\MoSymbiote\Declination;

use \Siwayll\Mollicute\Command;
use \Siwayll\Mollicute\Core as Mollicute;

/**
 * Déclinaison
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
    }

    /**
     * Chargement des variations de la commande
     *
     * @param Command   $cmd     Commande en cours
     * @param string    $content Resultat de l'aspiration
     * @param Mollicute $moll    Plan d'aspiration
     *
     * @return array
     * @throws \Siwayll\Mollicute\Abort si un plan est chargé
     */
    public function before(Command $cmd, $content, Mollicute $moll)
    {
        if ($cmd->declination !== true) {
            return;
        }

        if (!preg_match('#\[([a-z0-9]+)\]#', $cmd->getUrl(), $matches)) {
            return;
        }

        $tag = '[' . $matches[1] . ']';

        foreach ($cmd->getDeclination($matches[1]) as $data) {
            $result = clone $cmd;
            if (is_array($data)) {
                $result->set('declinationData', $data);
                $data = $data[0];
            }
            if (is_object($data)) {
                $result->set('declinationData', $data);
            }
            $url = str_replace($tag, $data, $cmd->getUrl());
            $result->setUrl($url);

            if ($result->hasMethod('getFileName') && strpos($result->getFileName(), $tag) !== false) {
                $newName = str_replace($tag, $data, $result->getFileName());
                $result->setFileName($newName);
                unset($newName);
            }

            $moll->add($result);
        }

        throw new \Siwayll\Mollicute\Abort('cancel');
    }
}
