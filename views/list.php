<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AGENDA COVID - Grupos</title>
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
                            <a class="navbar-item" href="./show.php">Consultar agenda</a>
                            <a class="navbar-item" href="./delete.php">Borrar consulta</a>
                            <a class="navbar-item is-active" href="./list.php">Grupos</a>
                        </div>
                    </div>
                </div>
            </header>
        </div>

        <div class="hero-body">
            <div class="container">
                <p class="title">Grupos</p>
                <div class="box">
                    <p class="subtitle">
                        Cantidad por grupo
                    </p>
                    <table id="count-by-groups" class="table is-bordered is-striped is-narrow is-fullwidth">
                        <thead>
                            <tr>
                                <th>Grupo</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="box">
                    <p class="subtitle">
                        Cantidad por edad
                    </p>
                    <table class="table is-bordered is-striped is-narrow is-fullwidth">
                        <thead>
                            <tr>
                                <th>Grupo</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

    <script>
    const getCountByGroupRequest = async () => {
        try {
            const response = await fetch(`../controllers/groups.php?action=groups`);
            const data = await response.json();
            if (!data.error) {
                return data;
            } else {
                throw new Error(data.error);
            }
        } catch (error) {
            console.log(error);
            return false;
        }
    }

    const getCountByAgeRequest = async () => {
        try {
            const response = await fetch(`../controllers/agenda.php?ci=${ci}`);
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

    const twoColumnsTableRow = (column1, column2) => `<tr>
            <td>${column1}</td>
            <td>${column2}</td>
        </tr>`;

    const addRowsToTable = (tableId, columns) => {
        const tableBody = document.querySelector(`table#${tableId} tbody`);
        columns.map((column) => {
            tableBody.innerHTML += column;
        })
    }


    document.addEventListener('DOMContentLoaded', async () => {
        const countByGroups = await getCountByGroupRequest();
        const byGroupColumns = countByGroups.map(({
            name,
            count
        }) => twoColumnsTableRow(name, count));
        addRowsToTable('count-by-groups', byGroupColumns);
    });
    </script>

</body>

</html>