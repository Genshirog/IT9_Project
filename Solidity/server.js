const express = require('express');
const bodyParser = require('body-parser');
const { ethers } = require('ethers');
const app = express();
app.use(bodyParser.json());

const provider = new ethers.JsonRpcProvider("http://127.0.0.1:7545"); // Ganache RPC
const wallet = new ethers.Wallet("0x2c3ec252b826a17aee7d0a731f0386402e52fa1f774b909bcfdf05f7441481f5", provider); // Ganache account

const fullJson = require("./RestaurantPayments.json");
const abiKey = Object.keys(fullJson.abis)[0]; // grab the key
const abi = fullJson.abis[abiKey]; // this is your actual ABI
const contractAddress = "0xD63d094d9BB8a77fF1d3C877414C46d151DB2ED3";
const contract = new ethers.Contract(contractAddress, abi, wallet);

app.post('/record-payment', async (req, res) => {
    try {
        const { PaymentID, OrderID, amountPayed, paymentMethod } = req.body;
        const tx = await contract.recordPayment(PaymentID, OrderID, amountPayed, paymentMethod);
        await tx.wait();
        res.json({ success: true, txHash: tx.hash });
    } catch (err) {
        console.error(err);
        res.status(500).json({ success: false, error: err.message });
    }
});

app.listen(3001, () => console.log('Blockchain microservice running on port 3001'));
