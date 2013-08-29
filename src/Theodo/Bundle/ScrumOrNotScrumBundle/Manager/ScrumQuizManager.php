<?php

namespace Theodo\Bundle\ScrumOrNotScrumBundle\Manager;

use Theodo\Bundle\ScrumOrNotScrumBundle\Entity\User;
use Theodo\Bundle\ScrumOrNotScrumBundle\Manager\UserManager;

use Predis\Client as Redis;

class ScrumQuizManager
{
    /**
     * @var Redis
     */
    private $redis;

    /**
     * @var UserManager
     */
    private $userManager;

    public function __construct(Redis $redis, UserManager $userManager)
    {
        $this->redis = $redis;
        $this->userManager = $userManager;
    }

    public function register(User $user)
    {
        $name = $user->getName();

        if (!$this->findByName($name)) {
            $uid = $this->redis->incr('global:nextUid');
            $this->redis->set("user:$uid:name", $name);
            $this->redis->set("username:$name:uid", $uid);
        }
    }

    public function find($uid)
    {
        $user = new User();
        $user->setId($uid);
        $user->setName($this->redis->get("user:$uid:name"));

        return $user;
    }

    public function findByName($name)
    {
        $uid = $this->redis->get("username:$name:uid");

        if (null != $uid) {
            $user = new User();
            $user->setName($name);
            $user->setId($uid);
        } else {
            $user = null;
        }

        return $user;
    }
}