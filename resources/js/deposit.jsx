import React from "react";
import { useContract, useTx } from "useink";
import metadata from "./contract-metadata.json";

function Deposit() {
    const CONTRACT_ADDRESS = "5CDveQs6omBkWyVXYiZZeCFkpUHWVoSWxhgEREfikvRV7Dxm";
    const contract = useContract(CONTRACT_ADDRESS, metadata);
    console.log({ contract });
    const deposit = useTx(contract, "deposit");
    const reward = useTx(contract, "reward");

    const amount = 1000;
    const handleDeposit = async () => {
        const args = [[1000]];
        const res = await deposit.signAndSend(args, { value: amount });
        console.log({ res });
        console.log("hello");
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
        // <button onClick={() => handleDeposit()} className="btn btn-success">
        //     Create
        // </button>
        <button onClick={() => handleReward()} className="btn btn-success">
            Reward
        </button>
    );
}

export default Deposit;
