<?php

namespace designpatterns;

interface DecoratorInterface
{
    public function action(string $value): void;
}

class Agent implements DecoratorInterface
{
    public function action(string $value): void
    {
        echo $value . PHP_EOL;
    }
}

// Pattern proxy
class AgentDecorator implements DecoratorInterface
{
    public function __construct(protected DecoratorInterface $decorated)
    {}

    public function action(string $value): void
    {
        echo 'Decorator executado antes' . PHP_EOL;

        $this->decorated->action($value);

        echo 'By nextGen - Decorated' . PHP_EOL;
    }
}

// Setup do projeto, fica no container DI (Dependency Injection)
$decorated = new Agent();
$agent = new AgentDecorator($decorated);

// Uso do projeto, fica na camada de aplicação
$agent->action('Hello World!');
