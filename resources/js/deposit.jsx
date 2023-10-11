import React, { useEffect, useState } from "react";
import { useContract, useTx } from "useink";
import metadata from "./contract-metadata.json";

const CONTRACT_ADDRESS_ALPHE =
    "5HGocx7mPhQ34Si6pTCA1b2VQ3KuNkkf7XArcCCRkYKqVjw3";

function Deposit() {
    const alpheContract = useContract(
        CONTRACT_ADDRESS_ALPHE,
        metadata,
        "aleph-testnet",
    );
    const alpheDeposit = useTx(alpheContract, "deposit");
    // const reward = useTx(contract, "reward");
    const [amount, setAmount] = useState();

    const handleDeposit = () => {
        const NETWORK = {
            2: alpheDeposit,
        };
        const args = [];
        const network = document.getElementById("block_chain_network").value;
        NETWORK[network].signAndSend(args, { value: amount });
        setAmount("");
    };

    const handleReward = async () => {
        const args = [
            [
                "5EHjZpBvaaDccrjgSu99WgG63ysBBFj8wWzYsM3ULq76Cm8X",
                "5DoSGVS9U8BT8Y5u4FYD88k8Goie1fc62aR6QBqPeT8mL2Tf",
            ],
        ];
        const res = await reward.signAndSend(args);
    };
    return (
        <div
            style={{
                position: "relative",
                top: "-87px",
            }}
        >
            <div>
                <label>Total Token</label>
                <input
                    value={amount}
                    onChange={(e) => setAmount(e.target.value)}
                    className="form-control"
                    placeholder="Amount"
                />
            </div>
            <button
                onClick={() => handleDeposit()}
                className="btn btn-success mt-3"
            >
                Create
            </button>
        </div>
    );
}

export default Deposit;
