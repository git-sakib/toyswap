<?php

// src/AppBundle/Controller/LoginController.php
namespace AppBundle\Controller;

// ...
use AppBundle\Form\UserForm;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {

		// get the login error if there is one
	    $error = $authUtils->getLastAuthenticationError();

	    // last username entered by the user
	    $lastUsername = $authUtils->getLastUsername();

	    return $this->render('user/login.html.twig', array(
	        'last_username' => $lastUsername,
	        'error'         => $error,
	    ));

    }

	/**
	 * @Route("/logout", name="logout")
	 * @Method({"GET"})
	 */
	public function logoutAction(Request $request)
	{
	    //$session = $this->$request->getSession();
	    $session = $this->get('session')->clear();
	    return $this->redirectToRoute('login');
	}

}