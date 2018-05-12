import * as rp from "request-promise";
import { Request } from "request";
import { DDItemResponse } from "DDItem";
import { DDMapResponse } from "DDMap";
import { DDRunesResponse } from "DDRunes";
import { DDSummonerResponse } from "DDSummoner";
import { DDChampionResponse } from "DDChampion";

export const enum DataTypes {
  ITEM = "item",
  CHAMPION = "champion",
  MAP = "map",
  SUMMONER = "summoner",
  RUNES_REFORGED = "runesReforged"
}

// TODO: when(if?) they have a mode endpoint, fetch that data instead
// https://developer.riotgames.com/game-constants.html
export enum ModeToReadable  {
  CLASSIC =	"Classic Summoner's Rift and Twisted Treeline games",
  ODIN =	"Dominion/Crystal Scar games",
  ARAM =	"ARAM games",
  TUTORIAL =	"Tutorial games",
  URF =	"URF games",
  DOOMBOTSTEEMO =	"Doom Bot games",
  ONEFORALL =	"One for All games",
  ASCENSION =	"Ascension games",
  FIRSTBLOOD =	"Snowdown Showdown games",
  KINGPORO =	"Legend of the Poro King games",
  SIEGE =	"Nexus Siege games",
  ASSASSINATE =	"Blood Hunt Assassin games",
  ARSR =	"All Random Summoner's Rift games",
  DARKSTAR =	"Dark Star: Singularity games",
  STARGUARDIAN =	"Star Guardian Invasion games",
  PROJECT =	"PROJECT: Hunters games"
}

export function getDDVersions() {
  return getJsonDataAsPromise("https://ddragon.leagueoflegends.com/realms/na.json").then(({n}) => n);
}

export const getItemStaticData: (version: string) => Promise<DDItemResponse> = getStaticData.bind(null, DataTypes.ITEM);
export const getChampionStaticData: (version: string) => Promise<DDChampionResponse> = getStaticData.bind(null, DataTypes.CHAMPION);
export const getMapStaticData: (version: string) => Promise<DDMapResponse> = getStaticData.bind(null, DataTypes.MAP);
export const getSummonerStaticData: (version: string) => Promise<DDSummonerResponse> = getStaticData.bind(null, DataTypes.SUMMONER);
export const getRuneStaticData: (version: string) => Promise<DDRunesResponse> = getStaticData.bind(null, DataTypes.RUNES_REFORGED);

export function getImageUrl(dataType: DataTypes, key: string, version: string) {
  return `http://ddragon.leagueoflegends.com/cdn/${version}/img/${dataType}/${key}.png`
}

function getStaticData(dataType: DataTypes, version: string) {
  return getJsonDataAsPromise(getApiUrl(version, dataType));
}
  
function getApiUrl(version: string, dataType: DataTypes) {
  return `https://ddragon.leagueoflegends.com/cdn/${version}/data/en_US/${dataType}.json`;
}

function getJsonDataAsPromise(url: string) {
  return rp.get(url, {
    json: true
  }).promise();
}