<?php

namespace Theodo\Bundle\ScrumOrNotScrumBundle\Manager;

use Theodo\Bundle\ScrumOrNotScrumBundle\Entity\User;

use Predis\Client as Redis;

class UserManager
{
    /**
     * @var Redis
     */
    private $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    public function register(User $user)
    {
        $name = $user->getName();

        if (!$this->findByName($name)) {
            $uid = $this->redis->incr('global:nextUid');
            $this->redis->set("user:$uid:name", $name);
            $this->redis->set("username:$name:uid", $uid);
        }

        $uid = $this->redis->get("global:nextUid");

        return $uid;
    }

    public function saveByName($name)
    {
        $user = new User();
        $user->setName($name);

        return $this->register($user);
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
