INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "Serveur Dell PowerEdge T140",
        "CPU: Intel Xeon E-2136, RAM: 32Go DDR4 ECC, 1To SSD + 4To HDD, Alim Corsair RM750x",
        "Serveur",
        "disponible",
        1,
        "QR-SRV-001",
        1
    );

INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "Onduleur 1500VA",
        "865W, autonomie 20min, USB + Serial, Line-Interactive, EMI/RFI",
        "Onduleur",
        "disponible",
        1,
        "QR-OND-001",
        1
    );

INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "NVIDIA RTX 3090 Ti",
        "24Go GDDR6X, Boost Clock 1.86GHz, 3x PCIe 8-pin",
        "Carte Graphique",
        "disponible",
        1,
        "QR-GPU-001",
        1
    );

INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "XBee S2 ZigBee",
        "Antenne fouet",
        "Communication sans fil",
        "disponible",
        3,
        "QR-XBEE-001",
        10
    );

INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "Afficheur LCD 1602",
        "Écran LCD bleu 16x2 I2C pour Arduino",
        "Afficheur",
        "disponible",
        2,
        "QR-LCD-001",
        3
    );

INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "Câble de connexion",
        "Câble mâle/femelle pour Arduino, 20cm, kit de bricolage",
        "Accessoires",
        "disponible",
        5,
        "QR-CABLE-001",
        6
    );

INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "Breadboard 400 points",
        "Plaque de prototypage sans soudure",
        "Accessoires",
        "disponible",
        2,
        "QR-BB-001",
        15
    );

INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "Kit ESP32-WROVER",
        "Module ESP32, caméra OV2640, 4M PSRAM, Wi-Fi/Bluetooth, slot microSD",
        "Microcontrôleur",
        "disponible",
        2,
        "QR-ESP32-001",
        10
    );

INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "ESP32-WROVER",
        "Module ESP32, Wi-Fi, BLE, UART/SPI/I2C",
        "Microcontrôleur",
        "disponible",
        2,
        "QR-ESP32-002",
        10
    );

INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "Module LoRa SX1278",
        "433MHz, longue portée, pour Arduino/ESP32",
        "Communication",
        "disponible",
        2,
        "QR-LORA-001",
        8
    );

INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "Arduino Uno",
        "Microcontrôleur ATmega328P, USB, 14 broches digitales",
        "Microcontrôleur",
        "disponible",
        3,
        "QR-ARDUINO-001",
        12
    );

INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "Raspberry Pi 4",
        "4Go RAM, USB-C, micro-HDMI, Wi-Fi/Bluetooth",
        "Microordinateur",
        "disponible",
        2,
        "QR-RPI4-001",
        5
    );

INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "Capteur DHT22",
        "Capteur température & humidité numérique",
        "Capteur",
        "disponible",
        4,
        "QR-DHT22-001",
        20
    );

INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "Capteur MQ-2",
        "Détecteur de gaz fumée propane méthane",
        "Capteur",
        "disponible",
        4,
        "QR-MQ2-001",
        15
    );

INSERT INTO Equipement (nom, description, catégorie, état, seuil_alerte, qr_code, quantite_dispo)
    VALUES (
        "Caméra OV7670",
        "Caméra VGA pour Arduino",
        "Caméra",
        "disponible",
        2,
        "QR-CAM-001",
        6
    );

INSERT INTO Utilisateur (nom, prenom, email, mot_de_passe, rôle, date_inscription) VALUES
    ('El Amrani', 'Yassine', 'yassine.elamrani@umi.ac.ma', 'pass123', 'etudiant', '2024-10-01'),
    ('Bennani', 'Fatima', 'fatima.bennani@umi.ac.ma', 'pass456', 'etudiant', '2024-10-05'),
    ('Touhami', 'Hamza', 'hamza.touhami@umi.ac.ma', 'pass789', 'technicien', '2023-12-01'),
    ('Zerouali', 'Naima', 'naima.zerouali@umi.ac.ma', 'pass999', 'responsable', '2023-01-10');

INSERT INTO Notification (id_utilisateur, type, message, date_envoi) VALUES
    (1, 'alerte_stock', 'Le stock de Raspberry Pi est critique.', '2025-04-01 08:30:00'),
    (2, 'confirmation', 'Votre réservation a été approuvée.', '2025-04-02 09:00:00'),
    (3, 'rappel', "N'oubliez pas de rendre le matériel demain.', '2025-04-03 18:00:00");

INSERT INTO Reservation (id_utilisateur, date_debut, date_fin, statut, signature_responsable, qr_code_reservation) VALUES
    (1, '2025-04-10 09:00:00', '2025-04-12 18:00:00', 'validée', 'signature_fatima.png', 'QR-RES-1001'),
    (2, '2025-04-15 10:00:00', '2025-04-17 16:00:00', 'en_attente', NULL, 'QR-RES-1002');

INSERT INTO Reservation_Equipement (id_reservation, id_equipement, quantite_demandée) VALUES
    (1, 1, 1),
    (1, 2, 2),
    (2, 1, 1);
 
select * from Utilisateur ;