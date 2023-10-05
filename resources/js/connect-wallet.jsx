import {createRoot} from 'react-dom/client';

import {UseInkProvider} from 'useink';
import {RococoContractsTestnet, ShibuyaTestnet} from 'useink/chains';
import {useWallet, useAllWallets} from 'useink';

function ConnectButton() {
    const buttonAlert = () => {
        alert('Ha ha ha Clicked!');
    }

    return (
        <a href="#" onClick={buttonAlert}
           className="flex items-center mx-2 px-4 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-orange-600 rounded-md hover:bg-orange-500 focus:outline-none focus:bg-orange-500 invisible md:visible">
            <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" strokeWidth="2">
                <path strokeLinecap="round" strokeLinejoin="round"
                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            <span className="mx-1">Login</span>
        </a>
    );
}

export default ConnectButton;

const loginButton = createRoot(document.getElementById('login_button'));

if (loginButton !== null) {
    loginButton.render(<ConnectButton/>);
}
