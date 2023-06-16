const form = document.getElementById('shopForm');

  form.addEventListener('submit', function(event) {
    event.preventDefault();
    // Clear previous errors
    clearErrors();

    // Validate name input
    const nameInput = document.querySelector('input[name="name"]');
    if (nameInput.value.trim() === '') {
      displayError(nameInput, 'Please enter a Shop Name.');
    }

    // Validate image input
    const imageInput = document.querySelector('input[name="image"]');
    const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    const fileExtension = imageInput.value.split('.').pop().toLowerCase();
    if (!allowedExtensions.includes(fileExtension)) {
      displayError(imageInput, 'Only image files (jpg, jpeg, png, gif) are allowed.');
    }

    // Validate opening and closing time inputs
    const openInput = document.querySelector('input[name="open"]');
    const closeInput = document.querySelector('input[name="close"]');
    if (openInput.value === closeInput.value) {
      displayError(openInput, 'Opening and closing times should not be the same.');
    }

     const daysCheckboxes = document.querySelectorAll('input[name="days[]"]');
    let checked = false;
    for (let i = 0; i < daysCheckboxes.length; i++) {
      if (daysCheckboxes[i].checked) {
        checked = true;
        break;
      }
    }
    if (!checked) {
      const daysContainer = document.getElementById('daysContainer');
      displayError(daysContainer, 'Please select at least one day.');
    }

    // If there are errors, stop form submission
    if (document.querySelectorAll('.error').length > 0) {
      return;
    }

    // If all validations pass, submit the form
    form.submit();
  });

  function displayError(inputElement, errorMessage) {
    const errorText = document.createElement('p');
    errorText.classList.add('error-text');
    errorText.textContent = errorMessage;
    inputElement.parentNode.insertBefore(errorText, inputElement.nextSibling);
    inputElement.classList.add('error');
  }

  function clearErrors() {
    const errorTextElements = document.querySelectorAll('.error-text');
    errorTextElements.forEach(function(element) {
      element.remove();
    });

    const errorInputElements = document.querySelectorAll('.error');
    errorInputElements.forEach(function(element) {
      element.classList.remove('error');
    });
  }

// Rest of the code...



    function displayError(inputElement, errorMessage) {
    //     const errorText = document.createElement('p');
    //     errorText.classList.add('error-text');
    //     errorText.textContent = errorMessage;
    //     inputElement.parentNode.appendChild(errorText);
    //     inputElement.classList.add('error');
    // }

    // function clearErrors() {
    //     const errorTextElements = document.querySelectorAll('.error-text');
    //     errorTextElements.forEach(function (element) {
    //         element.remove();
    //     });

    //     const errorInputElements = document.querySelectorAll('.error');
    //     errorInputElements.forEach(function (element) {
    //         element.classList.remove('error');
    //     });
    // }



     // Remove success alert after 3 seconds
    const successAlert = document.getElementById('successAlert');
    if (successAlert) {
        setTimeout(function () {
            successAlert.classList.add('fade-out');
            setTimeout(function () {
                successAlert.remove();
            }, 300);
        }, 3000);
    }

    // Remove fail alert after 3 seconds
    const failAlert = document.getElementById('failAlert');
    if (failAlert) {
        setTimeout(function () {
            failAlert.classList.add('fade-out');
            setTimeout(function () {
                failAlert.remove();
            }, 300);
        }, 3000);
    }