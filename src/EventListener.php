<?php

namespace pixelwhiz\animalcoins;

use onebone\economyapi\EconomyAPI;
use pocketmine\block\VanillaBlocks;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\player\Player;

class EventListener implements Listener {

    public function onUse(PlayerItemUseEvent $event){
        $player = $event->getPlayer();
        $item = $player->getInventory()->getItemInHand();

        if (!AnimalCoins::getInstance()->config->get("Rewards")["enable"]) return false;

        if ($item->getCustomName() === AnimalCoins::getInstance()->config->get("Coins")["name"]){
            $count = $item->getCount();
            $money = mt_rand(AnimalCoins::getInstance()->config->get("Rewards")["min-money"], AnimalCoins::getInstance()->config->get("Rewards")["max-money"]);
            $item->setCount($count - $item->getCount());
            $total = $money * $count;
            $message = str_replace("{REWARDS}", "$".number_format($total), AnimalCoins::getInstance()->config->get("Rewards")["message"]);
            $player->sendMessage($message);
            EconomyAPI::getInstance()->addMoney($player, $total);
            $player->getInventory()->setItemInHand($item);
        }
    }

    public function onDeath(EntityDeathEvent $event){
        $entity = $event->getEntity();
        $drops = $event->getDrops();
        if($entity instanceof Player) return false;
        $item = VanillaBlocks::SUNFLOWER()->asItem();
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