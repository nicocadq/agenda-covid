// you need to run npx lite-server at the root

// API

const BASE_URL = "http://localhost:80/agenda-covid/controllers";

const validateUserIdentification = async (identification) => {
  try {
    const response = await fetch(`${BASE_URL}/users.php?ci=${identification}`);

    return await response.json();
  } catch (error) {
    return { error: error.message || "Unknown error" };
  }
};

const attachTelephoneToUser = async (userIdentification, telephone) => {
  try {
    const response = await fetch(
      `${BASE_URL}/users.php?ci=${userIdentification}`,
      {
        method: "POST",
        body: JSON.stringify({ telephone }),
      }
    );

    return await response.json();
  } catch (error) {
    return { error: error.message || "Unknown error" };
  }
};

// ROUTING

const routes = {
  "/": { templateId: "home" },
  "/new": { templateId: "new" },
  "/delete": { templateId: "delete" },
  "/list": { templateId: "list" },
  "/show": { templateId: "show" },
};

const updateRoute = () => {
  const path = window.location.pathname;
  const route = routes[path];

  if (!route) navigate("/");

  const template = document.getElementById(route.templateId);
  const view = template.content.cloneNode(true);
  const app = document.getElementById("app");
  app.innerHTML = "";
  app.appendChild(view);
};

const navigateTo = (path) => {
  window.history.pushState({}, path, window.location.origin + path);

  updateRoute();
};

const onLinkClick = (event) => {
  event.preventDefault();

  navigateTo(event.target.href);
};

window.onpopstate = () => updateRoute();

//FORMS

const scheduleDate = async () => {
  const form = document.getElementById("schedule-date-form");
  const formData = new FormData(form);
  const { identification } = Object.fromEntries(formData);
  const result = await validateUserIdentification(identification);

  if (result.error) {
    console.log("An error ocurred:", result.error);
  } else {
    console.log("Validated account!", result);
  }
};

const attachTelephone = async () => {
  const form = document.getElementById("attach-telephone");
  const formData = new FormData(form);
  const { telephone } = Object.fromEntries(formData);
  const result = await attachTelephoneToUser("12345678", telephone);

  if (result.error) {
    console.log("An error ocurred:", result.error);
  } else {
    console.log("Validated account!", result);
  }
};

//INIT

updateRoute();
