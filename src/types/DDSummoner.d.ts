import { DDImage } from "./DDSharedTypes";

export type DDSummonerResponse = {
    data : {
        [summonerKey: string]: DDSummoner
    }
};

export type DDSummoner = {
    id: string,
    name: string,
    description: string,
    tooltip: string,
    maxrank: string,
    cooldown: string,
    summonerLevel: number,
    modes: string[],
    image: DDImage
};