<?php


namespace App\Controller\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class CustomAccessDeniedSubscriber implements EventSubscriberInterface
{
    use TargetPathTrait;

    public function onAccessDeniedException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        if ($exception instanceof AccessDeniedException || $exception instanceof AccessDeniedHttpException) {
            $response = new RedirectResponse('/');
            $event->setResponse($response);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onAccessDeniedException',
        ];
    }
}
