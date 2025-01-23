// SIDEBAR TOGGLE

let sidebarOpen = false;
const sidebar = document.getElementById("sidebar");

function openSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add("sidebar-responsive");
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove("sidebar-responsive");
    sidebarOpen = false;
  }
}

// ---------- CHARTS ----------

// BAR CHART
const barChartOptions = {
  series: [
    {
      data: [10, 8, 6, 4, 2],
    },
  ],
  chart: {
    type: "bar",
    height: 350,
    toolbar: {
      show: false,
    },
  },
  colors: ["#246dec", "#cc3c43", "#367952", "#f5b74f", "#4f35a1"],
  plotOptions: {
    bar: {
      distributed: true,
      borderRadius: 4,
      horizontal: false,
      columnWidth: "40%",
    },
  },
  dataLabels: {
    enabled: false,
  },
  legend: {
    show: false,
  },
  xaxis: {
    categories: [
      "Ordinateur",
      "Téléphone",
      "Ecran",
      "Casque",
      "Appareil photo",
    ],
  },
  yaxis: {
    title: {
      text: "Nombre de ventes",
    },
  },
};

const barChart = new ApexCharts(
  document.querySelector("#bar-chart"),
  barChartOptions
);
barChart.render();

// AREA CHART
const areaChartOptions = {
  series: [
    {
      name: "Ordres d achats",
      data: [31, 40, 28, 51, 42, 109, 100],
    },
    {
      name: "Ordres de ventes",
      data: [11, 32, 45, 32, 34, 52, 41],
    },
  ],
  chart: {
    height: 350,
    type: "area",
    toolbar: {
      show: false,
    },
  },
  colors: ["#4f35a1", "#246dec"],
  dataLabels: {
    enabled: false,
  },
  stroke: {
    curve: "smooth",
  },
  labels: ["Jan", "Fev", "Mar", "Avr", "Mai", "Juin", "Jui"],
  markers: {
    size: 0,
  },
  yaxis: [
    {
      title: {
        text: "Ordres d achats",
      },
    },
    {
      opposite: true,
      title: {
        text: "Ordres de ventes",
      },
    },
  ],
  tooltip: {
    shared: true,
    intersect: false,
  },
};

const areaChart = new ApexCharts(
  document.querySelector("#area-chart"),
  areaChartOptions
);
areaChart.render();

// Fonction pour basculer l'affichage du menu déroulant
function toggleDropdown() {
  const dropdown = document.querySelector(".dropdown");
  dropdown.classList.toggle("open");
}

// Fermer le menu si on clique ailleurs
window.addEventListener("click", function (event) {
  const dropdown = document.querySelector(".dropdown");
  if (!dropdown.contains(event.target)) {
    dropdown.classList.remove("open");
  }
});
