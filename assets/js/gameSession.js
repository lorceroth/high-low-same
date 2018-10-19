import moment from 'moment';

export class GameSession {
    get deckId() {
        return localStorage.getItem('deckId');
    }

    set deckId(value) {
        localStorage.setItem('deckId', value);
    }

    get deckIdExpires() {
        return localStorage.getItem('deckIdExpires');
    }

    set deckIdExpires(value) {
        localStorage.setItem('deckIdExpires', value);
    }

    get lastGame() {
        return localStorage.getItem('lastGame');
    }

    set lastGame(value) {
        localStorage.setItem('lastGame', value);
    }

    get lastGameSaved() {
        return localStorage.getItem('lastGameSaved') == 'true';
    }

    set lastGameSaved(value) {
        localStorage.setItem('lastGameSaved', value);
    }

    saveDeckId(id) {
        this.deckId = id;
        this.deckIdExpires = moment().add('1', 'week').format();
    }

    isValid() {
        let deckIdExpires = moment(this.deckIdExpires).format();

        return null !== this.deckId && moment().isBefore(deckIdExpires);
    }

    updateLastGame() {
        this.lastGame = moment().format();
    }

    saveLastGame() {
        this.lastGameSaved = true;
    }

    startNewGame() {
        this.lastGame = null;
        this.lastGameSaved = false;
    }

    canSaveGame() {
        return null !== this.lastGame && false === this.lastGameSaved;
    }
}
