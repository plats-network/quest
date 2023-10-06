import { useEffect } from "react";
import { useWallet, useAllWallets, useContract } from "useink";
import metadata from "./contract-metadata.json";

// de vao file .env
const CONTRACT_ADDRESS = "5DxNQBYHvmj7XLS3jEauBBGhcB4rykaWFwt24rASx9Uw5UQE";

export const ModalWallet = ({ setIsModal, setAccount }) => {
    const { account, connect, accounts } = useWallet();
    const wallets = useAllWallets();
    const contract = useContract(CONTRACT_ADDRESS, metadata);

    useEffect(() => {
        if (account?.address) {
            const shortAddress =
                account?.address.slice(0, 6) +
                "..." +
                account?.address.slice(-6);
            setAccount(shortAddress);
        }
    }, [account?.address]);

    const handleConnect = (wallet) => {
        connect(wallet.extensionName);
    };

    if (!account) {
        return (
            <div
                style={{ backgroundColor: "rgba(0,0,0,0.6)" }}
                className="fixed top-0 left-0 h-screen w-full flex items-center justify-center"
            >
                <div className="w-[450px] h-[450px] bg-[#121127] rounded-xl">
                    <div className="px-6">
                        <h1 className="text-white text-[20px] font-semibold text-center mt-4">
                            Connect Wallet
                        </h1>
                        <h2 className="text-white text-[16px] font-medium text-center">
                            Please install one of these supported wallets.
                        </h2>
                        {wallets.map((w) => (
                            <div
                                key={w.title}
                                className="rounded-full bg-[#201F37] mt-4 p-2 px-4"
                            >
                                {w.installed ? (
                                    <button
                                        className="flex items-center"
                                        onClick={() => {
                                            connect(w.extensionName);
                                        }}
                                    >
                                        <img
                                            className="w-[40px] h-[40px]"
                                            src={w.logo.src}
                                            alt={w.logo.alt}
                                        />
                                        <p className="text-white ml-4 mb-0 font-medium">
                                            Connnect to {w.title}
                                        </p>
                                    </button>
                                ) : (
                                    <a
                                        href={w.installUrl}
                                        className="flex items-center opacity-50"
                                    >
                                        <img
                                            className="w-[40px] h-[40px]"
                                            src={w.logo.src}
                                            alt={w.logo.alt}
                                        />
                                        <p className="text-white ml-4 mb-0">
                                            Install {w.title}
                                        </p>
                                    </a>
                                )}
                            </div>
                        ))}

                        <button
                            onClick={() => setIsModal(false)}
                            className="rounded-full bg-[#201F37] mt-4 p-2 px-8 text-white relative left-[50%] -translate-x-[50%]"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        );
    }
};
