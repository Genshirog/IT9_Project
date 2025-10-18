// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

contract RestockLog {
    // Event emitted whenever a restock is recorded
    event RestockRecorded(
        uint indexed inventoryId,
        string details,
        uint timestamp
    );

    // Function to record restock data
    function recordRestock(uint inventoryId, string memory details) public {
        emit RestockRecorded(inventoryId, details, block.timestamp);
    }
}
