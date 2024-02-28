// src/EventSubscriber/SessionSubscriber.php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionSubscriber implements EventSubscriberInterface
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        // Démarrage de la session Symfony à chaque requête
        $this->session->start();
    }

    public static function getSubscribedEvents()
    {
        // Définis l'événement kernel.request et la méthode à appeler (onKernelRequest)
        return [
            'kernel.request' => 'onKernelRequest',
        ];
    }
}
