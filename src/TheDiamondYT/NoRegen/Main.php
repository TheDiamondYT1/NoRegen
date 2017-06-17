<?php

namespace TheDiamondYT\NoRegen;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onPlayerJoin(PlayerJoinEvent $ev) {
        $config = $this->getConfig()->getAll();
        
        if($config["message"]["show"]) {
            $ev->getPlayer()->sendMessage($config["message"]["text"]);
        }
    }
    
    public function onRegainHealth(EntityRegainHealthEvent $ev) {
        $block = $this->getConfig()->getAll()["block"];
        $reason = $ev->getRegainReason();
        
        if($block["regen"] && $reason === EntityRegainHealthEvent::CAUSE_REGEN) {
            $ev->setCancelled(true);
        }
        if($block["eating"] && $reason === EntityRegainHealthEvent::CAUSE_EATING) {
            $ev->setCancelled(true);
        }
        if($block["potion"] && $reason === EntityRegainHealthEvent::CAUSE_MAGIC) {
            $ev->setCancelled(true);
        }
        if($block["custom"] && $reason === EntityRegainHealthEvent::CAUSE_CUSTOM) {
            $ev->setCancelled(true);
        }
        if($block["saturation"] && $reason === EntityRegainHealthEvent::CAUSE_SATURATION) {
            $ev->setCancelled(true);
        }
    }
}
