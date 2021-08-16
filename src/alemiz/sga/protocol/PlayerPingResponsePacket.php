<?php
/*
 * Copyright 2020 Alemiz
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *  http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

namespace alemiz\sga\protocol;

use alemiz\sga\codec\StarGatePacketHandler;
use alemiz\sga\codec\StarGatePackets;
use alemiz\sga\protocol\types\PacketHelper;

class PlayerPingResponsePacket extends StarGatePacket {

    /** @var string */
    private $playerName;
    /** @var int */
    private $upstreamPing;
    /** @var int */
    private $downstreamPing;

    public function encodePayload() : void {
        PacketHelper::writeString($this, $this->playerName);
        PacketHelper::writeLong($this, $this->ping);
    }

    public function decodePayload() : void {
        $this->playerName = PacketHelper::readString($this);
        $this->upstreamPing = PacketHelper::readLong($this);
        $this->downstreamPing = PacketHelper::readLong($this);
    }

    /**
     * @param StarGatePacketHandler $handler
     * @return bool
     */
    public function handle(StarGatePacketHandler $handler) : bool {
        return $handler->handlePlayerPingResponse($this);
    }

    public function getPacketId() : int {
        return StarGatePackets::PLAYER_PING_RESPONSE_PACKET;
    }

    /**
     * @return bool
     */
    public function isResponse() : bool {
        return true;
    }

    /**
     * @param string $playerName
     */
    public function setPlayerName(string $playerName) : void {
        $this->playerName = $playerName;
    }

    /**
     * @return string
     */
    public function getPlayerName() : string {
        return $this->playerName;
    }


    /**
     * @param string $playerName
     */
    public function setUpstreamPing(int $upstreamPing) : void {
        $this->upstreamPing = $upstreamPing;
    }

    /**
     * @return string
     */
    public function getUpstreamPing() : int {
        return $this->upstreamPing;
    }

    /**
     * @param string $playerName
     */
    public function setDownstreamPing(int $downstreamPing) : void {
        $this->downstreamPing = $downstreamPing;
    }

    /**
     * @return string
     */
    public function getDownstreamPing() : int {
        return $this->downstreamPing;
    }


}