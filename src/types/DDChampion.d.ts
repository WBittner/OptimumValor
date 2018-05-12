import { DDImage } from "./DDSharedTypes";

export type DDChampionResponse = {
    data: {
        [championKey: string] : DDChampion
    }
};

export type DDChampion = {
    id: string,
    key: number,
    name: string,
    title: string,
    blurb: string,
    image: DDImage,
    tags: string[]
};