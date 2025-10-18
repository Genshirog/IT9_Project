// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

contract RestaurantPayments {
    struct Payment {
        uint PaymentID;
        uint OrderID;
        uint amountPayed;
        string paymentMethod;
        uint timestamp;
    }

    Payment[] public payments;
    uint public paymentCount;

    event PaymentRecorded(
        uint PaymentID,
        uint OrderID,
        uint amountPayed,
        string paymentMethod,
        uint timestamp
    );

    function recordPayment(
        uint _PaymentID,
        uint _OrderID,
        uint _amountPayed,
        string memory _paymentMethod
    ) public {
        payments.push(Payment(_PaymentID, _OrderID, _amountPayed, _paymentMethod, block.timestamp));
        emit PaymentRecorded(_PaymentID, _OrderID, _amountPayed, _paymentMethod, block.timestamp);
        paymentCount++;
    }

    function getPayment(uint _index) public view returns (Payment memory) {
        return payments[_index];
    }

    function getAllPayments() public view returns (Payment[] memory) {
        return payments;
    }
}
