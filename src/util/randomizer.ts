export function getRandom(array: any[], n: number) {
    //https://stackoverflow.com/a/25984542
    var count = array.length,
     randomnumber,
     temp;
    while (count) {
        randomnumber = Math.random() * count-- | 0;
        temp = array[count];
        array[count] = array[randomnumber];
        array[randomnumber] = temp;
    }

    return array.slice(0,n);
}