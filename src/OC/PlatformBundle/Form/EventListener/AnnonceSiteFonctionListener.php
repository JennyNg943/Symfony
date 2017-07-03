<?php
namespace OC\PlatformBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class AnnonceSiteFonctionListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::PRE_SUBMIT   => 'onPreSubmit',
        );
    }

    public function onPreSetData(FormEvent $event)
    {
        $user = $event->getData();
        $form = $event->getForm();

        // Check whether the user from the initial data has chosen to
        // display his email or not.
        if (true === $user->isShowEmail()) {
            $form->add('email', EmailType::class);
        }
    }

    public function onPreSubmit(FormEvent $event)
    {
        $user = $event->getData();
        $form = $event->getForm();

        if (!$user) {
            return;
        }

        // Check whether the user has chosen to display his email or not.
        // If the data was submitted previously, the additional value that
        // is included in the request variables needs to be removed.
        if (true === $user['show_email']) {
            $form->add('email', EmailType::class);
        } else {
            unset($user['email']);
            $event->setData($user);
        }
    }
}
?>