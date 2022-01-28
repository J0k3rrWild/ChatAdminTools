<?php

declare(strict_types = 1);


namespace J0k3rrWild\ChatAdminTools;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\command\Command;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandExecutor;
use pocketmine\plugin\{PluginOwned, PluginOwnedTrait};
use pocketmine\command\utils\InvalidCommandSyntaxException;

use J0k3rrWild\ChatAdminTools\Main;
 

class Ca extends Command implements PluginOwned{
    use PluginOwnedTrait;

    public function __construct(Main $plugin){
		parent::__construct("ca", "Chat administrative command", "/ca clear <reason>* | on/off");
		$this->setPermission("chatadmintools.clear");
		$this->plugin = $plugin;
	}

public function execute(CommandSender $p, string $label, array $args){
        if(!isset($args[0])){ 
            throw new InvalidCommandSyntaxException;
            return false;
       }
        $option = strtolower($args[0]);
      

        switch($option){
            
            case "clear":
                if ($p->hasPermission("chatadmintools") || $p->hasPermission("chatadmintools.clear")){
                    if(isset($args[1])){
                        $this->plugin->getServer()->broadcastmessage(TF::RED."\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n> Chat cleared by: ". $p->getName()."\n"."> Reason: ".$args[1]);
                }else{
                    $this->plugin->getServer()->broadcastmessage(TF::RED."\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n> Chat cleared by: ". $p->getName());
                }
            }
            break;
            case "on":
             if($p->hasPermission("chatadmintools.change") || $p->hasPermission("chatadmintools")){
                $config = $this->plugin->getConfig();
                
                $this->chatStatus = "on";
                $config->set("chat-mute-status", "on");
                $config->save();
              
                $this->plugin->getServer()->broadcastmessage(TF::RED."> Chat disabled by: ".$p->getName());
             }
                break;
            case "off":
                $config = $this->plugin->getConfig();

                $this->chatStatus = "off";
                $config->set("chat-mute-status", "off");
                $config->save();
                
                $this->plugin->getServer()->broadcastmessage(TF::RED."> Chat enabled by: ".$p->getName());
                break;

        }
        return true;
    }
}