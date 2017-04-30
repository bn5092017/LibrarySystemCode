<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 15/04/17
 * Time: 22:27
 */

namespace AppBundle\Security;


use AppBundle\Form\LoginForm;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;//class to redirect user after login
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;



//extends a class with login methods that also extends other classes AbstractGuardAuthenticator and GuardAuthenticatorInterface
class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    private $em;
    private $router;
    private $passwordEncoder;

    public function __construct(FormFactoryInterface $formFactory, EntityManager $em, RouterInterface $router, UserPasswordEncoder $passwordEncoder)
    {
        //use a form building service to construct a form
        $this->formFactory = $formFactory;
        //uses the Doctrine EntityManager to connect to the database
        $this->em = $em;
        //uses the RouterInterface to create a route
        $this->router = $router;
        //use a password encoding service to encrypt the password
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getCredentials(Request $request)
    {
        //check if the page is the login page and has any data been submitted
        $isLoginSubmit = $request->getPathInfo() == '/login' && $request->isMethod('POST');

        //skip authentication if not a user login attempt
        if(!$isLoginSubmit){
            return;
        }

        //use the form building service to build the login form
        $form = $this->formFactory->create(LoginForm::class);
        $form->handleRequest($request);

        //get the data from the form and return it
        $data = $form->getData();
        //tells the SecurityController where to get the username to pre-fill the login form on error
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['_username']
        );

        return $data;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        //take the username from the data returned by getCredentials
        $username = $credentials['_username'];

        //check the database for a username that matches
        return $this->em->getRepository('AppBundle:User')
            ->findOneBy(['username' => $username]);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        //take the password from the data returned by getCredentials
        $password = $credentials['_password'];
        if($this->passwordEncoder->isPasswordValid($user, $password)){
            return true;
        }

        return false;
    }

    protected function getLoginUrl()
    {
        //redirects to the login page if login is unsuccessful
        return $this->router->generate('login');
    }

    //use TargetPathTrait;
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        //this function redirects a user to the page they were on when they had to login for access
       // $targetPath = $this->getTargetPath($request->getSession(), $providerKey);
        //default is to send to the homepage
        //if(!$targetPath) {
            //$targetPath = $this->router->generate('');
        //}
        return $this->router->generate('my_loans');
    }
}