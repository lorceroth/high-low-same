import moment from 'moment';

export class GameSession {
    constructor() {
        this.deckId = localStorage.getItem('deckId');
        this.deckIdExpires = localStorage.getItem('deckIdExpires');
        this.lastGame = localStorage.getItem('lastGame');
    }

    getDeckId() {
        return this.deckId;
    }

    saveDeckId(id) {
        localStorage.setItem('deckId', id);
        localStorage.setItem('deckIdExpires', moment().add('1', 'week').format());
    }

    isValid() {
        let deckIdExpires = moment(this.deckIdExpires).format();

        return null !== this.deckId && moment().isBefore(deckIdExpires);
    }

    updateLastGame() {
        localStorage.setItem('lastGame', moment().format());
    }
}
