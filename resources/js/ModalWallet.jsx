import { useEffect } from "react";
import { useWallet, useAllWallets, useContract } from "useink";
import metadata from "./contract-metadata.json";
import axios from "axios";
import { callApiConnect } from "./callApi";

// de vao file .env
const CONTRACT_ADDRESS = "5CDveQs6omBkWyVXYiZZeCFkpUHWVoSWxhgEREfikvRV7Dxm";

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
        if (account?.address) {
            const body = {
                wallet_address: account?.address,
                wallet_name: account?.name,
            };

            (async () => {
                await callApiConnect(body);
            })();
        }
    }, [account?.address]);

    const handleConnect = (wallet) => {
        connect(wallet.extensionName);
    };

    if (!account) {
        return (
            <div
                style={{
                    backgroundColor: "rgba(0,0,0,0.6)",
                    position: "fixed",
                    inset: 0,
                    height: "3000px",
                    zIndex: 100,
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "center",
                }}
            >
                <div
                    style={{
                        width: "450px",
                        height: "460px",
                        background: "#121127",
                        borderRadius: "20px",
                        position: "absolute",
                        top: "200px",
                        padding: "8px 16px",
                    }}
                >
                    <div style={{ padding: "0 6px" }}>
                        <h1
                            style={{
                                color: "white",
                                fontSize: "20px",
                                fontWeight: 600,
                                textAlign: "center",
                                marginTop: "16px",
                            }}
                        >
                            Connect Wallet
                        </h1>
                        <h2
                            style={{
                                color: "white",
                                fontSize: "16px",
                                fontWeight: 500,
                                textAlign: "center",
                                padding: "8px 0",
                            }}
                        >
                            Please install one of these supported wallets.
                        </h2>
                        {wallets.map((w) => (
                            <div
                                key={w.title}
                                // className="rounded-full bg-[#201F37] mt-4 p-2 px-4"
                                style={{
                                    borderRadius: 9999,
                                    backgroundColor: "#201F37",
                                    marginTop: "16px",
                                    padding: "8px 16px",
                                }}
                            >
                                {w.installed ? (
                                    <button
                                        style={{
                                            display: "flex",
                                            alignItems: "center",
                                            backgroundColor: "transparent",
                                            outline: "none",
                                            border: "none",
                                        }}
                                        onClick={() => {
                                            connect(w.extensionName);
                                        }}
                                    >
                                        <img
                                            style={{
                                                width: "40px",
                                                height: "40px",
                                            }}
                                            src={w.logo.src}
                                            alt={w.logo.alt}
                                        />
                                        <p
                                            style={{
                                                color: "white",
                                                marginLeft: "16px",
                                                marginBottom: "0px",
                                                fontWeight: 500,
                                            }}
                                        >
                                            Connnect to {w.title}
                                        </p>
                                    </button>
                                ) : (
                                    <a
                                        href={w.installUrl}
                                        style={{
                                            display: "flex",
                                            alignItems: "center",
                                            opacity: 0.5,
                                        }}
                                    >
                                        <img
                                            style={{
                                                width: "40px",
                                                height: "40px",
                                            }}
                                            src={w.logo.src}
                                            alt={w.logo.alt}
                                        />
                                        <p
                                            style={{
                                                color: "white",
                                                marginLeft: "16px",
                                                marginBlock: "0px",
                                            }}
                                        >
                                            Install {w.title}
                                        </p>
                                    </a>
                                )}
                            </div>
                        ))}

                        <button
                            onClick={() => setIsModal(false)}
                            style={{
                                rounded: 9999,
                                backgroundColor: "#201F37",
                                marginTop: "16px",
                                padding: "8px 32px",
                                position: "relative",
                                left: "40%",
                                outline: "none",
                                border: "none",
                                borderRadius: 9999,
                                color: "white",
                            }}
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        );
    }
};
