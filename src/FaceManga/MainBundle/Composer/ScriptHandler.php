<?php

namespace FaceManga\MainBundle\Composer;

use Composer\Script\CommandEvent;
use Sensio\Bundle\DistributionBundle\Composer\ScriptHandler as SensioHandler;

class ScriptHandler extends SensioHandler
{
    
    public static function updateSchema(CommandEvent $event)
    {
        $options = self::getOptions($event);
        $appDir = $options['symfony-app-dir'];

        if (!is_dir($appDir)) {
            echo 'The symfony-app-dir ('.$appDir.') specified in composer.json was not found in '.getcwd().', can not clear the cache.'.PHP_EOL;
            return;
        }

        static::executeCommand($event, $appDir, 'doctrine:schema:update --force', $options['process-timeout']);
    }
    
}