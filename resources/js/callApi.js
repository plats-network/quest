import axios from "axios"

export const callApiConnect = async (body) => {
    try {
        const res = await axios.post("http://127.0.0.1:8000/api/connect-wallet", body);
    if (res.data.status === "success") {
        await axios.get("http://127.0.0.1:8000/wallet-login", body);
    }
    } catch (error) {
        throw new Error(error.message)
    }
}
