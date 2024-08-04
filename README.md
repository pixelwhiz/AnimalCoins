# AnimalCoins Plugin

**AnimalCoins** is a Minecraft plugin for PocketMine-MP that integrates with EconomyAPI to add a custom currency system using "Animal Coins." This plugin allows players to earn and use Animal Coins in various ways, including through item use, block placement, and entity drops.

## Features

- **Coin Usage**: Players can use Animal Coins to earn money.
- **Block Placement**: Prevents placement of Animal Coins blocks.
- **Entity Drops**: Entities drop Animal Coins upon death with a random chance.

## Installation

1. **Download the Plugin**:
   - Download the `AnimalCoins.phar` file from the [releases page](https://poggit.pmmp.io/ci/pixelwhiz/AnimalCoins/AnimalCoins).

2. **Install the Plugin**:
   - Place the `AnimalCoins.phar` file in the `plugins` directory of your PocketMine-MP server.

3. **Configure the Plugin**:
   - The plugin will generate a `config.yml` file on the first run.
   - Edit `config.yml` to configure the coin name and reward messages.

## Configuration

The `config.yml` file allows you to customize the following settings:

```yaml
Coins:
  name: "Animal Coins" # The name of the coin item.

Rewards:
  message: "You earned {REWARDS} from Animal Coins" # Message sent to the player upon earning money.
  min-money: 100 # Minimum amount of money that can be earned.
  max-money: 1000 # Maximum amount of money that can be earned.
