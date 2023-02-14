<?php

namespace dpgenx\animalcoins;

use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\ItemFactory;
use pocketmine\player\Player;

class EventListener implements Listener {

    public function getPlugin() : AnimalCoins {
        return AnimalCoins::getInstance();
    }

    public function onUse(PlayerItemUseEvent $event){
        $player = $event->getPlayer();
        $item = $player->getInventory()->getItemInHand();

        if(!AnimalCoins::getInstance()->config->get("Rewards")["enable"] == true) return false;

        if($item->getCustomName() == AnimalCoins::getInstance()->config->get("Coins")["name"]){
            $count = $item->getCount();
            $money = mt_rand(AnimalCoins::getInstance()->config->get("Rewards")["min-money"], AnimalCoins::getInstance()->config->get("Rewards")["max-money"]);
            $item->setCount($count - $item->getCount());
            $total = $money * $count;
            $player->sendMessage("Earned $ ".number_format($total)." from Animal Coins");
            $this->economy = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("EconomyAPI");
            $this->economy->addMoney($player, $total);
            $player->getInventory()->setItemInHand($item);
        }
    }

    public function onDeath(EntityDeathEvent $event){
        $entity = $event->getEntity();
        $drops = $event->getDrops();
        if($entity instanceof Player) return false;
        $item = ItemFactory::getInstance()->get(175, 0, 1);
        $item->setCustomName(AnimalCoins::getInstance()->config->get("Coins")["name"]);
        $item->setLore([
            "Click to Redeem"
        ]);
        $ench = EnchantmentIdMap::getInstance()->fromId(1);
        $item->addEnchantment(new EnchantmentInstance($ench, 1));
        $a = mt_rand(1, 3);
        array_push($drops, $item);
        switch ($a){
            case 1:
                $event->setDrops($drops);
                break;
            case 2:
                break;
            case 3:
                break;
        }
    }

}