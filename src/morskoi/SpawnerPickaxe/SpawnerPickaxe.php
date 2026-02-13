<?php

namespace morskoi\SpawnerPickaxe;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use morskoi\SpawnerPickaxe\commands\SpawnerCommand;
use morskoi\SpawnerPickaxe\event\EventListener;

class SpawnerPickaxe extends PluginBase
{
    private Config $cfg;
    public function onEnable(): void 
    {
        $this->saveResource("config.yml");
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);

        $this->getServer()->getCommandMap()->register("spawner", new SpawnerCommand($this));

        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    }
    public function getConfig(): Config 
    {
        return $this->cfg;
    }
}