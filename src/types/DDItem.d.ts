import { DDImage } from "./DDSharedTypes";

export type DDItemResponse = {
    data: {
        [itemId: number] : DDItem
    }
};

export type DDItem = {
    name: string,
    description: string,
    plaintext: string,
    into: string[],
    image: DDImage,
    consumed: boolean,
    inStore: boolean,
    gold: {
        base: number,
        purchasable: boolean,
        total: number,
        sell: number
    },
    tags: string[],
    maps: { [mapId: number]: boolean }
};