<?php

namespace designpatterns;

use SplObserver;
use SplSubject;

/**
 * O observer é um design pattern de pub-sub, onde um objeto (o sujeito)
 * mantém uma lista de dependências (os observadores) e os notifica automaticamente sobre qualquer mudança de estado,
 * geralmente chamando um método em cada um dos observadores.
 */
class ObserverA implements \SplObserver
{
    public function update(SplSubject $subject): void
    {
        echo 'Observer A' . PHP_EOL;
    }
}

class ObserverB implements \SplObserver
{
    public function update(SplSubject $subject): void
    {
        echo 'Observer B' . PHP_EOL;
    }
}

class MeuSubject implements SplSubject
{
    public function __construct(
        protected string $eventoQueEstouInteressado,
        protected \SplObjectStorage $observers = new \SplObjectStorage()
    )
    {
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

$meuSubject = new MeuSubject('user.created');

$meuSubject->attach(new ObserverA());
$meuSubject->attach(new ObserverB());

$meuSubject->notify();