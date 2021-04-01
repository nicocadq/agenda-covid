<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupos</title>
</head>

<body>
    <h1>Grupos</h1>
</body>

<script>
const getGroups = async () => {
    try {
        const response = await fetch('../controllers/groups.php?id=1');
        const data = await response.json();
        return data;
    } catch (error) {
        return error;
    }
}

getGroups()
    .then((response) => console.log(response))
    .catch((error) => console.log(error));
</script>

</html>