<?php
/**
 * Mycoplasma
 *
 * @author  Siwaÿll <sanath.labs@gmail.com>
 * @license CC by-nc http://creativecommons.org/licenses/by-nc/3.0/fr/
 */

namespace Siwayll\MoSymbiote\Progress;

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
    private $init = false;

    private $curl;

    /**
     * Initialisation du plugin
     */
    public function __construct()
    {
    }

    /**
     * Affichage de l'avancement de l'aspiration
     *
     * @param boolean $value activation oui / non
     *
     * @return self
     */
    public function progress($resource, $downloadSize, $downloaded, $uploadSize, $uploaded)
    {
        echo "\r" . $this->curl->getOpt(CURLOPT_URL) . '  ';
        if ($downloadSize > 0) {
            $percent = $downloaded / $downloadSize  * 100;
            echo str_pad(number_format($percent, 2, '.', ' '), 7);
            return;
        }
        if ($downloaded > 0) {
            echo str_pad(number_format($downloaded, 0, '.', ' '), 7);
            return;
        }

        echo 'wait...';
    }

    /**
     * Ecriture du resultat de l'aspiration dans un fichier
     *
     * @param Mollicute $moll    Plan d'aspiration
     *
     * @return array
     */
    public function init(Mollicute $moll)
    {
        if ($this->init !== false) {
            return;
        }
        $this->init = true;

        if (!defined('MOLLICUTE_PROGRESS_DISPLAY') || MOLLICUTE_PROGRESS_DISPLAY == false) {
            return;
        }

        $this->curl = $moll->getCurl();

        $this->curl
            ->setFinalOpt(CURLOPT_NOPROGRESS, false)
            ->setFinalOpt(CURLOPT_PROGRESSFUNCTION, [$this, 'progress'])
        ;
    }
}
