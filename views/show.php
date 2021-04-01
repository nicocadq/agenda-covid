<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AGENDA COVID - Consultar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">

    <style>

    </style>

</head>

<body>

    <section class="hero is-fullheight">
        <div class="hero-head">
            <header class="navbar">
                <div class="container">
                    <div class="navbar-brand">
                        <a class="navbar-item" href="../index.php">
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
                            <a class="navbar-item" href="./new.php">Agendarme</a>
                            <a class="navbar-item is-active" href="./show.php">Consultar agenda</a>
                            <a class="navbar-item">Listar</a>
                        </div>
                    </div>
                </div>
            </header>
        </div>

        <div class="hero-body">
            <div class="container">
                <p class="title">
                    Consultar agenda
                </p>
                <div class="box">
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
                    <div id="dates" class="block" style="display: none; margin-top: 1rem;">
                        <div class="notification is-success">
                            <p>Primera Fecha : <span id="first-date"></span></p>
                            <p>Segunda Fecha : <span id="second-date"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>
    const checkCiForm = document.querySelector('form#check');
    const checkCiSubmitButton = document.querySelector('form#check button');
    const getCiValue = () => document.querySelector('form#check input#ci').value;

    const getDatesRequest = async (ci) => {
        try {
            const response = await fetch(`../controllers/agenda.php?ci=${ci}`);
            const data = await response.json();
            if (!data.error) {
                console.log(data)
                return data;
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

    const showDates = (first, second) => {
        const firstDateContainer = document.querySelector('div#dates span#first-date');
        const secondDateContainer = document.querySelector('div#dates span#second-date');
        const datesContainer = document.querySelector('div#dates');

        firstDateContainer.innerHTML = first;
        secondDateContainer.innerHTML = second;

        datesContainer.style.display = 'block';
    }

    checkCiSubmitButton.addEventListener('click', async () => {
        const ci = getCiValue();
        const dates = await getDatesRequest(ci);
        if (dates) {
            showDates(dates.dateV1, dates.dateV2);
        } else {
            showInvalidCiMessage();
        }
    });
    </script>

</body>

</html>