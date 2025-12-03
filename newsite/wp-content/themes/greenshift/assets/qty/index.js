"use strict";
function GSPB_quantityInput(documentobj = document) {
    let quantityContainers = documentobj.getElementsByClassName('quantity');

    for (let i = 0; i < quantityContainers.length; i++) {
        let quantityContainer = quantityContainers[i];
        let quantityInput = quantityContainer.querySelector('input[type="number"]');

        // Create minus button
        let minusButton = document.createElement('button');
        minusButton.setAttribute('type', 'button');
        minusButton.classList.add('sub');
        minusButton.setAttribute('title', 'Down');
        minusButton.textContent = '-';
        quantityContainer.insertBefore(minusButton, quantityInput);

        // Create plus button
        let plusButton = document.createElement('button');
        plusButton.setAttribute('type', 'button');
        plusButton.setAttribute('title', 'Up');
        plusButton.classList.add('add');
        plusButton.textContent = '+';
        quantityContainer.appendChild(plusButton);

        let quantitydata = quantityInput ? quantityInput.closest('form').querySelector('[data-quantity]') : null;

        // Event listener for plus button
        plusButton.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value);
            if (isNaN(currentValue)) {
                currentValue = 0;
            }
            quantityInput.value = currentValue + 1;
            if(quantitydata) quantitydata.setAttribute("data-quantity", currentValue + 1);
            quantityInput.dispatchEvent(new Event('change')); // Trigger change event
        });

        // Event listener for minus button
        minusButton.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value);
            if (isNaN(currentValue)) {
                currentValue = 0;
            }
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                if(quantitydata) quantitydata.setAttribute("data-quantity", currentValue - 1);
                quantityInput.dispatchEvent(new Event('change')); // Trigger change event
            }
        });
    }
}
if(document.body.classList && !document.body.classList.contains('woocommerce-cart')){
    GSPB_quantityInput();
}