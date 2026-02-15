<?php

namespace morskoi\SpawnerPickaxe\commands;

use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\item\StringToItemParser;
use morskoi\SpawnerPickaxe\SpawnerPickaxe;

class SpawnerCommand extends Command
{
    private SpawnerPickaxe $plugin;

    public function __construct(SpawnerPickaxe $plugin)
    {
        parent::__construct("spawnerpickaxe", "give spawner pickaxe", null, ["spp"]);
        $this->setPermission("spawner.pickaxe.cmd");
        $this->plugin = $plugin;
    }
    public function execute(CommandSender $s, string $label, array $args)
    {
        if (!$s instanceof Player)
        {
            $s->sendMessage("Only in game");
            return;
        }
        $item = StringToItemParser::getInstance()->parse($this->plugin->getConfig()->get("material", "GOLDEN_PICKAXE"));
        $name = $this->plugin->getConfig()->get("name", "§e⛏️ Spawner Pickaxe ⛏️");
        $lore = $this->plugin->getConfig()->get("lore", "§7[ §6Breaks the §lspawner§r§6 and there is a §c50% chance §6it will drop.§r§7 ]");
        $item->setCustomName($name);
        $item->setLore([$lore]);
        $item->getNamedTag()->setString("spawnerpickaxe", "true");
        $s->getInventory()->addItem($item);
        $s->sendMessage($this->plugin->getConfig()->get("message", "§fYou received a pickaxe that breaks spawners with a 50% chance."));
    }

}
