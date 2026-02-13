<?php

namespace morskoi\SpawnerPickaxe\event;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\item\ItemTypeIds;
use morskoi\SpawnerPickaxe\SpawnerPickaxe;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\VanillaItems;

class EventListener implements Listener
{
    private SpawnerPickaxe $plugin;
    public function __construct(SpawnerPickaxe $plugin)
    {
        $this->plugin = $plugin;
    }
    public function Pickaxe(BlockBreakEvent $e)
    {
        $p = $e->getPlayer();
        $item = $e->getItem();
        $nametag = $item->getNamedTag()->getTag("spawnerpickaxe");
        $b = $e->getBlock();
        if ($nametag !== null)
            {
                $item->setDamage($item->getMaxDurability());
                $item->setCount(0);
                $p->getInventory()->setItemInHand($item);
                $chance = mt_rand(1, 100);
                if ($chance <= $this->plugin->getConfig()->get("chance", "50"))
                    {
                        if ($b->getTypeId() === VanillaBlocks::MONSTER_SPAWNER()->getTypeId())
                            {
                                $e->setDrops([VanillaBlocks::MONSTER_SPAWNER()->asItem()]);
                            }
                    }
        }
    }
}