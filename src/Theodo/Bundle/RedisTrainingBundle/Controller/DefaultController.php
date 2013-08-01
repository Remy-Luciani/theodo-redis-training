<?php

namespace Theodo\Bundle\RedisTrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {	
	$redis = $this->get('snc_redis.default');
	$redis->append('names', $name . ", ");
        $names = $redis->get('names');

        return array('names' => $names);
    }
}
