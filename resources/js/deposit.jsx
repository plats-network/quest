import React from "react";
import { useContract, useTx } from "useink";
import metadata from "./contract-metadata.json";

function Deposit() {
    const CONTRACT_ADDRESS = "5CDveQs6omBkWyVXYiZZeCFkpUHWVoSWxhgEREfikvRV7Dxm";
    const contract = useContract(CONTRACT_ADDRESS, metadata);
    console.log({ contract });
    const deposit = useTx(contract, "deposit");
    const amount = 1000;
    const handleDeposit = async () => {
        const args = [[1000]];
        const res = await deposit.signAndSend(args, { value: amount });
        console.log({ res });
        console.log("hello");
    };
    return (
        <button onClick={() => handleDeposit()} className="btn btn-success">
            Create
        </button>
    );
}

export default Deposit;
