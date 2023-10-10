import React, { useEffect, useState } from "react";
import { useContract, useTx } from "useink";
import metadata from "./contract-metadata.json";

const CONTRACT_ADDRESS_ALPHE =
    "5HGocx7mPhQ34Si6pTCA1b2VQ3KuNkkf7XArcCCRkYKqVjw3";
const CONTRACT_ADDRESS_PHALA =
    "5HGocx7mPhQ34Si6pTCA1b2VQ3KuNkkf7XArcCCRkYKqVjw3";

function Deposit() {
    const alpheContract = useContract(
        CONTRACT_ADDRESS_ALPHE,
        metadata,
        "aleph-testnet",
    );

    // const phalaContract = useContract(
    //     CONTRACT_ADDRESS_PHALA,
    //     metadata,
    //     "phala-testnet",
    // );
    const alpheDeposit = useTx(alpheContract, "deposit");
    // const phalaDeposit = useTx(phalaContract, "deposit");
    // const reward = useTx(contract, "reward");
    const [amount, setAmount] = useState();

    const handleDeposit = () => {
        const name = document.getElementById("name").value;
        const intro = document.getElementById("intro").value;
        const reward_type = document.getElementById("reward_type").value;
        const total_person = document.getElementById("total_person").value;
        const end_at = document.getElementById("end_at").value;
        const start_at = document.getElementById("start_at").value;
        const published_at = document.getElementById("published_at").value;
        const status = document.getElementById("status").value;
        const category_id = document.getElementById("category_id").value;
        const tag_list = document.getElementById("tags_list[]").value;
        const image = document.getElementById("featured_image").value;
        const content = document.getElementById("content").value;

        const NETWORK = {
            2: alpheDeposit,
        };
        const args = [];
        const network = document.getElementById("block_chain_network").value;
        NETWORK[network].signAndSend(args, { value: amount });
    };

    const handleReward = async () => {
        const args = [
            [
                "5EHjZpBvaaDccrjgSu99WgG63ysBBFj8wWzYsM3ULq76Cm8X",
                "5DoSGVS9U8BT8Y5u4FYD88k8Goie1fc62aR6QBqPeT8mL2Tf",
            ],
        ];
        const res = await reward.signAndSend(args);
        console.log({ res });
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
