<?php

declare(strict_types = 1);

namespace Jarvis\Skill\Console;

use Jarvis\Jarvis;

/**
 * @author Eric Chau <eriic.chau@gmail.com>
 */
abstract class AbstractCommandHandler
{
    /**
     * @var Jarvis
     */
    protected $app;

    public function __construct(Jarvis $app)
    {
        $this->app = $app;
    }
}
