<?php
namespace App\EventSubscriber;

use App\Repository\ContactMessageRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class UnreadMessageSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $repo;

    public function __construct(Environment $twig, ContactMessageRepository $repo)
    {
        $this->twig = $twig;
        $this->repo = $repo;
    }

    public function onControllerEvent(ControllerEvent $event)
    {
        $unreadCount = $this->repo->countUnread();
        $lastUnread = $this->repo->findLastUnread();

        $this->twig->addGlobal('unreadCount', $unreadCount);
        $this->twig->addGlobal('unreadMessages', $lastUnread);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onControllerEvent',
        ];
    }
}
