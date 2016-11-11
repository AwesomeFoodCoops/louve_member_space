<?php

/**
 * Class ShiftController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;


class ShiftController
{
    // Page d'affichage des shifts volants
    public function ftopShifts()
    {
        require APP . 'view/_templates/header.php';
        require APP . 'view/view/shift/ftop.php';
        require APP . 'view/_templates/footer.php';
    }
}
