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
        $uid = $this->redis->incr('global:nextUid');

        $name = $user->getName();

        $this->redis->set("user:$uid:name", $name);
        $this->redis->set("username:$name:uid", $uid);
    }
}
