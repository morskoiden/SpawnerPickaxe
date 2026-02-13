<?php

namespace morskoi\SpawnerPickaxe\commands;

use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\item\VanillaItems;
use morskoi\SpawnerPickaxe\MagicTools;
use Vecnavium\FormsUI\SimpleForm;

class SpanwerCommand extends Command
{
    private SpawnerPickaxe $plugin;

    public function __construct(SpawnerPickaxe $plugin)
    {
        parent::__construct("magictools", "magic menu");
        $this->setPermission("magictools.cmd");
        $this->plugin = $plugin;
    }
    public function execute(CommandSender $s, string $label, array $args)
    {
        if (!$s instanceof Player)
        {
            $s->sendMessage("Only in game");
            return;
        }
        $this->Form($s);
    }
    public function Form(Player $p): void
    {
        $form = new SimpleForm(function (Player $p, $data) {
            if ($data === null) return;
            if ($data === 0)
                {
                    $item = VanillaItems::NETHERITE_SWORD();
                    $name = $this->plugin->lang("sword-name");
                    $lore = $this->plugin->lang("sword-lore");
                    $item->setCustomName($name);
                    $item->setLore([$lore]);
                    $item->getNamedTag()->setString("magicsword", true);
                    $p->getInventory()->addItem($item);
                    $p->sendMessage($this->plugin->lang("sword-message"));
                }
            if ($data === 1)
                {
                    $item = VanillaItems::NETHERITE_PICKAXE();
                    $name = $this->plugin->lang("pickaxe-name");
                    $lore = $this->plugin->lang("pickaxe-lore");
                    $item->setCustomName($name);
                    $item->setLore([$lore]);
                    $item->getNamedTag()->setString("magicpickaxe", true);
                    $p->getInventory()->addItem($item);
                    $p->sendMessage($this->plugin->lang("pickaxe-message"));
                }
            if ($data === 2)
                {
                    $item = VanillaItems::NETHERITE_AXE();
                    $name = $this->plugin->lang("axe-name");
                    $lore = $this->plugin->lang("axe-lore");
                    $item->setCustomName($name);
                    $item->setLore([$lore]);
                    $item->getNamedTag()->setString("magicaxe", true);
                    $p->getInventory()->addItem($item);
                    $p->sendMessage($this->plugin->lang("axe-message"));
                }
            if ($data === 3)
                {
                    $item = VanillaItems::NETHERITE_SHOVEL();
                    $name = $this->plugin->lang("shovel-name");
                    $lore = $this->plugin->lang("shovel-lore");
                    $item->setCustomName($name);
                    $item->setLore([$lore]);
                    $item->getNamedTag()->setString("magicshovel", true);
                    $p->getInventory()->addItem($item);
                    $p->sendMessage($this->plugin->lang("shovel-message"));
                }
        });
        $form->setTitle($this->plugin->lang("form-title"));
        $form->setContent($this->plugin->lang("form-content"));
        $form->addButton($this->plugin->lang("form-button-sword"), 0, "textures/items/netherite_sword");
        $form->addButton($this->plugin->lang("form-button-pickaxe"), 0, "textures/items/netherite_pickaxe");
        $form->addButton($this->plugin->lang("form-button-axe"), 0, "textures/items/netherite_axe");
        $form->addButton($this->plugin->lang("form-button-shovel"), 0, "textures/items/netherite_shovel");
        $p->sendForm($form);
    }
}