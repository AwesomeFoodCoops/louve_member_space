<?php
namespace Louve\Model;

/**
 *  Session
 */
class Session
{
    /**
     *  serializedUser
     *  @var bool
     */
    protected $serializedUser = false;

    /**
     *  Session constructor.
     */
    public function __construct()
    {
        if (isset($_SESSION['SerializedUser']) && $_SESSION['SerializedUser'] != '') {
            $this->serializedUser = $_SESSION['SerializedUser'];
        }

        // TODO_NOW: à mettre ailleurs et pas en dur ! => et calculer au début ici
        //$emergency = new Emergency();
       // $GLOBALS['hasEmergency'] = $emergency->isActive();

    }

    /**
     *  Deprecated !!
     *  @return bool
     */
    public function getUser()
    {
        return $this->serializedUser;
    }

    /**
     *  getSerializedUser
     *  @return JSON
     */
    public function getSerializedUser()
    {
        return $this->serializedUser;
    }

    /**
 *  @param $user
 *  @return User
 */
    public function setUser(User $user)
    {
        $this->serializedUser = $_SESSION['SerializedUser'] = serialize($user);
        return $this;
    }

    /**
     *  @param $user
     *  @return User
     */
    public function setSerializedUser(User $user)
    {
        $this->serializedUser = $_SESSION['SerializedUser'] = serialize($user);
        return $this;
    }
    /**
     *  isLogged
     *  @return bool
     */
    public function isLogged()
    {
        return !$this->serializedUser ? false : true;
    }
}

