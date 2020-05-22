<?php

namespace App\EventListener;

use App\Entity\Badge;
use App\Event\AppEvents;
use App\Repository\BadgeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class BadgeListener implements EventSubscriberInterface
{
    const REGISTRATION_BADGE = 1;

    private $badgeRepository;
    private $entyManager;

    public static function getSubscribedEvents()
    {
        return [
            AppEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'
        ];
    }

    public function __construct(BadgeRepository $badgeRepository, EntityManagerInterface $entityManager)
    {
        $this->badgeRepository = $badgeRepository;
        $this->entityManager = $entityManager;
    }

    public function onRegistrationSuccess(GenericEvent $event)
    {
        $user = $event->getSubject();
        $badge = $this->badgeRepository->findOneById(self::REGISTRATION_BADGE);
        if (null !== $badge) {
            $user->addBadge($badge);
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
