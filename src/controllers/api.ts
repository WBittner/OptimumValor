import { Response, Request } from "express";

import { DDMap, DDMapResponse } from "../types/DDMap";
import { DDItem, DDItemResponse } from "DDItem";
import { DDSummonerResponse } from "DDSummoner";
import { DDRunesResponse } from "DDRunes";
import { getMapStaticData, getItemStaticData, getChampionStaticData, getSummonerStaticData, getRuneStaticData, ModeToReadable, getImageUrl, DataTypes, getDDVersions } from "../util/leagueStaticData";

export class Api {
  static isValidItem(item: DDItem) {
    return !item.into && item.tags.indexOf("Consumable") === -1 && item.tags.indexOf("Lane") === -1 && 
      item.inStore !== false && !item.name.includes("(Quick Charge)");
  }

  private items: any;
  private champions: any;
  private maps: any;
  private summoners: any;
  private runes: any;

  private itemDataByMap: any;
  private summonersDataByMode: any;
  private formattedRunes: any;
  private DDVersions: any;

  constructor() {
    getDDVersions().then((versions) => {
      this.DDVersions = versions;
      this.itemDataByMap = {};
      this.summonersDataByMode = {};
      this.formattedRunes = {};

      getMapStaticData(this.DDVersions[DataTypes.MAP]).then(this.formatMaps.bind(this));
      getItemStaticData(this.DDVersions[DataTypes.ITEM]).then(this.formatItems.bind(this));
      getChampionStaticData(this.DDVersions[DataTypes.CHAMPION]).then(this.formatChampions.bind(this));
      getSummonerStaticData(this.DDVersions[DataTypes.SUMMONER]).then(this.formatSummoners.bind(this));
      //TODO: for now it seems the rune data isn't finished yet, so there's no rune versions - just use summoner til it is made
      getRuneStaticData(this.DDVersions[DataTypes.SUMMONER]).then(this.formatRunes.bind(this));
    });
  }

  dumpData() {
    return {
      rawData: {
        versions: this.DDVersions,
        items: this.items,
        champions: this.champions,
        maps: this.maps,
        summoners: this.summoners,
        runes: this.runes
      },
      buildData: {
        itemDataByMap: this.itemDataByMap,
        summonersDataByMode: this.summonersDataByMode,
        formattedRunes: this.formattedRunes
      },
      selectionData: {
        maps: this.getAvailableMaps(),
        modes: this.getAvailableModes()
      }
    }
  }

  getSelectionData() {
    return {
      maps: this.getAvailableMaps(),
      modes: this.getAvailableModes()
    };
  }

  getBuild(req: Request, res: Response) {
    res.send({map: req.params["map"],mode: req.params["mode"]});
  }

  private formatItems({data} : DDItemResponse) {
    this.items = data;

    for (let itemId in data) {
      let item = data[itemId];
      for (let mapId in item.maps) {
        if (Api.isValidItem(item) ) {
          if (item.maps[mapId] === true && this.itemDataByMap[mapId]) {
            if (item.tags.indexOf("Boots") !== -1) {
              this.itemDataByMap[mapId].items.boots.push(
                item
              );
            } else if (item.name.includes("Enchantment:")) {
              this.itemDataByMap[mapId].items.jungling.push(
                item
              );
            } else {
              this.itemDataByMap[mapId].items.generic.push(
                item
              );
            }
            
          }
        }
      }
    }
  }

  private formatChampions({data} : any) {
    this.champions = data;
  }

  private formatMaps({data} : DDMapResponse) {
    this.maps = data;

    for (let mapId in data) {
      this.itemDataByMap[mapId] = {
        name: data[mapId].MapName,
        url: getImageUrl(DataTypes.MAP, DataTypes.MAP + mapId, this.DDVersions[DataTypes.MAP]),
        items: {
          boots: [],
          jungling: [],
          generic: []
        }
      };
    }
  }

  private formatSummoners({data} : DDSummonerResponse) {
    this.summoners = data;

    for (let summonerId in data) {
      let summoner = data[summonerId];
      for (let mode of summoner.modes) {
        this.summonersDataByMode[mode] = this.summonersDataByMode[mode] || [];
        this.summonersDataByMode[mode].push(summoner);
      }
    }
  }

  private formatRunes(data : DDRunesResponse) {
    this.runes = data;

    for (let path of data) {
      this.formattedRunes[path.name] = [];
      for (let runeIndex in path.slots) {
        this.formattedRunes[path.name][runeIndex] = path.slots[runeIndex].runes;
      }
    }
  }

  private getAvailableMaps() {
    let maps = [];

    for (let mapId in this.itemDataByMap) {
      maps.push({
        id: mapId,
        name: this.itemDataByMap[mapId].name,
        url: this.itemDataByMap[mapId].url
      });
    }

    return maps;
  }

  private getAvailableModes() {
    let modes = [];

    for (let modeId in this.summonersDataByMode) {
      modes.push({
        modeId: modeId,
        name: ModeToReadable[modeId as keyof typeof ModeToReadable]
      });
    };

    return modes;
  }
  
}
