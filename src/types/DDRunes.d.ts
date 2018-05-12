export type DDRunesResponse = {
    id: number,
    key: string,
    name: string,
    icon: string,
    slots: {
        runes: DDRunes[]
    }[]
}[];

export type DDRunes = {
    id: number,
    key: string,
    name: string,
    icon: string
};