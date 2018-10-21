<?php

namespace Softspring\GcloudIntegrationBundle\EventListener;

use Google\Cloud\ErrorReporting\Bootstrap;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => [['onKernelException',0]]
        ];
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        Bootstrap::exceptionHandler($event->getException());
    }
}