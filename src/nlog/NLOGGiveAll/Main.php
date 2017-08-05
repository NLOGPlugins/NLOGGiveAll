<?php

namespace nlog\NLOGGiveAll;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\item\Item;

class Main extends PluginBase implements Listener{

 	 public function onEnable(){
    	$this->getServer()->getPluginManager()->registerEvents($this, $this);
    	$this->getLogger()->notice("전체에게 <아이템코드> 의 아이템을 <수량> 만큼 지급하는 플러그인입니다.");
    	$this->getLogger()->notice("Made by NLOG (nlog.kro.kr)");
 	 }
 	 
 	 public function onCommand(CommandSender $sender,Command $cmd, $label,array $args) {
 	 	
 	 	
 	 	if ($cmd->getName() === "giveall") {}
 	 		if(!(count($args) === 1 or count($args) === 2)) {
 	 			$sender->sendMessage("§o§b[ 알림 ] §7/giveall <아이템 코드> [아이템 수량]");
 	 			return;
 	 		}
			if (!(isset ($args[1]))) {
				$args[1] = 1;
			}
			
			if ($args[0] === "hand") {
				$item = $this->getServer()->getPlayerExact($sender->getName())->getInventory()->getItemInHand();
			}else{
 	 			$item = Item::fromString($args[0]);
			}
			
			$item->setCount((int)$args[1]);
			
			
			if ($item->getId() === 0) {
				$sender->sendMessage("§o§b[ 알림 ] §7알 수 없는 아이템입니다.");
				return;
			}
 	 		
			if ($args[1] <= 0 or $args[1] > 64) {
 	 			$sender->sendMessage("§o§b[ 알림 ] §7개수는 1개 이상 64개 이하로 입력해주세요.");
				return;
			}
			
 	 		foreach ($this->getServer()->getOnlinePlayers() as $player) {
 	 			$player->getInventory()->addItem($item);
 	 		}
 	 		
 	 		$this->getServer()->broadcastMessage("§o§b[ 알림 ] §7모든 플레이어에게 " . $item->getName() . " 을(를) " . $args[1] . " 만큼 지급하였습니다.");
 	 	}
 	 }
?>
