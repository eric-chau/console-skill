<?php

declare(strict_types = 1);

namespace Jarvis\Skill\Console;

use Jarvis\Jarvis;
use Webmozart\Console\Api\Event\ConsoleEvents;
use Webmozart\Console\Api\Event\PreHandleEvent;
use Webmozart\Console\Config\DefaultApplicationConfig;

/**
 * @author Eric Chau <eriic.chau@gmail.com>
 */
abstract class AbstractApplicationConfig extends DefaultApplicationConfig
{
    /**
     * @var Jarvis
     */
    protected $app;

    /**
     * @var array
     */
    protected $settings;

    public function __construct(array $settings, $name = null, $version = null)
    {
        parent::__construct($name, $version);

        $this->settings = $settings;
    }

    public function initApplication(PreHandleEvent $event)
    {
        if (null !== $this->app) {
            return;
        }

        try {
            $this->app = new Jarvis($this->settings);
        } catch (\Exception $e) {
            $event->getIO()->writeLine("<error>{$e->getMessage()}</error>");

            exit(1);
        }
    }

    protected function configure()
    {
        parent::configure();

        $this->addEventListener(ConsoleEvents::PRE_HANDLE, [$this, 'initApplication']);
    }
}
