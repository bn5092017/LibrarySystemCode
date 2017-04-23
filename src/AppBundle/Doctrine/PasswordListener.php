<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 17/04/17
 * Time: 11:04
 */

namespace AppBundle\Doctrine;


use AppBundle\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class PasswordListener implements EventSubscriber
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoder $passwordEncoder)
    {
        //uses the UserPasswordEncoder class to encode user passwords
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        // call functions that will access information from Doctrine generated arrays prior to updating the database
        return ['prePersist', 'preUpdate'];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        //Doctrine service that connects to the entity being accessed in the function being called
        $entity = $args->getEntity();

        //check if the persist relates to an instance of the User class, if not then do nothing
        if (!$entity instanceof User) {
            return;
        }

        //call the private function to encode the password, saves re-typing for the other method
        $this->encodePassword($entity);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        //Doctrine service that connects to the entity being accessed in the function being called
        $entity = $args->getEntity();

        //check if the persist relates to an instance of the User class, if not then do nothing
        if (!$entity instanceof User) {
            return;
        }

        //call the private function to encode the password, saves re-typing for the other method
        $this->encodePassword($entity);

        //use the Doctrine EntityManager to take the information input to be changed and compose it
        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }

    private function encodePassword(User $entity)
    {
        //if no call to the getPlainPassword method because no change has been made to this field
        //return without doing anything so as not to encode a blank field causing future password errors
        if(!$entity->getPlainPassword()){
            return;
        }

        //use the UserPasswordEncoder class method encodePassword to create an encoded version
        //of the plainPassword for the User entity
        $encoded = $this->passwordEncoder->encodePassword(
            $entity,
            $entity->getPlainPassword()
        );

        //sets the encoded password as the password to be saved in the database table
        $entity->setPassword($encoded);
    }
}