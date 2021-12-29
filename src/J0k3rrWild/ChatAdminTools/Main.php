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

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
       

    }

    public function onCommand(CommandSender $p, Command $cmdData, string $label, array $args) : bool{
        if(!isset($args[0])) return false;

        $option = strtolower($args[0]);
        $cmd = $cmdData->getName();

        switch($option){
            
            case "clear":
                if ($p->hasPermission("chatadmintools") || $p->hasPermission("chatadmintools.clear")){
                    if(isset($args[1])){
                    $this->getServer()->broadcastmessage(TF::RED."\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n> Chat cleared by: ". $p->getName()."\n"."> Reason: ".$args[1]);
                }else{
                    $this->getServer()->broadcastmessage(TF::RED."\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n> Chat cleared by: ". $p->getName());
                }
            }
            break;
            case "on":
             if($p->hasPermission("chatadmintools.change") || $p->hasPermission("chatadmintools")){
                $config = $this->getConfig();

                $config->set("chat-status", $option);
                $config->save();
              
                $this->getServer()->broadcastmessage(TF::RED."> Chat enabled by: ".$p->getName());
             }
                break;
            case "off":
                $config = $this->getConfig();
                
                $config->set("chat-status", $option);
                $config->save();
                
                $this->getServer()->broadcastmessage(TF::RED."> Chat disabled by: ".$p->getName());
                break;

        }
        return true;
    }

    function onPlayerChat(PlayerChatEvent $event){
        $this->reloadConfig();
        $config = $this->getConfig();
        $event->getPlayer();
        $player = $event->getPlayer();
        if($config->get("chat-status") == "off"){
            if(!$player->hasPermission("chatadmintools.bypass") || !$player->hasPermission("chatadmintools")){
            $player->sendMessage(TF::RED.$config->get("chat-mute-active-message"));
            $event->setCancelled();
            }
        }else{
            return true;
        } 
    }
    

}
