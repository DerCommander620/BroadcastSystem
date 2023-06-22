<?php
namespace Broadcast;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        switch($command->getName()){
            case "broadcast":
                if($sender->hasPermission("broadcast.cmd.use")){
                    if(empty($args[0])){
                        $sender->sendMessage("§cPlease enter /broadcast help!");
                    }else{
                        switch(strtolower($args[0])){
                            case "help":
                                $sender->sendMessage("-------------------------------Help-------------------------------");
                                $sender->sendMessage("/broadcast chat <message> - Sends a message in the server chat");
                                $sender->sendMessage("/broadcast tip <message> - Sends a tip to the entire Server");
                                $sender->sendMessage("/broadcast private <playername> <message> - Send a private Message");
                                $sender->sendMessage("/broadcast help - shows this List");
                                $sender->sendMessage("--------------------------------End-------------------------------");
                                break;
                            case "chat":
                                if(empty($args[1])){
                                    $sender->sendMessage("§cPlease enter a Message!");
                                }else{
                                $message = $args([1]);
                                $this->getServer()->broadcastMessage("§aServer>> " . $message);
                                }
                                break;
                            case "tip":
                                if(empty($args[1])){
                                    $sender->sendMessage("§cPlease enter a Message!");
                                }else{
                                $message = $args([1]);
                                $this->getServer()->broadcastTip("§aServer>> " . $message);
                                }
                                break;
                            case "private":
                                if(empty($args[1])){
                                    $sender->sendMessage("§cPlease enter a PlayerName!");
                                }
                                if(empty($args[2])){
                                    $sender->sendMessage("§cPlease enter a Message!");
                                }else{
                                    $player = $this->getServer()->getPlayerExact($args[1]);
                                    $message = $args([2]);
                                    $player->sendMessage("§aPrivate >> ". $message . " §bfrom " . $sender->getName());
                                }
                                break;            
                        }
                    }
                }else{
                    $sender->sendMessage("§cYou have no Permission to use this Command!");
                }
        }
    return true;    
    }
}