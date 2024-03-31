import axios from "axios"

export const callApiConnect = async (body) => {
    try {
        const res = await axios.post("/api/connect-wallet", body);
    if (res.data.status === "success") {
        await axios.post("/wallet-login", body);
        window.location.reload();
    }
    } catch (error) {
        throw new Error(error.message)
    }
}
