<?php
/**
 * Created by PhpStorm.
 * User: Dejora
 * Date: 09/02/2017
 * Time: 22:50
 */

namespace Louve\Model;


class Statecooperative
{
    /**
     *  class
     *  @var string
     */
    protected $class;

    /**
     *  alertmsg
     *  @var string
     */
    protected $alertmsg;

    /**
     *  fullmsg
     *  @var
     */
    protected $fullmsg;

    /**
     *
     */
    const STATE_WARNING = '';

    /**
     *
     */
    const STATE_UP_TO_DATE = 'up_to_date';

    /**
     *
     */
    const STATE_ALERT = 'alert';

    /**
     *
     */
    const STATE_SUSPENDED = 'suspended';

    /**
     * 
     */
    const STATE_DELAY = 'delay';

    /**
     *
     */
    const STATE_UNPAYED = 'unpayed';

    /**
     *
     */
    const STATE_BLOCKED = 'blocked';

    /**
     *
     */
    const STATE_UNSUSCRIBED = 'unsuscribed';

    public function __construct($state)
    {
        switch ($state) {
            default: //STATE_WARNING
                    $class = 'alert-warning';
                    $alertmsg = 'Erreur';
                    $fullmsg = 'Un problème technique nous empêche actuellement de connaitre votre status. Réessayez plus tard ou contactez le bureau des membres.';
                break;
            case self::STATE_UP_TO_DATE:
                    $class = 'alert-success';
                    $alertmsg = 'Bravo!';
                    $fullmsg = 'Vous êtes à jour';
                break;
            case self::STATE_ALERT:
                    $class = 'alert-warning';
                    $alertmsg = 'Attention';
                    $fullmsg = 'Vous avez des services en retard';
                break;
            case self::STATE_SUSPENDED:
                    $class = 'alert-danger';
                    $alertmsg = 'Alerte';
                    $fullmsg = 'Vous avez été suspendu, merci de contacter le bureau des membres';
                break;
            case self::STATE_DELAY:
                    $class = 'alert-danger';
                    $alertmsg = 'Alerte';
                    $fullmsg = 'Votre participation est temportairement gelée';
                break;
            case self::STATE_UNPAYED:
                    $class = 'alert-danger';
                    $alertmsg = 'Alerte';
                    $fullmsg = 'Vous avez un paiement en retard, vous êtes momentanément suspendu, merci de contacter le bureau des membres.';
                break;
            case self::STATE_BLOCKED:
                    $class = 'alert-danger';
                    $alertmsg = 'Alerte';
                    $fullmsg = 'Vous avez été bloqué, merci de contacter le bureau des membres.';
                break;
            case self::STATE_UNSUSCRIBED:
                    $class = 'alert-danger';
                    $alertmsg = 'Alerte';
                    $fullmsg = 'Vous avez été désinscrit, merci de contacter le bureau des membres.';
                break;
        }
        $this->setClass($class)
            ->setAlertsg($alertmsg)
            ->setFullmsg($fullmsg);
    }

    /**
     *  getClass
     *  @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     *  setClass
     *  @param $class
     *  @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     *  getAlertsg
     *  @return string
     */
    public function getAlertsg()
    {
        return $this->alertmsg;
    }

    /**
     *  setAlertsg
     *  @param $alertmsg
     *  @return $this
     */
    public function setAlertsg($alertmsg)
    {
        $this->class = $alertmsg;
        return $this;
    }

    /**
     *  getFullmsg
     *  @return string
     */
    public function getFullmsg()
    {
        return $this->fullmsg;
    }

    /**
     *  setFullmsg
     *  @param $fullmsg
     *  @return $this
     */
    public function setFullmsg($fullmsg)
    {
        $this->fullmsg = $fullmsg;
        return $this;
    }
}