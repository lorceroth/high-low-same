export class Card {
    constructor() {
        this.code = null;
        this.suit = null;
        this.value = null;
        this.image = null;
    }

    static createFromObject(obj) {
        return Object.assign(new Card(), obj);
    }

    get displayName() {
        return this.suit + ' ' + this.value;
    }
}
