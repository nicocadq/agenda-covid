## Ìndice

- [Acerca de la aplicación](#acerca-de-la-app)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Funcionalidades](#funcionalidades)
- [Prerequisitos](#prerequisitos)
- [Lista de Paquetes](#lista-de-paquetes)


## Acerca de la App

AGENDA-COVID es una app para gestionar las consultas para recivir la vacuna de COVID.

## Estructura del Proyecto

```
.
├── README.md
├── controllers/
├── models/
├── views/
├── utils/
├── docs/
└── index.php
```

## Funcionalidades

- [Agendarme](#agendarme)
- [Consultar fecha](#consultar-fecha)
- [Borrar reserva](#borrar-reserva)
- [Ver cantidades por grupo](#ver-cantidades-por-grupos)

## Prerequisitos

- Tener un servidor Apache corriendo donde este la carpeta del proyecto.
- Tener un servidor MySql corriendo con la base de datos `agenda_covid`.

## Lista de Paquetes

### Styles:

- [Bulma](https://bulma.io/): "...the modern CSS framework that just works". Bulma is a free, open source framework that provides ready-to-use frontend components that you can easily combine to build responsive web interfaces.

---

## Agendarme

- Formulario para agregar una nueva reserva:

![Agendarme Empty Page](https://raw.githubusercontent.com/nicocadq/agenda-covid/main/docs/new--empty.JPG)

- Error al no encontrar la Cedula de Identidad:

![Agendarme Empty Page](https://raw.githubusercontent.com/nicocadq/agenda-covid/main/docs/new--not-found-error.JPG)

- Formulario para agregar el telefono, se muestra solo si la cedula es encontrada:

![Agendarme Empty Page](https://raw.githubusercontent.com/nicocadq/agenda-covid/main/docs/new--add-tel.JPG)

---

## Consultar fecha

- Formulario para consultar fecha:

![Agendarme Empty Page](https://raw.githubusercontent.com/nicocadq/agenda-covid/main/docs/show--empty.JPG)

- Mostrar fechas de vacunacion:

![Agendarme Empty Page](https://raw.githubusercontent.com/nicocadq/agenda-covid/main/docs/show--dates.JPG)

---

## Borrar reserva

- Formulario para borrar reserva:

![Agendarme Empty Page](https://raw.githubusercontent.com/nicocadq/agenda-covid/main/docs/delete--empty.JPG)

- Mostrar mensage de alerta, al borrar la reserva exitosamente:

![Agendarme Empty Page](https://raw.githubusercontent.com/nicocadq/agenda-covid/main/docs/delete--warning.JPG)

---

## Ver cantidades por grupos

- Muestra en tablas separadas cantidades por grupo y cantidades por rango de edades:

![Agendarme Empty Page](https://raw.githubusercontent.com/nicocadq/agenda-covid/main/docs/groups.JPG)

---

Nicolás Machado da Silva 6to TIC
<br/>
Programacion Web & Diseño Web
