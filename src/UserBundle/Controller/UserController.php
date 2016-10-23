<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use UserBundle\Entity\User;

class UserController extends Controller
{

    public function getUsersAction(Request $request)
    {
        $users = $this->get('doctrine.orm.entity_manager')->getRepository('UserBundle:User')->findAll();
        $formatted = [];
        foreach ($users as $user){
            $formatted[] = [
                'id'=> $user->getId(),
                'firstname' => $user->getFirstname(),
                'lastname'=>$user->getLastname(),
                'email'=>$user->getEmail(),
                'pseudo'=>$user->getPseudo(),
            ];
        }
        return new JsonResponse($formatted);
    }

    public function getUserAction($id,Request $request){
        $user = $this->get('doctrine.orm.entity_manager')->getRepository('UserBundle:User')->find($id);
        $formatted = [
            'id'=>$user->getId(),
            'lastname'=>$user->getLastname(),
            'firstname'=>$user->getFirstname(),
            'email'=>$user->getEmail(),
            'pseudo'=>$user->getPseudo(),
        ];

        return new JsonResponse($formatted);
    }
}
