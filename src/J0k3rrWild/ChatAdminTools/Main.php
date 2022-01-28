<?php

declare(strict_types=1);

namespace J0k3rrWild\ChatAdminTools;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\command\Command;


class Main extends PluginBase implements Listener{
public $config;
public $chatStatus;
public $chatMessage;

    public function onEnable() : void{
        
        $server = $this->getServer();
        $server->getCommandMap()->register("ca", new Ca($this));
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->config = $this->getConfig();
        $this->chatStatus = $this->config->get("chat-mute-status");
        $this->chatMessage = $this->config->get("chat-mute-active-message");

    }

   

    function onPlayerChat(PlayerChatEvent $event){
        
        $event->getPlayer();
        $player = $event->getPlayer();
        if($this->chatStatus === "on"){
            if(!$player->hasPermission("chatadmintools.bypass") || !$player->hasPermission("chatadmintools")){
            $player->sendMessage(TF::RED.$this->chatMessage);
            $event->cancel();
            }
        }
    }
    

}
