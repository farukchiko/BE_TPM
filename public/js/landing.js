function toggleAccordion(element) {
    const accordionItem = element.parentElement; 
    const content = accordionItem.querySelector('.accordion-content'); 
    
    const isActive = accordionItem.classList.contains('active');

    document.querySelectorAll('.accordion-item').forEach(item => {
        item.classList.remove('active');
        item.querySelector('.accordion-content').style.maxHeight = null;
        item.querySelector('.accordion-icon').textContent = '+';
    });

    if (!isActive) {
        accordionItem.classList.add('active');
        content.style.maxHeight = content.scrollHeight + 'px';
        accordionItem.querySelector('.accordion-icon').textContent = '-';
    }
}

document.querySelector('.contact-form button').addEventListener('click', function (event) {
    event.preventDefault(); 
    
    const inputs = document.querySelectorAll('.contact-form input, .contact-form textarea');
    let hasError = false;
    
    inputs.forEach(input => {
        const errorText = input.parentElement.querySelector('.error-message'); 
        
        input.style.border = '';
        if (errorText) {
            errorText.remove();
        }

        if (!input.value.trim()) {
            hasError = true;
            input.style.border = '2px solid rgba(178, 1, 16, 1)'; 
            
            const errorMessage = document.createElement('span');
            errorMessage.classList.add('error-message');
            errorMessage.textContent = 'Field cannot be empty';
            input.parentElement.appendChild(errorMessage);
        }
    });

    if (!hasError) {
        alert('Your Message has been successfully submitted!');
    }
});

