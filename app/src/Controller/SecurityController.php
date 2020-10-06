<?php


namespace App\Controller;


use ApiPlatform\Core\Api\IriConverterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login_user", methods={"POST"})
     * @param IriConverterInterface $iriConverter
     * @return Response
     */
    public function login(IriConverterInterface $iriConverter){
        if($this->isGranted("IS_AUTHENTICATED_FULLY")){
            return $this->json([
                'error' => 'Invalid login request: check that the Content-Type header is "application/json".'
            ], 400);
        }

        return new Response(
            null,
            204,[
                'Location' => $iriConverter->getIriFromItem($this->getUser())
            ]
        );
    }

    public function logout(){

    }
}