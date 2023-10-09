import { createRoot } from "react-dom/client";
import { useState } from "react";
import { ModalWallet } from "./ModalWallet";
import { UseInkProvider, useTx } from "useink";
import { AlephTestnet, PhalaTestnet } from "useink/chains";

function ConnectButton() {
    const [isModal, setIsModal] = useState(false);
    const [account, setAccount] = useState();
    const buttonAlert = () => {
        setIsModal(true);
    };

    return (
        <UseInkProvider
            config={{
                dappName: "hkt_plats",
                chains: [AlephTestnet, PhalaTestnet],
            }}
        >
            <a
                href="#"
                onClick={buttonAlert}
                className="btn btn-sm btn-gray-800 d-inline-flex align-items-center"
            >
                <svg
                    class="icon icon-xs me-2"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    ></path>
                </svg>
                New Quest
            </a>
            {isModal && (
                <ModalWallet setIsModal={setIsModal} setAccount={setAccount} />
            )}
        </UseInkProvider>
    );
}

export default ConnectButton;

const newQuestButton = createRoot(document.getElementById("new_quest_button"));

if (newQuestButton !== null) {
    newQuestButton.render(<ConnectButton />);
}
