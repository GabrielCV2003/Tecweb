<?php
$parqueVehicular = [
    "ABC1234" => [
        "Auto" => [
            "marca" => "Toyota",
            "modelo" => 2021,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Juan Pérez",
            "ciudad" => "Ciudad de México",
            "direccion" => "Av. Reforma 123"
        ]
    ],
    "XYZ5678" => [
        "Auto" => [
            "marca" => "Nissan",
            "modelo" => 2019,
            "tipo" => "hachback"
        ],
        "Propietario" => [
            "nombre" => "María López",
            "ciudad" => "Guadalajara",
            "direccion" => "Calle Libertad 456"
        ]
    ],
    "DEF9876" => [
        "Auto" => [
            "marca" => "Honda",
            "modelo" => 2020,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Carlos Sánchez",
            "ciudad" => "Monterrey",
            "direccion" => "Blvd. Constitución 789"
        ]
    ],
    "GHI6543" => [
        "Auto" => [
            "marca" => "Ford",
            "modelo" => 2018,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Ana Martínez",
            "ciudad" => "Puebla",
            "direccion" => "Calle 5 de Mayo 101"
        ]
    ],
    "JKL3210" => [
        "Auto" => [
            "marca" => "Chevrolet",
            "modelo" => 2022,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Luis García",
            "ciudad" => "Toluca",
            "direccion" => "Av. Independencia 202"
        ]
    ],
    "MNO8765" => [
        "Auto" => [
            "marca" => "Volkswagen",
            "modelo" => 2017,
            "tipo" => "hachback"
        ],
        "Propietario" => [
            "nombre" => "Sofía Ramírez",
            "ciudad" => "Querétaro",
            "direccion" => "Calle Corregidora 303"
        ]
    ],
    "PQR2345" => [
        "Auto" => [
            "marca" => "Hyundai",
            "modelo" => 2023,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Miguel Torres",
            "ciudad" => "Cancún",
            "direccion" => "Av. Tulum 404"
        ]
    ],
    "STU7890" => [
        "Auto" => [
            "marca" => "Kia",
            "modelo" => 2020,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Laura Díaz",
            "ciudad" => "Mérida",
            "direccion" => "Calle 60 505"
        ]
    ],
    "VWX4567" => [
        "Auto" => [
            "marca" => "Mazda",
            "modelo" => 2019,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Jorge Ruiz",
            "ciudad" => "León",
            "direccion" => "Blvd. Adolfo López Mateos 606"
        ]
    ],
    "YZA1230" => [
        "Auto" => [
            "marca" => "Subaru",
            "modelo" => 2021,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Patricia Castro",
            "ciudad" => "Tijuana",
            "direccion" => "Av. Revolución 707"
        ]
    ],
    "BCD6789" => [
        "Auto" => [
            "marca" => "BMW",
            "modelo" => 2022,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Ricardo Morales",
            "ciudad" => "Monterrey",
            "direccion" => "Calle Hidalgo 808"
        ]
    ],
    "EFG3456" => [
        "Auto" => [
            "marca" => "Audi",
            "modelo" => 2020,
            "tipo" => "hachback"
        ],
        "Propietario" => [
            "nombre" => "Fernanda Ortega",
            "ciudad" => "Guadalajara",
            "direccion" => "Av. Vallarta 909"
        ]
    ],
    "HIJ0123" => [
        "Auto" => [
            "marca" => "Mercedes-Benz",
            "modelo" => 2023,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Alejandro Vargas",
            "ciudad" => "Puebla",
            "direccion" => "Calle 11 Norte 1010"
        ]
    ],
    "KLM4560" => [
        "Auto" => [
            "marca" => "Tesla",
            "modelo" => 2022,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Daniela Ríos",
            "ciudad" => "Ciudad de México",
            "direccion" => "Av. Insurgentes 1111"
        ]
    ],
    "NOP7891" => [
        "Auto" => [
            "marca" => "Jeep",
            "modelo" => 2021,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Oscar Medina",
            "ciudad" => "Querétaro",
            "direccion" => "Calle Zaragoza 1212"
        ]
    ]

];

header('Content-Type: application/xhtml+xml; charset=utf-8');

$accion = $_POST["accion"] ?? "";
$matricula = strtoupper(trim($_POST["matricula"] ?? ""));

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
    <title>Respuesta - Parque Vehicular</title>
</head>
<body>
    <h1>Resultado de la Consulta</h1>
    <?php
    if ($accion == "buscar" && !empty($matricula)) {
        if (array_key_exists($matricula, $parqueVehicular)) {
            echo "<h2>Información del vehículo con matrícula $matricula:</h2>";
            echo "<ul>";
            echo "<li><strong>Marca:</strong> " . $parqueVehicular[$matricula]["Auto"]["marca"] . "</li>";
            echo "<li><strong>Modelo:</strong> " . $parqueVehicular[$matricula]["Auto"]["modelo"] . "</li>";
            echo "<li><strong>Tipo:</strong> " . $parqueVehicular[$matricula]["Auto"]["tipo"] . "</li>";
            echo "<li><strong>Propietario:</strong> " . $parqueVehicular[$matricula]["Propietario"]["nombre"] . "</li>";
            echo "<li><strong>Ciudad:</strong> " . $parqueVehicular[$matricula]["Propietario"]["ciudad"] . "</li>";
            echo "<li><strong>Dirección:</strong> " . $parqueVehicular[$matricula]["Propietario"]["direccion"] . "</li>";
            echo "</ul>";
        } else {
            echo "<p>No se encontró ningún vehículo con la matrícula $matricula.</p>";
        }
    } elseif ($accion == "mostrar_todos") {
        echo "<h2>Listado completo de vehículos:</h2>";
        foreach ($parqueVehicular as $matricula => $datos) {
            echo "<h3>Matrícula: $matricula</h3>";
            echo "<ul>";
            echo "<li><strong>Marca:</strong> " . $datos["Auto"]["marca"] . "</li>";
            echo "<li><strong>Modelo:</strong> " . $datos["Auto"]["modelo"] . "</li>";
            echo "<li><strong>Tipo:</strong> " . $datos["Auto"]["tipo"] . "</li>";
            echo "<li><strong>Propietario:</strong> " . $datos["Propietario"]["nombre"] . "</li>";
            echo "<li><strong>Ciudad:</strong> " . $datos["Propietario"]["ciudad"] . "</li>";
            echo "<li><strong>Dirección:</strong> " . $datos["Propietario"]["direccion"] . "</li>";
            echo "</ul>";
        }
    } else {
        echo "<p>No se ha proporcionado una acción válida.</p>";
    }
    ?>
</body>
</html>