<?php

declare(strict_types=1);

namespace pixelwhiz\animalcoins;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class AnimalCoins extends PluginBase {

    public static $instance;
    public Config $config;

    public function onEnable(): void
    {
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->saveDefaultConfig();
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml");
    }

    public static function getInstance(): AnimalCoins {
        return self::$instance;
    }

}
