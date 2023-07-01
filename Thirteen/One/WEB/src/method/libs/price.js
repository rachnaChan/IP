
var Prices = {
  async add({ price, source, product }) {
    const res = await fetch("http://localhost:3001/price/created", {
      method: "POST",
      credentials: "include",
      headers: {
        "Content-type": "application/json",
      },
      body: JSON.stringify({ price, source, product }),
    });

    const result = await res.json();
    return result;
  }
}

export default Prices
