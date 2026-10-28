<?php

declare(strict_types=1);

namespace WonderWp\Component\PluginSkeleton {
    if (!interface_exists(ManagerInterface::class, false)) {
        interface ManagerInterface
        {
        }
    }

    if (!interface_exists(ManagerAwareInterface::class, false)) {
        interface ManagerAwareInterface
        {
            public function getManager(): ManagerInterface;

            public function setManager(ManagerInterface $manager): static;
        }
    }

    if (!trait_exists(ManagerAwareTrait::class, false)) {
        trait ManagerAwareTrait
        {
            protected $manager;

            public function getManager(): ManagerInterface
            {
                return $this->manager;
            }

            public function setManager(ManagerInterface $manager): static
            {
                $this->manager = $manager;

                return $this;
            }
        }
    }
}

namespace WonderWp\Component\PluginSkeleton\Service {
    if (!interface_exists(RegistrableInterface::class, false)) {
        interface RegistrableInterface
        {
            public function register();
        }
    }
}

namespace WonderWp\Component\Service {
    if (!interface_exists(ServiceInterface::class, false)) {
        interface ServiceInterface
        {
        }
    }

    if (!class_exists(AbstractService::class, false)) {
        abstract class AbstractService implements ServiceInterface
        {
            use \WonderWp\Component\PluginSkeleton\ManagerAwareTrait;

            public function __construct($manager = null)
            {
                $this->manager = $manager;
            }
        }
    }
}

namespace WonderWp\Component\Service\Traits {
    if (!trait_exists(HasAutoloadingCapabilities::class, false)) {
        trait HasAutoloadingCapabilities
        {
            protected function resolveDiscoveryPaths(array $discoveryPaths = []): array
            {
                return $discoveryPaths;
            }

            protected function deductDefaultDiscoveryPaths(array $roots, string $suffix): array
            {
                return [];
            }
        }
    }
}

namespace WonderWp\Component\Response {
    if (!interface_exists(ResponseInterface::class, false)) {
        interface ResponseInterface
        {
            public function getCode(): int;

            public function setError(?\Throwable $error): static;

            public function getError(): ?\Throwable;
        }
    }

    if (!class_exists(AbstractResponse::class, false)) {
        abstract class AbstractResponse implements ResponseInterface
        {
            protected int $code;
            protected string $msgKey;
            protected string $textDomain = '';
            protected ?\Throwable $error = null;

            public function __construct(int $code = 0, string $msgKey = '', string $textDomain = '')
            {
                $this->code = $code;
                $this->msgKey = $msgKey;
                $this->textDomain = $textDomain;
            }

            public function getCode(): int
            {
                return $this->code;
            }

            public function getMsgKey(): string
            {
                return $this->msgKey;
            }

            public function setError(?\Throwable $error): static
            {
                $this->error = $error;

                return $this;
            }

            public function getError(): ?\Throwable
            {
                return $this->error;
            }
        }
    }
}
