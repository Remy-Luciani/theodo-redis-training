<?php

namespace Theodo\Bundle\ScrumOrNotScrumBundle\Manager;

use Theodo\Bundle\ScrumOrNotScrumBundle\Entity\User;
use Theodo\Bundle\ScrumOrNotScrumBundle\Manager\UserManager;
use Theodo\Bundle\ScrumOrNotScrumBundle\Entity\ScrumQuiz;

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

    public function save(ScrumQuiz $quiz)
    {
        $uid = $this->userManager->saveByName($quiz->getAuthorName());

        $quizId = $this->redis->incr("global:nextQuizId");
        $quiz->setId($quizId);
        $this->redis->hmset("scrumQuiz:$quizId", $quiz->toArray());
        $this->redis->lpush("user:$uid:scrumQuizs", $quizId);
        $this->redis->lpush("global:scrumQuizs", $quizId);

        return $quizId;
    }

    public function findAll()
    {
        $quizIds = $this->redis->lrange("global:scrumQuizs", 0, -1);
        $scrumQuizs = array();

        foreach($quizIds as $id) {
            $scrumQuizs[$id] = $this->find($id);
        }

        return $scrumQuizs;
    }

    public function find($id)
    {
        $quizArray = $this->redis->hgetall("scrumQuiz:$id");
        $scrumQuiz = new ScrumQuiz();

        return $scrumQuiz->fromArray($quizArray);
    }

}

