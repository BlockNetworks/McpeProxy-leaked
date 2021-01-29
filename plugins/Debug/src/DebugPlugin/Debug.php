<?php

namespace DebugPlugin;

use pocketmine\network\mcpe\protocol\DataPacket;
use pocketmine\network\mcpe\protocol\TextPacket;
use proxy\plugin\Plugin;
use proxy\utils\Log;

class Debug extends Plugin {

	public function onEnable() : void {
		Log::Warn("DebugPlugin loaded");
	}

	public function handleServerDataPacket(DataPacket $packet) : bool {
		return true;
	}

	public function handleClientDataPacket(DataPacket $packet) : bool {
		if ($packet instanceof TextPacket) {
			$packet->decode();
			var_dump("Type: " . $packet->type);
			if ($packet->needsTranslation) {
				var_dump("NeedsTranslation: True");
			} else {
				var_dump("NeedsTranslation: False");
			}
			var_dump("SourceName: " . $packet->sourceName);
			var_dump("Message: " . $packet->message);
			var_dump("Parameters: " . $packet->parameters);
			var_dump("xboxUserId: " . $packet->xboxUserId);
			var_dump("platformChatId: " . $packet->platformChatId);
		}
		return true;
	}

}
