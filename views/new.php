<!-- 
Agendarme ingresando CI

El sistema tiene que
ingresar la fechaV1 la siguiente semana de la acción y fechaV2 un
mes luego de la fechaV1. Ej: Ingreso de la agenda el 2021-03-19 |
fechaV1: 2021-03-26 | fechaV2: 2021-04-26

-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AGENDA COVID - Agendarme</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
</head>

<body>

    <section class="hero is-fullheight">
        <div class="hero-head">
            <header class="navbar">
                <div class="container">
                    <div class="navbar-brand">
                        <a class="navbar-item">
                            AGENDA COVID
                        </a>
                        <!-- TODO: Add functionality to burger-menu -->
                        <span role="button" id="nav-toggle" class="navbar-burger nav-toggle" data-target="navMenu"
                            aria-label="menu" aria-expanded="false">
                            <span aria-hidden="true"></span>
                            <span aria-hidden="true"></span>
                            <span aria-hidden="true"></span>
                        </span>
                    </div>
                    <div id="nav-menu" class="navbar-menu nav-menu">
                        <div class="navbar-end">
                            <a class="navbar-item is-active" href="views/new.php">Agendarme</a>
                            <a class="navbar-item">Consultar agenda</a>
                            <a class="navbar-item">Listar</a>
                        </div>
                    </div>
                </div>
            </header>
        </div>

        <div class="hero-body">
            <div class="container ">
                <form id="check">
                    <label class="label text-white" for="ci">Ingrse su Cedula de Identidad</label>
                    <div class="field has-addons">
                        <div class="control">
                            <input class="input" id="ci" name="ci" type="number" placeholder="Ej. 4323398">
                        </div>
                        <div class="control">
                            <button class="button is-link" type="button">Submit</button>
                        </div>
                    </div>
                    <p class="help">Ingrese su cedula sin puntos ni guiones</p>
                    <p class="help is-danger" id="invalid-message" style="display: none;">La cedula ingresada no se
                        encuentra en el sistema.
                    </p>
                </form>
                <form id="add-tel" style="display: none; margin-top: 3rem;">
                    <div class="message is-primary" style="margin-bottom: 0;">
                        <div class="message-header">
                            <p>Se ha verificado su cedula correctamente</p>
                        </div>
                    </div>
                    <label class="label text-white" for="tel">Agrega tu telefono de contacto</label>
                    <div class="field has-addons">
                        <div class="control">
                            <input class="input" id="tel" name="tel" type="tel" placeholder="Ej. 093674532">
                        </div>
                        <div class="control">
                            <button class="button is-link" type="button">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>

    <script>
    const checkCiForm = document.querySelector('form#check');
    const checkCiSubmitButton = document.querySelector('form#check button');
    const getCiValue = () => document.querySelector('form#check input#ci').value;

    const checkRequest = async (ci) => {
        try {
            const response = await fetch(`../controllers/users.php?ci=${ci}`);
            const data = await response.json();
            if (!data.error) {
                return true;
            } else {
                throw new Error(data.error);
            }
        } catch (error) {
            console.log(error);
            return false;
        }
    }

    const showInvalidCiMessage = () => {
        const ciInput = document.querySelector('form#check input#ci');
        ciInput.classList.add('is-danger');

        const invalidMessage = document.querySelector('form#check p#invalid-message');
        invalidMessage.style.display = 'block';
    }

    const showAddTelForm = () => {
        const addTelForm = document.querySelector('form#add-tel');
        addTelForm.style.display = 'block';
    }

    checkCiSubmitButton.addEventListener('click', async () => {
        const ci = getCiValue();
        const isValid = await checkRequest(ci);
        if (isValid) {
            showAddTelForm();
        } else {
            showInvalidCiMessage();
        }
    });
    </script>

    <script>
    const addTelForm = document.querySelector('form#add-tel');
    const addTelSubmitButton = document.querySelector('form#add-tel button');

    const addTelRequest = async (ci) => {
        try {
            const formData = new FormData(addTelForm);
            const response = await fetch(`../controllers/users.php?ci=${ci}`, {
                method: 'POST',
                body: formData,
            });
            const data = await response.json();
            if (!data.error) {
                return true;
            } else {
                throw new Error(data.error);
            }
        } catch (error) {
            console.log(error);
            return false;
        }
    }

    addTelSubmitButton.addEventListener('click', async () => {
        const ci = getCiValue();
        const added = await addTelRequest(ci);
        if (added) {
            // TODO: Add this methods
            // showSuccessTelMessage();
        } else {
            // showErrorTelMessage();
        }
    });
    </script>
</body>

</html>