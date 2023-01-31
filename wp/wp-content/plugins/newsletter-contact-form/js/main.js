const cookieStorage = {
    getItem: (name) => {
        const cookies = document.cookie
            .split(';')
            .map(cookie => cookie.split('='))
            .reduce((acc, [key, value]) => ({ ...acc, [key.trim()]: value }), {});
        return cookies[name];
    },
    setItem: (name, value) => {
        document.cookie = `${name}=${value};`
    }
}

const storageType = cookieStorage;
const consentPropertyName = 'newsletter';

const shouldShowPopup = () => !storageType.getItem(consentPropertyName);
const saveToStorage = () => storageType.setItem(consentPropertyName, true);

window.onload = () => {
    const consentPopup = document.getElementById('myModal');
    const acceptBtn = document.getElementById('myModal');

    const acceptFn = event => {
        saveToStorage(storageType);
        consentPopup.classList.add('hidden');
    };

    acceptBtn.addEventListener('submit', acceptFn);

    if (shouldShowPopup(storageType)){
        setTimeout(() => {
            consentPopup.classList.remove('hidden');
        }, 1000);
    }

};


