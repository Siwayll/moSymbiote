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
use \Siwayll\Deuton\Display;

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
        $line = "\r";
        $line .= str_pad($this->countPlan, 6);
        $line .= $this->curl->getOpt(CURLOPT_URL) . '  ';
        $value = '{.c:red}wait...{.reset}';
        if ($downloadSize > 0) {
            $percent = $downloaded / $downloadSize  * 100;
            $value = number_format($percent, 2, '.', ' ') . '%';
            $value = str_pad($value, 10);
            if ($downloaded > 0) {
                $value = '{.c:green}' . $value . '{.reset}';
            } else {
                $value = '{.c:yellow}' . $value . '{.reset}';
            }
        }
        if ($downloaded > 0) {
            $value = number_format($downloaded, 0, '.', ' ');
            $value = str_pad($value, 10);
            $value = '{.c:green}' . $value . '{.reset}';
        }
        $line .= $value;
        Display::write($line);
    }

    /**
     * Préparation à l'affichage de la progression
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

    /**
     * Ecriture du resultat de l'aspiration dans un fichier
     *
     * @param Command   $cmd     Commande en cours
     * @param Mollicute $moll    Plan d'aspiration
     *
     * @return array
     */
    public function before(Command $cmd, Mollicute $moll)
    {
        $this->countPlan = $moll->countPlan();
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
        $color = 'green';
        if (curl_error($this->curl->get()) !== '') {
            $color = 'red';
        }
        $line = "\r{.c:" . $color . '}'
              . $this->curl->getOpt(CURLOPT_URL)
              . '                         {.reset}'
        ;

        Display::line($line);
    }
}
