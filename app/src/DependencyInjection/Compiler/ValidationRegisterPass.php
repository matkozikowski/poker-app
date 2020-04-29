<?php

namespace App\DependencyInjection\Compiler;

use App\Registry\ValidationRegistry;
use App\Validation\ValidationInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ValidationRegisterPass implements CompilerPassInterface
{
    private const TAG_NAME = 'validation.poker_game';

    public function process(ContainerBuilder $container): void
    {
        $handler = $container->findDefinition(ValidationRegistry::class);

        $taggedServices = $container->findTaggedServiceIds(self::TAG_NAME);

        foreach ($taggedServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $handler->addMethodCall('addService', array(new Reference($id), $attributes['priority']));
            }
        }
    }
}
