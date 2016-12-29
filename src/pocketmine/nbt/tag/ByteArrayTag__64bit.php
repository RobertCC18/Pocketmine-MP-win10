<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____  
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \ 
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/ 
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_| 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 * 
 *
*/

namespace pocketmine\nbt\tag;

use pocketmine\nbt\NBT;

use pocketmine\utils\Binary;
















class ByteArrayTag extends NamedTag{

	public function getType(){
		return NBT::TAG_ByteArray;
	}

	public function read(NBT $nbt, bool $network = \false){
		$this->value = $nbt->get(($network === \true ? Binary::readVarInt($nbt) : ($nbt->endianness === 1 ? (\unpack("N", $nbt->get(4))[1] << 32 >> 32) : (\unpack("V", $nbt->get(4))[1] << 32 >> 32))));
	}

	public function write(NBT $nbt, bool $network = \false){
		($nbt->buffer .=  $network === \true ? Binary::writeVarInt(\strlen($this->value)) : ($nbt->endianness === 1 ? (\pack("N", \strlen($this->value))) : (\pack("V", \strlen($this->value)))));
		($nbt->buffer .= $this->value);
	}
}
