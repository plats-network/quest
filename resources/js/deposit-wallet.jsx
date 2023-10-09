import { createRoot } from "react-dom/client";
import { UseInkProvider } from "useink";
import { AlephTestnet, PhalaTestnet } from "useink/chains";
import Deposit from "./deposit";

function DepositWrapped() {
    return (
        <UseInkProvider
            config={{
                dappName: "hkt_plats",
                chains: [AlephTestnet, PhalaTestnet],
            }}
        >
            <Deposit />
        </UseInkProvider>
    );
}

export default DepositWrapped;

const depositButton = createRoot(document.getElementById("deposit_button"));

if (depositButton !== null) {
    depositButton.render(<DepositWrapped />);
}
