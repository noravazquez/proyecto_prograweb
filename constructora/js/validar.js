const rfcInput = document.getElementById('rfc');
    rfcInput.addEventListener('blur', validateRFC);

    function validateRFC() {
        const rfc = rfcInput.value.trim().toUpperCase();
        const pattern = /^[A-Z]{4}\d{6}[A-Z0-9]{3}$/;
        const errorDiv = document.getElementById('rfc-error');
        if (rfc && !pattern.test(rfc)) {
            errorDiv.innerText = 'RFC inválido';
            rfcInput.classList.add('is-invalid');
        } else {
            errorDiv.innerText = '';
            rfcInput.classList.remove('is-invalid');
        }
    }

    const curpInput = document.getElementById('curp');
    curpInput.addEventListener('blur', validateCURP);

    function validateCURP() {
        const curp = curpInput.value.trim().toUpperCase();
        const pattern = /^[A-Z]{4}\d{6}[HM][A-Z]{5}[A-Z0-9]{2}$/;
        const errorDiv = document.getElementById('curp-error');
        if (curp && !pattern.test(curp)) {
            errorDiv.innerText = 'CURP inválida';
            curpInput.classList.add('is-invalid');
        } else {
            errorDiv.innerText = '';
            curpInput.classList.remove('is-invalid');
        }
    }