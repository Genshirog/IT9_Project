// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

contract HelloWorld {
    event Hello(string message);

    // Accept ETH during deploy so it never rejects accidental value
    constructor() payable {}

    // Emits an event (costs gas)
    function sayHello() public {
        emit Hello("Hello, World!");
    }

    // Free function to see the message instantly without a transaction
    function helloString() public pure returns (string memory) {
        return "Hello, World!";
    }
}
