import { DDImage } from "./DDSharedTypes";

export type DDMapResponse = {
    data: {
        [mapId: number]: DDMap
    }
};

export type DDMap = {
    MapName: string,
    MapId: string,
    image: DDImage
};