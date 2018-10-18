import { Card } from './card';

export class Deck {
    constructor() {
        this.id = null;
        this.remaining = 52;
        this.card = new Card();
    }

    static createFromObject(obj) {
        let deck = Object.assign(new Deck(), obj);
        deck.card = Card.createFromObject(obj.cards[0]);

        return deck;
    }
}
