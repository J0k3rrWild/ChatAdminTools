<?php

declare(strict_types=1);

namespace J0k3rrWild\ChatAdminTools;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\command\Command;



final class Main extends PluginBase implements Listener{

    public function onEnable() : void{
        
        $server = $this->getServer();
        $server->getCommandMap()->register("ca", new Ca($this));
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(TF::GREEN."[ChatAdminTools] > Plugin załadowany pomyślnie");

    }

   

    function onPlayerChat(PlayerChatEvent $event){
        $this->reloadConfig();
        $config = $this->getConfig();
        $event->getPlayer();
        $player = $event->getPlayer();
        if($config->get("chat-mute-status") == "off"){
            if(!$player->hasPermission("chatadmintools.bypass") || !$player->hasPermission("chatadmintools")){
            $player->sendMessage(TF::RED.$config->get("chat-mute-active-message"));
            $event->setCancelled();
            }
        }else{
            return true;
        } 
    }
    

}
