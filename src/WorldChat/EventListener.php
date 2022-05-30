<?php

namespace WorldChat;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class EventListener implements Listener {
	
    /** @var WorldChat */
    private $plugin;
    
	public function __construct(WorldChat $plugin){
		$this->plugin = $plugin;
	}
	
	/**
	 * @param PlayerChatEvent $event
	 */
	public function onChat(PlayerChatEvent $event){
		$player = $event->getPlayer();
		if($this->plugin->isChatDisabled($player->getWorld ()->getDisplayName())) {
		    if($this->plugin->cfg["log-chat-disabled"]){
		        $player->sendMessage(TextFormat::colorize(WorldChat::PREFIX . "&cChat disabled on this world"));
		    }
		    $event->cancel();
		}
		$recipients = $event->getRecipients();
		foreach($recipients as $key => $recipient){
			if($recipient->getWorld() != $player->getWorld()){
				if($recipient->getWorld() != $player->getWorld()){
					unset($recipients[$key]);
				}
			}
		}
		$event->setRecipients($recipients);
	}
}
