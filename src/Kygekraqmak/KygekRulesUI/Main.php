<?php

# A plugin for PocketMine-MP that will show rules of a server in an UI form.
# Copyright (C) 2020 Kygekraqmak
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <https://www.gnu.org/licenses/>.

namespace Kygekraqmak\KygekRulesUI;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase implements Listener {
    
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->getResource("config.yml");
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        if($sender->hasPermission("rules.command")) {
            if($cmd->getName() == "rules") {
                if(!$sender instanceof Player) {
                    $sender->sendMessage("This command only works in game!");
                } else {
                    $this->kygekRulesUI($sender);
                }
            }
        } else {
            $sender->sendMessage("You do not have permission to use this command");
        }
        return true;
    }
    
    public function kygekRulesUI($sender) {
        $form = new SimpleForm(function (Player $sender, int $data = null) {
           $result = $data;
           if($result === null){
               return true;
           }             
           switch($result){
               case 0:
                    
               break;

               }
           });
           $form->setTitle($this->getConfig()->get("title"));
           $form->setContent($this->getConfig()->get("content"));
           $form->addButton($this->getConfig()->get("button"));
           $form->sendToPlayer($sender);
           return $form;
    }
    
}
