import { useWallet, useAllWallets } from "useink";

export const ModalWallet = ({ show, onClose, setIsModal }) => {
    const { account, connect, accounts } = useWallet();
    const wallets = useAllWallets();

    const handleConnect = (wallet) => {
        connect(wallet.extensionName);
    };

    if (!account) {
        return (
            <div
                style={{ backgroundColor: "rgba(0,0,0,0.6)" }}
                class="fixed top-0 left-0 h-screen w-full flex items-center justify-center"
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

        return (
            <>
                <p>You are connected as {account?.name || account.address}</p>

                <button onClick={disconnect}>Disconnect Wallet</button>
            </>
        );
    }
};
