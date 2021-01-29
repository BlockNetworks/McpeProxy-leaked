<?php

namespace DebugPlugin;

use pocketmine\network\mcpe\protocol\DataPacket;
use pocketmine\network\mcpe\protocol\LoginPacket;
use pocketmine\network\mcpe\protocol\PlayStatusPacket;
use pocketmine\network\mcpe\protocol\ServerToClientHandshakePacket;
use pocketmine\network\mcpe\protocol\ClientToServerHandshakePacket;
use pocketmine\network\mcpe\protocol\DisconnectPacket;
use pocketmine\network\mcpe\protocol\ResourcePacksInfoPacket;
use pocketmine\network\mcpe\protocol\ResourcePackStackPacket;
use pocketmine\network\mcpe\protocol\ResourcePackClientResponsePacket;
use pocketmine\network\mcpe\protocol\TextPacket;
use pocketmine\network\mcpe\protocol\SetTimePacket;
use pocketmine\network\mcpe\protocol\StartGamePacket;
use pocketmine\network\mcpe\protocol\AddPlayerPacket;
use pocketmine\network\mcpe\protocol\AddActorPacket;
use pocketmine\network\mcpe\protocol\RemoveActorPacket;
use pocketmine\network\mcpe\protocol\AddItemActorPacket;
use pocketmine\network\mcpe\protocol\TakeItemActorPacket;
use pocketmine\network\mcpe\protocol\MoveActorAbsolutePacket;
use pocketmine\network\mcpe\protocol\MovePlayerPacket;
use pocketmine\network\mcpe\protocol\RiderJumpPacket;
use pocketmine\network\mcpe\protocol\UpdateBlockPacket;
use pocketmine\network\mcpe\protocol\AddPaintingPacket;
use pocketmine\network\mcpe\protocol\TickSyncPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacketV1;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\network\mcpe\protocol\BlockEventPacket;
use pocketmine\network\mcpe\protocol\ActorEventPacket;
use pocketmine\network\mcpe\protocol\MobEffectPacket;
use pocketmine\network\mcpe\protocol\UpdateAttributesPacket;
use pocketmine\network\mcpe\protocol\InventoryTransactionPacket;
use pocketmine\network\mcpe\protocol\MobEquipmentPacket;
use pocketmine\network\mcpe\protocol\MobArmorEquipmentPacket;
use pocketmine\network\mcpe\protocol\InteractPacket;
use pocketmine\network\mcpe\protocol\BlockPickRequestPacket;
use pocketmine\network\mcpe\protocol\ActorPickRequestPacket;
use pocketmine\network\mcpe\protocol\PlayerActionPacket;
use pocketmine\network\mcpe\protocol\HurtArmorPacket;
use pocketmine\network\mcpe\protocol\SetActorDataPacket;
use pocketmine\network\mcpe\protocol\SetActorMotionPacket;
use pocketmine\network\mcpe\protocol\SetActorLinkPacket;
use pocketmine\network\mcpe\protocol\SetHealthPacket;
use pocketmine\network\mcpe\protocol\SetSpawnPositionPacket;
use pocketmine\network\mcpe\protocol\AnimatePacket;
use pocketmine\network\mcpe\protocol\RespawnPacket;
use pocketmine\network\mcpe\protocol\ContainerOpenPacket;
use pocketmine\network\mcpe\protocol\ContainerClosePacket;
use pocketmine\network\mcpe\protocol\PlayerHotbarPacket;
use pocketmine\network\mcpe\protocol\InventoryContentPacket;
use pocketmine\network\mcpe\protocol\InventorySlotPacket;
use pocketmine\network\mcpe\protocol\ContainerSetDataPacket;
use pocketmine\network\mcpe\protocol\CraftingDataPacket;
use pocketmine\network\mcpe\protocol\CraftingEventPacket;
use pocketmine\network\mcpe\protocol\GuiDataPickItemPacket;
use pocketmine\network\mcpe\protocol\AdventureSettingsPacket;
use pocketmine\network\mcpe\protocol\BlockActorDataPacket;
use pocketmine\network\mcpe\protocol\PlayerInputPacket;
use pocketmine\network\mcpe\protocol\LevelChunkPacket;
use pocketmine\network\mcpe\protocol\SetCommandsEnabledPacket;
use pocketmine\network\mcpe\protocol\SetDifficultyPacket;
use pocketmine\network\mcpe\protocol\ChangeDimensionPacket;
use pocketmine\network\mcpe\protocol\SetPlayerGameTypePacket;
use pocketmine\network\mcpe\protocol\PlayerListPacket;
use pocketmine\network\mcpe\protocol\SimpleEventPacket;
use pocketmine\network\mcpe\protocol\EventPacket;
use pocketmine\network\mcpe\protocol\SpawnExperienceOrbPacket;
use pocketmine\network\mcpe\protocol\ClientboundMapItemDataPacket;
use pocketmine\network\mcpe\protocol\MapInfoRequestPacket;
use pocketmine\network\mcpe\protocol\RequestChunkRadiusPacket;
use pocketmine\network\mcpe\protocol\ChunkRadiusUpdatedPacket;
use pocketmine\network\mcpe\protocol\ItemFrameDropItemPacket;
use pocketmine\network\mcpe\protocol\GameRulesChangedPacket;
use pocketmine\network\mcpe\protocol\CameraPacket;
use pocketmine\network\mcpe\protocol\BossEventPacket;
use pocketmine\network\mcpe\protocol\ShowCreditsPacket;
use pocketmine\network\mcpe\protocol\AvailableCommandsPacket;
use pocketmine\network\mcpe\protocol\CommandRequestPacket;
use pocketmine\network\mcpe\protocol\CommandBlockUpdatePacket;
use pocketmine\network\mcpe\protocol\CommandOutputPacket;
use pocketmine\network\mcpe\protocol\UpdateTradePacket;
use pocketmine\network\mcpe\protocol\UpdateEquipPacket;
use pocketmine\network\mcpe\protocol\ResourcePackDataInfoPacket;
use pocketmine\network\mcpe\protocol\ResourcePackChunkDataPacket;
use pocketmine\network\mcpe\protocol\ResourcePackChunkRequestPacket;
use pocketmine\network\mcpe\protocol\TransferPacket;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\network\mcpe\protocol\StopSoundPacket;
use pocketmine\network\mcpe\protocol\SetTitlePacket;
use pocketmine\network\mcpe\protocol\AddBehaviorTreePacket;
use pocketmine\network\mcpe\protocol\StructureBlockUpdatePacket;
use pocketmine\network\mcpe\protocol\ShowStoreOfferPacket;
use pocketmine\network\mcpe\protocol\PurchaseReceiptPacket;
use pocketmine\network\mcpe\protocol\PlayerSkinPacket;
use pocketmine\network\mcpe\protocol\SubClientLoginPacket;
use pocketmine\network\mcpe\protocol\AutomationClientConnectPacket;
use pocketmine\network\mcpe\protocol\SetLastHurtByPacket;
use pocketmine\network\mcpe\protocol\BookEditPacket;
use pocketmine\network\mcpe\protocol\NpcRequestPacket;
use pocketmine\network\mcpe\protocol\PhotoTransferPacket;
use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;
use pocketmine\network\mcpe\protocol\ServerSettingsRequestPacket;
use pocketmine\network\mcpe\protocol\ServerSettingsResponsePacket;
use pocketmine\network\mcpe\protocol\ShowProfilePacket;
use pocketmine\network\mcpe\protocol\SetDefaultGameTypePacket;
use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\LabTablePacket;
use pocketmine\network\mcpe\protocol\UpdateBlockSyncedPacket;
use pocketmine\network\mcpe\protocol\MoveActorDeltaPacket;
use pocketmine\network\mcpe\protocol\SetScoreboardIdentityPacket;
use pocketmine\network\mcpe\protocol\SetLocalPlayerAsInitializedPacket;
use pocketmine\network\mcpe\protocol\UpdateSoftEnumPacket;
use pocketmine\network\mcpe\protocol\NetworkStackLatencyPacket;
use pocketmine\network\mcpe\protocol\ScriptCustomEventPacket;
use pocketmine\network\mcpe\protocol\SpawnParticleEffectPacket;
use pocketmine\network\mcpe\protocol\AvailableActorIdentifiersPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacketV2;
use pocketmine\network\mcpe\protocol\NetworkChunkPublisherUpdatePacket;
use pocketmine\network\mcpe\protocol\BiomeDefinitionListPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\LevelEventGenericPacket;
use pocketmine\network\mcpe\protocol\LecternUpdatePacket;
use pocketmine\network\mcpe\protocol\AddEntityPacket;
use pocketmine\network\mcpe\protocol\RemoveEntityPacket;
use pocketmine\network\mcpe\protocol\ClientCacheStatusPacket;
use pocketmine\network\mcpe\protocol\OnScreenTextureAnimationPacket;
use pocketmine\network\mcpe\protocol\MapCreateLockedCopyPacket;
use pocketmine\network\mcpe\protocol\StructureTemplateDataRequestPacket;
use pocketmine\network\mcpe\protocol\StructureTemplateDataResponsePacket;
use pocketmine\network\mcpe\protocol\ClientCacheBlobStatusPacket;
use pocketmine\network\mcpe\protocol\ClientCacheMissResponsePacket;
use pocketmine\network\mcpe\protocol\EducationSettingsPacket;
use pocketmine\network\mcpe\protocol\EmotePacket;
use pocketmine\network\mcpe\protocol\MultiplayerSettingsPacket;
use pocketmine\network\mcpe\protocol\SettingsCommandPacket;
use pocketmine\network\mcpe\protocol\AnvilDamagePacket;
use pocketmine\network\mcpe\protocol\CompletedUsingItemPacket;
use pocketmine\network\mcpe\protocol\NetworkSettingsPacket;
use pocketmine\network\mcpe\protocol\PlayerAuthInputPacket;
use pocketmine\network\mcpe\protocol\CreativeContentPacket;
use pocketmine\network\mcpe\protocol\PlayerEnchantOptionsPacket;
use pocketmine\network\mcpe\protocol\ItemStackRequestPacket;
use pocketmine\network\mcpe\protocol\ItemStackResponsePacket;
use pocketmine\network\mcpe\protocol\PlayerArmorDamagePacket;
use pocketmine\network\mcpe\protocol\CodeBuilderPacket;
use pocketmine\network\mcpe\protocol\UpdatePlayerGameTypePacket;
use pocketmine\network\mcpe\protocol\EmoteListPacket;
use pocketmine\network\mcpe\protocol\PositionTrackingDBServerBroadcastPacket;
use pocketmine\network\mcpe\protocol\PositionTrackingDBClientRequestPacket;
use pocketmine\network\mcpe\protocol\DebugInfoPacket;
use pocketmine\network\mcpe\protocol\PacketViolationWarningPacket;
use pocketmine\network\mcpe\protocol\MotionPredictionHintsPacket;
use pocketmine\network\mcpe\protocol\AnimateEntityPacket;
use pocketmine\network\mcpe\protocol\CameraShakePacket;
use pocketmine\network\mcpe\protocol\PlayerFogPacket;
use pocketmine\network\mcpe\protocol\CorrectPlayerMovePredictionPacket;
use pocketmine\network\mcpe\protocol\ItemComponentPacket;
use pocketmine\network\mcpe\protocol\FilterTextPacket;
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
		$packet->decode();
		if ($packet instanceof LoginPacket) {
			var_dump("Packet: LoginPacket");
			var_dump("Username: " . $packet->username);
			var_dump("Protocol: " . $packet->protocol);
			var_dump("clientUUID: " . $packet->clientUUID);
			var_dump("clientId: " . $packet->clientId);
			var_dump("xuid: " . $packet->xuid);
			var_dump("identityPublicKey: " . $packet->identityPublicKey);
			var_dump("serverAddress: " . $packet->serverAddress);
			var_dump("Locale: " . $packet->locale);
			var_dump("chainData: " . $packet->chainData);
			var_dump("clientDataJwt: " . $packet->clientDataJwt);
			var_dump("clientData: " . $packet->clientData);
			if ($packet->skipVerification) {
				var_dump("skipVerification: True");
			} else {
				var_dump("skipVerification: False");
			}
		} elseif ($packet instanceof PlayStatusPacket) {
			var_dump("Packet: PlayStatusPacket");
			var_dump("Status: " . $packet->status);
		} elseif ($packet instanceof ServerToClientHandshakePacket) {
			var_dump("Packet: ServerToClientHandshakePacket");
			var_dump("jwt: " . $packet->jwt);
		} elseif ($packet instanceof ClientToServerHandshakePacket) {
			var_dump("Packet: ClientToServerHandshakePacket");
			// nothing in packet
		} elseif ($packet instanceof DisconnectPacket) {
			var_dump("Packet: DisconnectPacket");
			if ($packet->hideDisconnectionScreen) {
				var_dump("hideDisconnectionScreen: True");
			} else {
				var_dump("hideDisconnectionScreen: False");
			}
			var_dump("Message: " . $packet->message);
		} elseif ($packet instanceof ResourcePacksInfoPacket) {
			var_dump("Packet: ResourcePacksInfoPacket");
			if ($packet->mustAccept) {
				var_dump("mustAccept: True");
			} else {
				var_dump("mustAccept: False");
			}
			if ($packet->hasScripts) {
				var_dump("hasScripts: True");
			} else {
				var_dump("hasScripts: False");
			}
			var_dump("behaviorPackEntries: " . $packet->behaviorPackEntries);
			var_dump("resourcePackEntries: " . $packet->resourcePackEntries);
		} elseif ($packet instanceof ResourcePackStackPacket) {
			var_dump("Packet: ResourcePackStackPacket");
			if ($packet->mustAccept) {
				var_dump("mustAccept: True");
			} else {
				var_dump("mustAccept: False");
			}
			var_dump("behaviorPackStack: " . $packet->behaviorPackStack);
			var_dump("resourcePackStack: " . $packet->resourcePackStack);
			var_dump("baseGameVersion: " . $packet->baseGameVersion);
			var_dump("experiments: " . $packet->experiments);
		} elseif ($packet instanceof ResourcePackClientResponsePacket) {
			var_dump("Packet: ResourcePackClientResponsePacket");
			var_dump("status: " . $packet->status);
			var_dump("packIds: " . $packet->packIds);
		} elseif ($packet instanceof TextPacket) {
			var_dump("Packet: TextPacket");
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
		} elseif ($packet instanceof SetTimePacket) {
			var_dump("Packet: SetTimePacket");
			var_dump("time: " . $packet->time);
		} elseif ($packet instanceof StartGamePacket) {
			var_dump("Packet: StartGamePacket");
			var_dump("entityUniqueId: " . $packet->entityUniqueId);
			var_dump("entityRuntimeId: " . $packet->entityRuntimeId);
			var_dump("playerGamemode: " . $packet->playerGamemode);
			var_dump("playerPosition: " . $packet->playerPosition);
			var_dump("pitch: " . $packet->pitch);
			var_dump("yaw: " . $packet->yaw);
			var_dump("seed: " . $packet->seed);
			var_dump("spawnSettings: " . $packet->spawnSettings);
			var_dump("generator: " . $packet->generator);
			var_dump("worldGamemode: " . $packet->worldGamemode);
			var_dump("difficulty: " . $packet->difficulty);
			var_dump("spawnX: " . $packet->spawnX);
			var_dump("spawnY: " . $packet->spawnY);
			var_dump("spawnZ: " . $packet->spawnZ);
			if ($packet->hasAchievementsDisabled) {
				var_dump("hasAchievementsDisabled: True");
			} else {
				var_dump("hasAchievementsDisabled: False");
			}
			var_dump("time: " . $packet->time);
			var_dump("eduEditionOffer: " . $packet->eduEditionOffer);
			if ($packet->hasEduFeaturesEnabled) {
				var_dump("hasEduFeaturesEnabled: True");
			} else {
				var_dump("hasEduFeaturesEnabled: False");
			}
			var_dump("eduProductUUID: " . $packet->eduProductUUID);
			var_dump("rainLevel: " . $packet->rainLevel);
			var_dump("lightningLevel: " . $packet->lightningLevel);
			if ($packet->hasConfirmedPlatformLockedContent) {
				var_dump("hasConfirmedPlatformLockedContent: True");
			} else {
				var_dump("hasConfirmedPlatformLockedContent: False");
			}
			if ($packet->isMultiplayerGame) {
				var_dump("isMultiplayerGame: True");
			} else {
				var_dump("isMultiplayerGame: False");
			}
			if ($packet->hasLANBroadcast) {
				var_dump("hasLANBroadcast: True");
			} else {
				var_dump("hasLANBroadcast: False");
			}
			var_dump("xboxLiveBroadcastMode: " . $packet->xboxLiveBroadcastMode);
			var_dump("platformBroadcastMode: " . $packet->platformBroadcastMode);
			if ($packet->commandsEnabled) {
				var_dump("commandsEnabled: True");
			} else {
				var_dump("commandsEnabled: False");
			}
			if ($packet->isTexturePacksRequired) {
				var_dump("isTexturePacksRequired: True");
			} else {
				var_dump("isTexturePacksRequired: False");
			}
			var_dump("gameRules: " . $packet->gameRules);
			var_dump("experiments: " . $packet->experiments);
			if ($packet->hasBonusChestEnabled) {
				var_dump("hasBonusChestEnabled: True");
			} else {
				var_dump("hasBonusChestEnabled: False");
			}
			if ($packet->hasStartWithMapEnabled) {
				var_dump("hasStartWithMapEnabled: True");
			} else {
				var_dump("hasStartWithMapEnabled: False");
			}
			var_dump("defaultPlayerPermission: " . $packet->defaultPlayerPermission);
			var_dump("serverChunkTickRadius: " . $packet->serverChunkTickRadius);
			if ($packet->hasLockedBehaviorPack) {
				var_dump("hasLockedBehaviorPack: True");
			} else {
				var_dump("hasLockedBehaviorPack: False");
			}
			if ($packet->hasLockedResourcePack) {
				var_dump("hasLockedResourcePack: True");
			} else {
				var_dump("hasLockedResourcePack: False");
			}
			if ($packet->isFromLockedWorldTemplate) {
				var_dump("isFromLockedWorldTemplate: True");
			} else {
				var_dump("isFromLockedWorldTemplate: False");
			}
			if ($packet->useMsaGamertagsOnly) {
				var_dump("useMsaGamertagsOnly: True");
			} else {
				var_dump("useMsaGamertagsOnly: False");
			}
			if ($packet->isFromWorldTemplate) {
				var_dump("isFromWorldTemplate: True");
			} else {
				var_dump("isFromWorldTemplate: False");
			}
			if ($packet->isWorldTemplateOptionLocked) {
				var_dump("isWorldTemplateOptionLocked: True");
			} else {
				var_dump("isWorldTemplateOptionLocked: False");
			}
			if ($packet->onlySpawnV1Villagers) {
				var_dump("onlySpawnV1Villagers: True");
			} else {
				var_dump("onlySpawnV1Villagers: False");
			}
			var_dump("vanillaVersion: " . $packet->vanillaVersion);
			var_dump("limitedWorldWidth: " . $packet->limitedWorldWidth);
			var_dump("limitedWorldLength: " . $packet->limitedWorldLength);
			if ($packet->isNewNether) {
				var_dump("isNewNether: True");
			} else {
				var_dump("isNewNether: False");
			}
			var_dump("experimentalGameplayOverride: " . $packet->experimentalGameplayOverride);
			var_dump("levelId: " . $packet->levelId);
			var_dump("worldName: " . $packet->worldName);
			var_dump("premiumWorldTemplateId: " . $packet->premiumWorldTemplateId);
			if ($packet->isTrial) {
				var_dump("isTrial: True");
			} else {
				var_dump("isTrial: False");
			}
			var_dump("playerMovementType: " . $packet->playerMovementType);
			var_dump("currentTick: " . $packet->currentTick);
			var_dump("enchantmentSeed: " . $packet->enchantmentSeed);
			var_dump("multiplayerCorrelationId: " . $packet->multiplayerCorrelationId);
			var_dump("blockPalette: " . $packet->blockPalette);
			var_dump("itemTable: " . $packet->itemTable);
			if ($packet->enableNewInventorySystem) {
				var_dump("enableNewInventorySystem: True");
			} else {
				var_dump("enableNewInventorySystem: False");
			}
		} elseif ($packet instanceof AddPlayerPacket) {
			var_dump("Packet: AddPlayerPacket");
			var_dump("uuid: " . $packet->uuid);
			var_dump("username: " . $packet->username);
			var_dump("entityUniqueId: " . $packet->entityUniqueId);
			var_dump("entityRuntimeId: " . $packet->entityRuntimeId);
			var_dump("platformChatId: " . $packet->platformChatId);
			var_dump("position: " . $packet->position);
			var_dump("motion: " . $packet->motion);
			var_dump("pitch: " . $packet->pitch);
			var_dump("yaw: " . $packet->yaw);
			var_dump("headYaw: " . $packet->headYaw);
			var_dump("item: " . $packet->item);
			var_dump("metadata: " . $packet->metadata);
			var_dump("uvarint1: " . $packet->uvarint1);
			var_dump("uvarint2: " . $packet->uvarint2);
			var_dump("uvarint3: " . $packet->uvarint3);
			var_dump("uvarint4: " . $packet->uvarint4);
			var_dump("uvarint5: " . $packet->uvarint5);
			var_dump("long1: " . $packet->long1);
			var_dump("links: " . $packet->links);
			var_dump("deviceId: " . $packet->deviceId);
			var_dump("buildPlatform: " . $packet->buildPlatform);
		} elseif ($packet instanceof AddActorPacket) {
			var_dump("Packet: AddActorPacket");
			var_dump("entityUniqueId: " . $packet->entityUniqueId);
			var_dump("entityRuntimeId: " . $packet->entityRuntimeId);
			var_dump("type: " . $packet->type);
			var_dump("position: " . $packet->position);
			var_dump("motion: " . $packet->motion);
			var_dump("pitch: " . $packet->pitch);
			var_dump("yaw: " . $packet->yaw);
			var_dump("headYaw: " . $packet->headYaw);
			var_dump("attributes: " . $packet->attributes);
			var_dump("metadata: " . $packet->metadata);
			var_dump("links: " . $packet->links);
		} elseif ($packet instanceof RemoveActorPacket) {
			var_dump("Packet: RemoveActorPacket");
			var_dump("entityUniqueId: " . $packet->entityUniqueId);
		} elseif ($packet instanceof AddItemActorPacket) {
			var_dump("Packet: AddItemActorPacket");
			var_dump("entityUniqueId: " . $packet->entityUniqueId);
			var_dump("entityRuntimeId: " . $packet->entityRuntimeId);
			var_dump("item: " . $packet->item);
			var_dump("position: " . $packet->position);
			var_dump("motion: " . $packet->motion);
			var_dump("metadata: " . $packet->metadata);
			if ($packet->isFromFishing) {
				var_dump("isFromFishing: True");
			} else {
				var_dump("isFromFishing: False");
			}
		} elseif ($packet instanceof TakeItemActorPacket) {
			var_dump("Packet: TakeItemActorPacket");
			var_dump("target: " . $packet->target);
			var_dump("eid: " . $packet->eid);
		} elseif ($packet instanceof MoveActorAbsolutePacket) {
			var_dump("Packet: MoveActorAbsolutePacket");
			var_dump("entityRuntimeId: " . $packet->entityRuntimeId);
			var_dump("flags: " . $packet->flags);
			var_dump("position: " . $packet->position);
			var_dump("xRot: " . $packet->xRot);
			var_dump("yRot: " . $packet->yRot);
			var_dump("zRot: " . $packet->zRot);
		} elseif ($packet instanceof MovePlayerPacket) {
			var_dump("Packet: MovePlayerPacket");
			var_dump("entityRuntimeId: " . $packet->entityRuntimeId);
			var_dump("position: " . $packet->position);
			var_dump("pitch: " . $packet->pitch);
			var_dump("yaw: " . $packet->yaw);
			var_dump("headYaw: " . $packet->headYaw);
			var_dump("mode: " . $packet->mode);
			if ($packet->onGround) {
				var_dump("onGround: True");
			} else {
				var_dump("onGround: False");
			}
			var_dump("ridingEid: " . $packet->ridingEid);
			var_dump("teleportCause: " . $packet->teleportCause);
			var_dump("teleportItem: " . $packet->teleportItem);
			var_dump("tick: " . $packet->tick);
		} elseif ($packet instanceof RiderJumpPacket) {
			var_dump("Packet: RiderJumpPacket");
			var_dump("jumpStrength: " . $packet->jumpStrength);
		}
		return true;
	}

}
