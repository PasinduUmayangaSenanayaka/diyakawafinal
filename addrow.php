<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foreign Price</title>


<body>
    <h6>Foreign Price</h6>
    <div>
        <form id="currencyForm">
            <table id="currencyTable">
                <thead>
                    <tr>
                        <th>Currency</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic rows will be added here -->
                </tbody>
            </table>
            <button type="button" id="addCurrencyBtn">Add Currency</button>
        </form>
    </div>

    <script>
        // Array of currency options
        const currencyOptions = [{
                id: 1,
                currencyName: 'USD'
            },
            {
                id: 2,
                currencyName: 'EUR'
            },
            {
                id: 3,
                currencyName: 'INR'
            },
            {
                id: 4,
                currencyName: 'LKR'
            }
        ];

        const currencyTable = document.getElementById('currencyTable').getElementsByTagName('tbody')[0];
        const addCurrencyBtn = document.getElementById('addCurrencyBtn');

        // Function to add a new row for currency and amount
        function addCurrencyRow() {
            const row = currencyTable.insertRow();
            const currencyCell = row.insertCell(0);
            const amountCell = row.insertCell(1);
            const actionCell = row.insertCell(2);

            // Create a dropdown for currency selection
            const select = document.createElement('select');
            select.name = 'currency';
            currencyOptions.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option.id;
                opt.textContent = option.currencyName;
                select.appendChild(opt);
            });
            currencyCell.appendChild(select);

            // Create an input for the amount
            const amountInput = document.createElement('input');
            amountInput.type = 'number';
            amountInput.name = 'amount';
            amountInput.placeholder = 'Enter amount';
            amountCell.appendChild(amountInput);

            // Create a remove button for the row
            const removeBtn = document.createElement('button');
            removeBtn.textContent = 'Remove';
            removeBtn.type = 'button';
            removeBtn.classList.add('remove-btn');
            removeBtn.onclick = () => currencyTable.deleteRow(row.rowIndex - 1); // Remove row
            actionCell.appendChild(removeBtn);
        }

        // Add event listener to the "Add Currency" button
        addCurrencyBtn.addEventListener('click', addCurrencyRow);
    </script>
</body>

</html>