<?php

namespace cosmicnebula200\HideNameTag;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;


class HideNameTag extends PluginBase {

	public function onEnable()
	{
		$this->saveDefaultConfig();
		
	}


	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
	{
		$this->purechat = $this->getServer()->getPluginManager()->getPlugin("PureChat");

		switch ($command->getName()){

			case "hide":

				if(isset($args[0])){

					$player = $this->getServer()->getPlayer($args[0]);

					if($player instanceof Player){

						$player->setNameTag("");
						$msg = $this->getConfig()->get("Hide-Message-Other");
						$player->sendMessage(str_replace("&" , "§",$msg));

					}
				}else{
					if($sender instanceof Player){

						$sender->setNameTag("");
						$msg = $this->getConfig()->get("Hide-Message");
						$sender->sendMessage(str_replace("&" , "§",$msg));

					}


				}
				break;
			case "unhide":

				if(isset($args[0])){

					$player = $this->getServer()->getPlayer($args[0]);

					if($player instanceof Player){

						$levelName = $this->purechat->getConfig()->get("enable-multiworld-chat") ? $player->getLevel()->getName() : null;
						$nameTag = $this->purechat->getNametag($player, $levelName);
						$player->setNameTag($nameTag);
						$msg = $this->getConfig()->get("Unhide-Message-Other");
						$player->sendMessage(str_replace("&" , "§",$msg));

					}else{

						$sender->sendMessage("player not online");

					}
				}else{

					if($sender instanceof Player){

						$levelName = $this->purechat->getConfig()->get("enable-multiworld-chat") ? $sender->getLevel()->getName() : null;
						$nameTag = $this->purechat->getNametag($sender, $levelName);
						$sender->setNameTag($nameTag);
						$msg = $this->getConfig()->get("Unhide-Message");
						$sender->sendMessage(str_replace("&" , "§",$msg));

					}

				}

		}
		return true;

	}


}
