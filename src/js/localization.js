let npLang = function(locale='en') {

    this.messages = message;

    this.locale = locale;

    this.setLocale = (locale) => {
        this.locale = locale;
    }

    this._getMessage = (key) => {

        if (typeof key !== 'string' || !this.messages ) {
            return key;
        }

        let lc = "locale."+this.locale;

        //check locale exists
        if( !(lc in this.messages) ){
            return key;
        }

        if( !(key in this.messages[lc]) ){
            return key;
        }

        return this.messages[lc][key];
    }

    this.has = function(key) {
        if (typeof key !== 'string' || !this.messages ) {
            return false;
        }

        return this._getMessage(key) !== null;
    };

    this.get = (key) => {
        return this._getMessage(key);
    };
}

window.lang = new npLang();
