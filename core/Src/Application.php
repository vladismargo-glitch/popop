<?php
namespace Src;

use Error;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Database\Capsule\Manager as Capsule;

class Application
{
    private Settings $settings;
    private Route $route;
    private Capsule $dbManager;

    // ЗАМЕНЯЕМ старый конструктор на этот:
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
        // Теперь передаем префикс сразу в конструктор Route
        $this->route = new Route($this->settings->getRootPath());
        $this->dbManager = new Capsule();
    }

    // ЗАМЕНЯЕМ старый __get на этот (с поддержкой 'route'):
    public function __get($key)
    {
        switch ($key) {
            case 'settings':
                return $this->settings;
            case 'route':
                return $this->route;
            default:
                throw new Error('Accessing a non-existent property');
        }
    }

    private function dbRun()
    {
        $this->dbManager->addConnection($this->settings->getDbSetting());
        $this->dbManager->setEventDispatcher(new Dispatcher(new Container));
        $this->dbManager->setAsGlobal();
        $this->dbManager->bootEloquent();
    }

    public function run(): void
    {
        $this->dbRun();
        $this->route->start();
    }
}
